<?php
session_start();
require('../accountSystem/loginStatus.php');
require_once('../conn.php');
    //SQL that returns the questionnaires and the number of their responses to display 
	$query = "SELECT q.id,q.`name` as `Title`,COUNT(DISTINCT(`participant ID`)) AS `responses` FROM answer a 
INNER JOIN question qn ON a.`question ID` = qn.id 
INNER JOIN questionnaire q ON qn.`questionnaire ID` = q.ID
INNER JOIN questionnaireresearchermap qrm ON qrm.questionnaireID = q.id
WHERE qrm.`researcherID` = :userID
GROUP BY q.id";
	$stmt = $pdo->prepare($query);
    $stmt->bindParam(":userID", $userID, PDO::PARAM_STR);
    $userID = $_SESSION['UserID'];
	$stmt->execute();
	$result = $stmt->fetchall();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
	<title>Export Data</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico"/>
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
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            style="margin-right: 3em;">
                            Hello, <?php if(isset($name)){echo $name;}else{echo "user";}?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../accountSystem/accountDetails.php">Account Details</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../accountSystem/logOut.php">Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <h1><u>Available Questionnaires</u></h1>
        </div>
        <div class="row">
            <?php 
                //loop that displays all questionnaires with number of responses and download button with related ID
				foreach ($result as $row) 
				{
				?>
            <div class="col-md-3">
                <div class="card text-center" id="height">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['Title'];?></h5>
                        <p class="card-text">Number of Responses: <?php echo $row['responses'];?></p>
                        <form method="POST" action="export.php">
                            <button type="submit" class="btn btn-primary" name="download"
                                value="<?php echo $row['id'] ?>">Download Responses</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php 		
				}
			?>
        </div>
        <div class="row justify-content-end" id="imageRow">
            <img src="../images/logo.png" class="fix">
        </div>
    </div>




</body>

</html>