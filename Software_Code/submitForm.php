<?php
require "conn.php";

/* In order to submit the form, we have to loop through each question and submit its data.
 this means that we need to know the number of questions that we have, and for the radio buttons question we
 need to know the number of options that this has.
 This might have to be done in JavaScript for the looping through the questions and options and running the form
 each time. */

if (isset($_POST['submitForm']))
{
    $formName = $_POST['formName'];
    $desc = $_POST['formDesc'];
    foreach ($_POST['questionNumber'+3] as $question){

    }
    $stmt2 = $pdo->prepare("CALL insertQuestionAnswer");
}
?>