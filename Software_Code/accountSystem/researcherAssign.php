<?php

session_start();
require("loginStatus.php");
require("../conn.php");

$query = "SELECT * FROM account WHERE Role = 'researcher'";
$stmt = $pdo->prepare($query);
$stmt->execute();
$researchers_li = $stmt->fetchAll();
unset($stmt);

$query = "SELECT * FROM questionnaire WHERE `creator ID` = :userID;";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":userID", $userID, PDO::PARAM_STR);
$userID = $_SESSION['UserID'];
$stmt->execute();
$questionnaires_li = $stmt->fetchAll();
unset($stmt);

if (isset($_POST['addResearcher'])) 
{
	$query = "INSERT INTO `questionnaireresearchermap` (`researcherID`,`questionnaireID`) VALUES (:researcherID,:questionnaireID)";
	$stmt = $pdo->prepare($query);
	$stmt->bindParam(":researcherID", $extraResearcher, PDO::PARAM_STR);
	$stmt->bindParam(":questionnaireID", $questionnaireID, PDO::PARAM_STR);

	$extraResearcher = $_POST['selectResearcher'];
	$questionnaireID = $_POST['addResearcher'];

	$stmt->execute();
	unset($stmt);

	header("Refresh:0");

}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"
        integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
        crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico"/>
	<title>Assign Researchers</title>
</head>
<body>
	<nav class="navbar navbar-expand navbar-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="../dashboard.php" id="logo">
				<img src="../images/University_of_Dundee_shield_white.png" width="27" height="37" alt="Uni Logo"
				style="margin-right: 20px;">Home
			</a>
			<form class="d-flex">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item dropdown">  
					<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" style="margin-right: 3em;">
					Hello, <?php if(isset($name)){echo $name;}else{echo "user";}?>
					</a>
						<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="accountDetails.php">Account Details</a></li>
							<?php if ($_SESSION["role"] == "labmanager") {
							echo '<li><a class="dropdown-item active" href="manageUsers.php">Manage Researchers</a></li>';
							} ?>
							<li><hr class="dropdown-divider"></li>
							<li><a class="dropdown-item" href="logOut.php">Log Out</a></li>
						</ul>
					</li>
				</ul>
			</form>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<h1><u>Assign Researchers</u></h1>
		</div>
		<?php foreach($questionnaires_li as $questionnaire)
		{ 
		?>
			<div class="row" id="assignRow">
				<div class="card">
					<div class="card-body">
						<div class="row" id="imageRow">
							<div class="col-md-4">
								<h4><?php echo $questionnaire['name'] ?></h4>
								<p><?php echo $questionnaire['description'] ?></p>
							</div>
							<div class="col-md-4">
								<h4>Current Researchers</h4>
								<ul>
								<?php 
									$query = "SELECT Username FROM questionnaireresearchermap qrm INNER JOIN `account` a ON qrm.`researcherID` = a.ID WHERE qrm.`questionnaireID` = :questionnaireID;";
									$stmt = $pdo->prepare($query);
									$stmt->bindParam(":questionnaireID", $questionnaireID, PDO::PARAM_STR);
									$questionnaireID = $questionnaire['ID'];
									$stmt->execute();
									$currentResearchers = $stmt->fetchAll();
									unset($stmt);
									foreach ($currentResearchers as $person) 
										{
										?>
											<li><?php echo $person['Username'] ?></li>
										<?php
										}
								?>
								</ul>
							</div>
							<div class="col-md-4">
								<h4>Add a Researcher</h4>
								<form method="POST">
									<div class="select">
										<select name="selectResearcher">
											<option value="" disabled selected>Choose a researcher...</option>
										<?php foreach($researchers_li as $researcher) 
										{
										?>
											<option value="<?php echo $researcher['ID'] ?>"><?php echo $researcher['Username'] ?></option>
										<?php 
										} 
										?>
										</select>
									</div>	
									<button class="btn btn-primary" name="addResearcher" value="<?php echo $questionnaire['ID'] ?>">Add</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php 
		} 
		?>	
		<div class="row justify-content-end" id="imageRow">
            <img src="../images/logo.png" class="fix" id="fade">
        </div>
	</div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>