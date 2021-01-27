<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style.css">

  <title></title>
</head>

<body>
	<nav class="navbar navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Home</a>
      </div>
    </nav>
	<div class="container">
	  <div class="row">
	    <div class="col-md-auto">
	    	<h1><u>Create a new Questionnaire</u></h1>
	    	<form action="" method="POST">
	    		Title: <input type="text" name="title" placeholder="e.g. Data Collection" required>
	    		Description: <input type="text" name="description" placeholder="e.g. This is is what the questionnaire is about or something like that" required>
    			<button value ="submit"  name="submit" type="submit" class="btn btn-primary">Make a new Questionnaire</button>
			</form>
	    </div>
	  </div>
	</div>
</body>
</html>

<?php
	require_once('conn.php');
	session_start();
	date_default_timezone_set('Europe/London');

	if(isset($_POST['submit']))
	{
		$title = $description = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
		    $sql = "CALL createFormReturnID (:title,:dateopened,'1',:description);";
		    if ($stmt = $pdo->prepare($sql)) {
		        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
		        $stmt->bindParam(":dateopened", $datetime, PDO::PARAM_STR);
		        $stmt->bindParam(":description", $description, PDO::PARAM_STR);

		        $datetime = date('Y/m/d h:i:s', time());

		        $title = $_POST['title'];
		        $description = $_POST['description'];

		        $stmt->execute();
		        $result = $stmt->fetchColumn();
				
				$_SESSION['id'] = $result;
				header('Location: blank_Questionnaire.php');
		    }
		}
	}
?>

