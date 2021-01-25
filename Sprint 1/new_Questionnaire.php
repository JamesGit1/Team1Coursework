<?php 
require_once('conn.php');
session_start();

$title = $description = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$sql = "INSERT INTO questionnaire (`name`,`creator ID`,`description`)
VALUES (:title,'1',:description);";
	if($stmt = $mysql->prepare($sql))
	{
		$stmt->bindParam(":title", $param_title, PDO::PARAM_STR);
		$stmt->bindParam(":description", $param_description, PDO::PARAM_STR);

		$param_title = $title;
		$param_description = $description;

		$_SESSION['title'];
		$_SESSION['description'];

		if($stmt->execute())
			{
				header('Location: blank_Questionnaire.html');
			}else
			{
				echo "Something went wrong. Try again later.";
			}
	}
}
?>