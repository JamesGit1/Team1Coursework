<?php
require_once('../conn.php');
session_start();
$id = $_SESSION['id'];
$questionArray = $_SESSION['questionArray'];
//echo "ALL POST VARIABLES";
//var_dump($_POST);
//echo "ALL SESSION VARIABLES";
//var_dump($_SESSION);
//echo "THANKS FOR FILLING IN THE FORM";
if (isset($_POST['submitQuestion'])) {

    $query = "SELECT `participant ID` FROM answer a INNER JOIN question q ON a.`question ID` = q.ID WHERE q.`questionnaire id` = :questionnaireID GROUP BY `participant ID` ORDER BY `participant ID` DESC;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":questionnaireID", $id, PDO::PARAM_STR);
    $stmt->execute();
    $oldParticipantID = $stmt->fetchColumn();
    $participantID = $oldParticipantID + 1;
    unset($stmt);

    foreach ($questionArray as $i) {

        //1. we need to determine the type of each question in the array *
        //2. Based on that, we insert them using either text or radio insert
        //radio insert - insert the options after the question

        //1
        // $query = "SELECT q.`Type` FROM question q WHERE ID = :questionID;";
        // $stmt = $pdo->prepare($query);
        // $stmt->bindParam(":questionID", $questionID, PDO::PARAM_STR);
        // $questionID = $questionArray[$i];
        // $stmt->execute();
        // $questionType = $stmt->fetchColumn();
        // unset($stmt);
           // then we need to read out all the questions that is in the questionnaire
        $query = "INSERT INTO answer (`contents`, `question ID`, `participant ID`) 
                VALUES (:contents, :questionID, :participantID)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":contents", $contents, PDO::PARAM_STR);
        $stmt->bindParam(":questionID", $questionID, PDO::PARAM_STR);
        // TODO this needs to be fixed to have the ID of the participant, for now it will be 3
        $stmt->bindParam(":participantID", $participantID, PDO::PARAM_STR);

        // here, we want the name of the variable $questionArray[$i] so that we can get the value of that
        // from $_POST
        if (empty($_POST[$i])) {
            $contents = "N/A";
        }
        else{
            $contents = $_POST[$i];
        }
        
        $questionID = $i;
        $stmt->execute();
        $questions = $stmt->fetchAll();

        unset($stmt);
    }
}

?>

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
</head>

<body>
    <nav class="navbar navbar-dark">
        <a class="navbar-brand">
            <img src="../images/University_of_Dundee_shield_white.png" width="27" height="37" alt="Uni Logo"
                 style="margin-right: 20px;">
        </a>
    </nav>

    <div class="container">
        <div class="row">
            <h1><u>Answers Submitted!</u></h1>
        </div>
        <div class="row">
            <p>Thank you for completing this questionnaire.</p>
        </div>
        <div class="row justify-content-end" id="imageRow">
            <img src="../images/logo.png" class="fix">
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>