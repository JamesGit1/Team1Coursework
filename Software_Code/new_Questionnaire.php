<?php 
require_once('conn.php');
session_start();
/*

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
				//redirect
			}else
			{
				echo "Something went wrong. Try again later.";
			}
	}
}
*/
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
        	<h1><u>Create a new Questionnaire</u></h1>
        </div>
        <div class="row" id="imageRow">
	        <form action="blank_Questionnaire.php" method="POST">
	            <div class="form-group">
	                <label for="exampleFormControlInput1">Title</label>
	                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="e.g. Quiz" required>
	            </div>
	            <div class="form-group">
	                <label for="txtarea">Description</label>
	                <textarea class="form-control" name="description" id="txtarea" rows="3"
	                    placeholder="e.g. This is is what the questionnaire is about or something like that"
	                    required style="margin-bottom: 10px;"></textarea>
	            </div>
	            <button value="Submit" type="submit" class="btn btn-primary">Make a new Questionnaire</button>
	        </form>
        </div>
	      <div class="row justify-content-end" id="imageRow">
	      	<img src="logo.png" class="fix">
	    </div>
	</div>
	
	<!--
    <form action="blank_Questionnaire.php" method="POST">
        Title: <input type="text" name="title" placeholder="e.g. Data Collection" required>
        Description: <input type="text" name="description"
            placeholder="e.g. This is is what the questionnaire is about or something like that" required>
        <button value="Submit" type="submit" class="btn btn-primary">Make a new Questionnaire</button>
	</form>
-->
</body>

</html>