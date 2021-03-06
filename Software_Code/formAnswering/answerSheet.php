<?php
require_once('../conn.php');
session_start();
$id = $_GET['id'];
$_SESSION['id'] = $id;

// we want to find the questionnaire that we need to read from
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

// then we need to read out all the questions that is in the questionnaire
$query = "SELECT * FROM question q where q.`questionnaire id` = :questionnaireID";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":questionnaireID", $id, PDO::PARAM_STR);
$stmt->execute();
$questions = $stmt->fetchAll();

unset($stmt);
?>
<link rel="stylesheet" href="../CSS/questionAppearance.css">
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <title>Dundata</title>

    <link rel="icon" type="image/x-icon" href="../images/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="../CSS/ethicsStyle.css">
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico"/>
</head>

<body>

<div class="container" id="myDiv">
    <div class="row">
        <form name="quiz" method="POST" action="submitAnswers.php">
            <div id="questionPanel">
                <h1><?php echo $title; ?></h1>
                <h3><?php echo $description; ?></h3>
                <?php

                $questionArray = array();
                // for each question, display it as a card that can be written in
                foreach ($questions as $row) {
                    // if the question requires a text answer, display it like this
                    if ($row['Type'] == 'text') {
                        ?>
                        <div class="card">
                            <div class="card-body">
                                <h4><?php echo $row['Contents'];
                                    if ($row['required'] == 1) {
                                        echo "*";
                                    } ?></h4>

                                <textarea <?php if ($row['required'] == 1) {
                                    echo " required ";
                                } ?> class="card-text"
                                     id="formDescription" placeholder="Participant will answer here..."
                                     name="<?php echo $row['ID'] ?>"
                                     oninput="auto_grow(this)"></textarea>


                            </div>
                        </div>
                        <?php
                        // if the question requires a radio button answer, display it like this
                    } else if ($row['Type'] == 'radio') {
                        ?>
                        <div class="card">
                            <div class="card-body">
                                <h4>
                                    <?php echo $row['Contents'];
                                    if ($row['required'] == 1) {
                                        echo "*";
                                    } ?></h4>
                                <?php
                                // then we need to read out all the options that is in the questionnaire
                                $query = "SELECT * FROM options o where o.`question ID` = :questionID";
                                $stmt = $pdo->prepare($query);
                                $stmt->bindParam(":questionID", $row['ID'], PDO::PARAM_STR);
                                $stmt->execute();
                                $options = $stmt->fetchAll();
                                unset($stmt);
                                // read in the options as radio buttons
                                foreach ($options as $option) {
                                    ?>
                                    <input <?php if ($row['required'] == 1) {
                                        echo " required ";
                                    } ?> type="radio"
                                         value="<?php echo $option['option']; ?>"
                                         name="<?php echo $row['ID']; ?>"/>
                                    <label for="<?php echo $option['option']; ?>"><?php echo $option['option']; ?></label>
                                    <br>
                                    <?php
                                } ?>
                            </div>
                        </div>
                        <?php
                    }
                    array_push($questionArray, $row['ID']);
                }
                $_SESSION['questionArray'] = $questionArray;
                $_SESSION['questionnaireID'] = $id;
                ?>

                <a data-modal-target="#modal" class="btn btn-primary fas fa-check" style="float: right;"></a>


            </div>
            <!--Ethics form modal from:
             https://youtube.com/watch?v=MBaw_6cPmAw&feature=share
             -->
            <div class="modal.activate" id="modal">
                <div id="header">
                    <div id="title">Ethics Form</div>
                    <button data-close-button type="button" class="btn-close btn-close-white"
                            aria-label="Close"></button>
                </div>

                <div id="body">
                    <p>By clicking continue you are agreeing with the University of Dundee's ethics agreement and that
                        the data
                        within the University
                    </p>


                    <div id="user_enter">
                        <div class="form-outline">
                        </div>

                    </div>

                    <div id="user-click">
                        <div id="checkbox">
                            <input type="checkbox" id="ethics">
                            <label for="ethics">I agree with the ethics form</label>

                        </div>
                        <button type="submit" name="submitQuestion" id="continue" class="btn btn-primary" disabled>
                            Continue!
                        </button>
                    </div>
                </div>
            </div>


            <div id="overlay"></div>
    </div>
    </form>

</div>
<div class="row justify-content-end" id="imageRow">

    <img src="../images/logo.png" class="fix">
</div>
</div>

<script type="text/javascript">

    function auto_grow(element) {
        element.style.height = "5px";
        element.style.height = (element.scrollHeight) + "px";
    }
</script>
</body>

</html>

<script src="../createForm/NewmodalJS.js"></script>
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
