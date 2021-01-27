<?php
require_once('conn.php');
session_start();

$title = $description = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$sql = "INSERT INTO questionnaire (`name`,`creator ID`,`description`)
VALUES (:title,'1',:description);";
	if($stmt = $pdo->prepare($sql))
	{
		$stmt->bindParam(":title", $title, PDO::PARAM_STR);
		$stmt->bindParam(":description", $description, PDO::PARAM_STR);

    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt->execute();
	}
}
?>

<link rel="stylesheet" href="questionAppearance.css">
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<!--Navigation bar -->
<nav class="navbar navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Home</a>
  </div>
</nav>

<body>
  <div class="container">
    <div class="row">

      <form>
				<!--Input Boxes to change Form name and descritption -->
				<input type = "text" id = "formName" placeholder="New Form" class="card-title question-title"/>
        <input type = "text" id = "formDescription" placeholder="Enter description of project here" class="card-title question-title"/>
				<!--All question/cards will be placed here when appened-->
        <div id="questionPanel">

        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Add New Question
        </button>

      </form>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Question Type</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <a href="#" id="btnText" data-bs-dismiss="modal" class="btn btn-primary">Text Based</a>
            <a href="#" id="btnRadio" data-bs-dismiss="modal" class="btn btn-primary">Radio Button</a>
            <button type="button" class="btn btn-primary">Drop Down</button>
            <a href="#" id="test" class="btn btn-primary">Test Button</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <img src="logo.png" class="fix">
</body>


</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/8741ca18b0.js" crossorigin="anonymous"></script>
<script src="addQuestions.js"></script>
