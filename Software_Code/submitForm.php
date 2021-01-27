<?php
require "conn.php";

if (isset($_POST['submitForm']))
{
    $formName = $_POST['formName'];
    $desc = $_POST['formDesc'];
    $stmt2 = $pdo->prepare("CALL insertQuestionAnswer");
}
?>