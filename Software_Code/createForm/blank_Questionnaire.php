<?php
require_once('../conn.php');
//Sessions Variables to get ID's
session_start();
$id = $_SESSION['id'];


//Gets the questionnaire
$query = "SELECT * FROM Questionnaire WHERE Questionnaire.id = :questionnaireID";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":questionnaireID", $questionnaireID, PDO::PARAM_STR);
$questionnaireID = $id;
$stmt->execute();
$result = $stmt->fetchAll();
foreach ($result as $row) {
    $title = $row['name'];
    $description = $row['description'];
}
unset($stmt);

//Get's question for question
$query = "SELECT * FROM question q where q.`questionnaire id` = :questionnaireID";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":questionnaireID", $id, PDO::PARAM_STR);
$stmt->execute();
$questions = $stmt->fetchAll();

unset($stmt);

//Submit radio questions
if (isset($_POST['submitRadioQuestions']))
{
    $arrayID = explode(",", $_POST['idNumbers']);

    $query = "SELECT `question number` FROM question q WHERE q.`questionnaire ID` = :questionnaireID ORDER BY `question number` DESC";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":questionnaireID", $id);
    $stmt->execute();
    $previousQuestionNumber = $stmt->fetchColumn();
    unset($stmt);

    $questionNumber = $previousQuestionNumber + 1;

    if(isset($_POST['required']))
    {
        $required = 1;
    }
    else
    {
        $required = 0;
    }

// Submits radioquestions into database
    $query = "INSERT INTO `question`(`Contents`,`Type`,`questionnaire ID`,`question number`,`required`)
                    VALUES (:contents,'radio', :questionnaireID, :questionNumber, :required);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":contents", $contents, PDO::PARAM_STR);
    $stmt->bindParam(":questionnaireID", $id);
    $stmt->bindParam(":questionNumber", $questionNumber);
    $stmt->bindParam(":required", $required);
    $contents = $_POST['questionText'];
    $stmt->execute();

    $query = "SELECT `ID` FROM question q WHERE q.`questionnaire ID` = :questionnaireID AND q.`contents` = :contents";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":questionnaireID", $id);
    $stmt->bindParam(":contents", $contents, PDO::PARAM_STR);
    $stmt->execute();
    $radioQuestionID = $stmt->fetchColumn();
    unset($stmt);

    foreach ($arrayID as $id)
    {
    	$query = "INSERT INTO `options` (`question ID`,`option`) VALUES(:radioQuestionID,:option);";
    	$stmt = $pdo->prepare($query);
    	$stmt->bindParam(":radioQuestionID", $radioQuestionID);
    	$stmt->bindParam(":option", $option);
        var_dump($id);
    	$option = $_POST[$id];
    	$stmt->execute();
    	unset($stmt);
    }

    header("Refresh:0");
}

// Submit the text or radio question into database
if (isset($_POST['submitQuestions']))
{
    $query = "SELECT `question number` FROM question q WHERE q.`questionnaire ID` = :questionnaireID ORDER BY `question number` DESC";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":questionnaireID", $id);
    $stmt->execute();
    $previousQuestionNumber = $stmt->fetchColumn();
    unset($stmt);

    $questionNumber = $previousQuestionNumber + 1;

    if(isset($_POST['required']))
    {
        $required = 1;
    }
    else
    {
        $required = 0;
    }

    $query = "INSERT INTO `question`(`Contents`,`Type`,`questionnaire ID`,`question number`,`required`)
                    VALUES (:contents,'text', :questionnaireID, :questionNumber, :required);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":contents", $contents, PDO::PARAM_STR);
    $stmt->bindParam(":questionnaireID", $id);
    $stmt->bindParam(":questionNumber", $questionNumber);
    $stmt->bindParam(":required", $required);
    $contents = $_POST['questionText'];
    $stmt->execute();
    unset($stmt);
    header("Refresh:0");
}

// deletes a question
if (isset($_POST['delete'])) {
    $query = "DELETE FROM question WHERE question.ID=:questionID";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":questionID", $questionID, PDO::PARAM_STR);
    $questionID = $_POST['delete'];
    $stmt->execute();
    header("Refresh:0");
}

// Deletes a radio button
if (isset($_POST['deleteRadio'])) {

    $query = "DELETE FROM `options` WHERE options.`question ID` = :questionID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":questionID", $questionID, PDO::PARAM_STR);
    $questionID = $_POST['deleteRadio'];
    $stmt->execute();
    unset($stmt);


    $query = "DELETE FROM question WHERE question.ID=:questionID";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":questionID", $questionID, PDO::PARAM_STR);
    $questionID = $_POST['deleteRadio'];
    $stmt->execute();
    header("Refresh:0");
}
// Submits the entire questionnaire
if (isset($_POST['submitForm']))
{
    $query = "UPDATE questionnaire SET `name` = :formName, `description` = :formDescription WHERE `ID` = :questionnaireID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":questionnaireID", $id);
    $stmt->bindParam(":formName", $formName);
    $stmt->bindParam(":formDescription", $formDescription);
    $formName = $_POST['formName'];
    $formDescription = $_POST['formDesc'];
    $stmt->execute();
    $_SESSION["questionnaireLink"] = "answerSheet.php?id=".$questionnaireID;
    header("Location: submitted.php");
}

