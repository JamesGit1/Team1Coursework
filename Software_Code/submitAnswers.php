<?php
require_once('conn.php');
session_start();
$id = $_SESSION['id'];
$questionArray = $_SESSION['questionArray'];
echo "ALL POST VARIABLES";
var_dump($_POST);
echo "ALL SESSION VARIABLES";
var_dump($_SESSION);
if (isset($_POST['submitQuestion'])) {
    for ($i = 0; $i < sizeof($questionArray); $i++) {
        // then we need to read out all the questions that is in the questionnaire
        $query = "INSERT INTO answer (`contents`, `question ID`, `participant ID`) 
                VALUES (:contents, :questionID, :participantID)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":contents", $contents, PDO::PARAM_STR);
        $stmt->bindParam(":questionID", $questionID, PDO::PARAM_STR);
        $stmt->bindParam(":participantID", $participantID, PDO::PARAM_STR);

        $contents = $_POST['contents'];
        $questionID = $questionArray[i];

            $stmt->execute();
        $questions = $stmt->fetchAll();

        unset($stmt);
    }
}
