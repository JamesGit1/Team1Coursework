<?php
require_once('conn.php');
session_start();
$id = $_SESSION['id'];
$questionArray = $_SESSION['questionArray'];
//echo "ALL POST VARIABLES";
//var_dump($_POST);
//echo "ALL SESSION VARIABLES";
//var_dump($_SESSION);
//echo "THANKS FOR FILLING IN THE FORM";
if (isset($_POST['submitQuestion'])) {
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
        $contents = $_POST[$i];
        $questionID = $i;
        $participantID = 1;

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
    <link rel="stylesheet" type="text/css" href="style.css">

    <title></title>
</head>

<body>
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">Home</a>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <h1><u>Answers Submitted!</u></h1>
        </div>
        <div class="row" >
            <a href="index.html">Back to home</a>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>