if (isset($_POST['updateForm'])) 
{
    $query = "UPDATE questionnaire SET `name` = :formName, `description` = :formDescription WHERE `ID` = :questionnaireID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":questionnaireID", $id);
    $stmt->bindParam(":formName", $formName);
    $stmt->bindParam(":formDescription", $formDescription);
    $formName = $_POST['formName'];
    $formDescription = $_POST['formDesc'];
    $stmt->execute();
    unset($stmt);
    header("Refresh:0");
}
?>
<link rel="stylesheet" href="../CSS/questionAppearance.css">
<link rel="stylesheet" href="../CSS/style.css">
<!DOCTYPE html>
<html lang="en" dir="ltr">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <title>Dundata</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico" />
</head>

<!--Navigation bar -->
<nav class="navbar navbar-dark">
    <a class="navbar-brand" href="../index.html">
        <img src="../images/University_of_Dundee_shield_white.png" width="27" height="37" alt="Uni Logo"
            style="margin-right: 20px;">Home
    </a>
</nav>

<body>
    <div class="container" id="myDiv">
        <div class="row">
            <form method="post" class="newForm" id="submitQuestionnaire">
                    <input type="text" id="formName" style="margin-bottom: 0px;" value="<?php echo $title ?>"
                        class="card-title question-title" name="formName" />
                    <div class="edittip">
                        <em style="opacity: 0.5;">click to edit title or description!</em>
                    </div>
                <textarea name="formDesc" class="card-title question-title" id="formDescription"
                    oninput="auto_grow(this)"><?php echo $description ?></textarea>
              
                    <p><em>Remember to press 'Update' when you change the title/description <strong>BEFORE</strong> adding a question to avoid losing your changes!</em></p>
                    <button type="submit" class="btn btn-primary" name="updateForm" method="post"
                    id="submitForm">Update</button>

            </form>
            <div id="questionPanel">
                <?php
            foreach ($questions as $row)
            {
            	if ($row['Type'] == 'text')
            	{
                ?>
                <div class="card">
                    <div class="card-body">
                        <form name="textQuestion" method="POST">
                            <p><?php echo $row['Contents'] ?></p>
                            <p class="card-text"><em>Participant will answer here...</em></p>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button name="delete" value="<?php echo $row['ID'] ?>"
                                    class="btn btn-primary btn-danger fas fa-trash"></button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
            	}
                else if ($row['Type'] == 'radio')
                {
                    ?>
                <div class="card">
                    <div class="card-body">
                        <form name="radioQuestion" method="POST">
                            <p><strong><?php echo $row['Contents'] ?></strong></p>
                            <ul>
                                <?php
                                        $query = "SELECT * FROM options o where o.`question ID` = :questionID";
                                        $stmt = $pdo->prepare($query);
                                        $stmt->bindParam(":questionID", $row['ID'], PDO::PARAM_STR);
                                        $stmt->execute();
                                        $options = $stmt->fetchAll();
                                        unset($stmt);
                                        foreach($options as $option)
                                        {
                                        ?>
                                <li><?php echo $option['option']?></li>
                                <?php
                                        }
                                    ?>
                            </ul>
                            <button name="deleteRadio" value="<?php echo $row['ID'] ?>"
                                class="btn btn-primary btn-danger fas fa-trash"></button>
                        </form>
                    </div>
                </div>
                <?php
                }
            }
            ?>

                <form method="POST">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        id="newQuestion">
                        Add New Question
                    </button>
                </form>

                <button form="submitQuestionnaire" type="submit" class="btn btn-success" name="submitForm" method="post"
                    id="submitForm">Submit Questionnaire</button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Question Type</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>

                            </div>
                            <div class="modal-body">
                                <a href="#" id="btnText" data-bs-dismiss="modal" class="btn btn-primary">Text Based</a>
                                <a href="#" id="btnRadio" data-bs-dismiss="modal" class="btn btn-primary">Radio
                                    Button</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-end" id="imageRow">
            <img src="../images/logo.png" class="fix">
        </div>

    </div>
    <div id="loader"></div>
    <script>
    var myVar;

    function myFunction() {
        myVar = setTimeout(showPage, 300);
    }

    function showPage() {
        document.getElementById("myDiv").style.display = "none"; //change to container
        document.getElementById("loader").style.display = "block";
    }

    function auto_grow(element) {
        element.style.height = "5px";
        element.style.height = (element.scrollHeight) + "px";
    }
    </script>
</body>
</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>
<script src="https://kit.fontawesome.com/8741ca18b0.js" crossorigin="anonymous"></script>
<script src="addQuestions.js"></script>
