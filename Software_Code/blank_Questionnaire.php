<?php
    require('conn.php');
    session_start();
    $id = $_SESSION['id'];

    $query = "SELECT * FROM Questionnaire WHERE Questionnaire.id = :questionnaireID";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":questionnaireID", $questionnaireID, PDO::PARAM_STR);
    $questionnaireID = $id;
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach ($result as $row) 
    {
        $title = $row['name'];
        $description = $row['description'];
    }
    unset($stmt);

    $query = "SELECT * FROM question q where q.`questionnaire id` = :questionnaireID";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":questionnaireID", $id, PDO::PARAM_STR);
    $stmt->execute();
    $questions = $stmt->fetchAll();

    unset($stmt);

    if(isset($_POST['submitQuestions']))
    {
        $query = "INSERT INTO `question`(`Contents`,`Type`,`questionnaire ID`,`question number`,`required`) 
                    VALUES (:contents,'text', :questionnaireID, 2, :required);";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":contents", $contents, PDO::PARAM_STR);
        $stmt->bindParam(":questionnaireID", $id);
        $stmt->bindParam(":required", $required);
        $required = $_POST['required'];
        $contents = $_POST['questionText'];
        $stmt->execute();
        header("Refresh:0");
    }

    if(isset($_POST['delete']))
    {
        $query = "DELETE FROM question WHERE question.ID=:questionID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":questionID", $questionID, PDO::PARAM_STR);
        $questionID = $_POST['delete'];
        $stmt->execute();
        header("Refresh:0");
    }
?>
<link rel="stylesheet" href="questionAppearance.css">
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<!--Navigation bar -->
<nav class="navbar navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.html">Home</a>
    </div>
</nav>

<body>
<div class="container" id="myDiv">
    <div class="row">
        <form method="POST">
        <?php
            foreach ($questions as $row) {
        ?>
            <div class="card">
                <div class="card-body">
                    <form name="textQuestion" method="POST">
                        <p><?php echo $row['Contents'] ?></p>
                        <p class="card-text"><em>Answer here</em></p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button name ="delete" value="<?php echo $row['ID']?>" class="btn btn-primary btn-danger fas fa-trash" onClick=myFunction()></button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
            }
        ?>
        </form>
        <form method="POST">
            <input type="text" name="questionText">
            <button type="submit" name="submitQuestions" onClick=myFunction()>Submit</button>
        </form>
        <!-- <form method="post" class="newForm">
            
            <input type="text" id="formName" value="<?php echo $title ?>" class="card-title question-title" name="formName"/>
            <input name = "formDesc" type="text" id="formDescription"  value="<?php echo $description ?>"
                   class="card-title question-title"/>
           
            <div id="questionPanel">

            </div>
            
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" id="newQuestion">
                Add New Question
            </button>
            <button type="submit" class="btn btn-primary" name="submitForm" method="post" id="submitForm"> Create Form
            </button>
        </form>-->
    </div>
    
<!--     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Question Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <a href="#" id="btnText" data-bs-dismiss="modal" class="btn btn-primary">Text Based</a>
                    <a href="#" id="btnRadio" data-bs-dismiss="modal" class="btn btn-primary">Radio Button</a>
                    <button type="button" class="btn btn-primary">Drop Down</button>
                </div>
            </div>
        </div>
    </div> -->
    <div class="row justify-content-end" id="imageRow">
      <img src="logo.png" class="fix">
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
  </script>
</body>


</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/8741ca18b0.js" crossorigin="anonymous"></script>
