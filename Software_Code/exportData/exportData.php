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
    <div id="nav-placeholder">

    </div>
</head>

<body>

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
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

<script>
    $(function () {
        $("#nav-placeholder").load("../navBar.php");
    });
</script>