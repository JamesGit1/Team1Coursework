<?php
require_once('conn.php');
session_start();
$id = $_SESSION['id'];
$questionArray = $_SESSION['questionArray'];
echo "ALL POST VARIABLES";
var_dump($_POST);
echo "ALL SESSION VARIABLES";
var_dump($_SESSION);
echo "THANKS FOR FILLING IN THE FORM";
if (isset($_POST['submitQuestion'])) {
    for ($i = 0; $i < sizeof($questionArray); $i++) {
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
        $contents = $_POST[$questionArray[$i]];
        $questionID = $questionArray[$i];
        $participantID = 1;

        $stmt->execute();
        $questions = $stmt->fetchAll();

        unset($stmt);
    }
}
