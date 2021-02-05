<?php
require_once('../conn.php');
session_start();

// create a new question
$stmt = $pdo->prepare("INSERT INTO question (`Contents`,`Type`,`questionnaire ID`, `question number`, `required`) 
                        VALUES  (:contents, :type, :questionnaireID, :questionNumber, :required)");

$stmt->bindParam(":contents",$contents);
$stmt->bindParam(":type",$type);
// TODO we need to replace this with the ID of the person that is logged in
$stmt->bindParam(":questionnaireID",$id);
$stmt->bindParam(":questionNumber",$questionNumber);
$stmt->bindParam(":required",$required);

$id = (int)$_SESSION['id'];
$questionNumber = (int)"1";
$type = "text";
$contents = $_POST['myText'];

// if the question is required to be entered
if(isset($_POST['required'])){
    $required = 0;
}
else{
    $required = 1;
}

$stmt->execute();

return false;
?>