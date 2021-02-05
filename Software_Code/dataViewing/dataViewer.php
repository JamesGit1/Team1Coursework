<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php
session_start();
require('../accountSystem/loginStatus.php');
require_once('../conn.php'); // initilise conneciton to the database

// Gets questionnaire details depending on the questionnaire id
$query = "SELECT qr.ID as `questionnaireID`,qr.`name` as `questionnaireTitle` FROM questionnaire qr
INNER JOIN questionnaireresearchermap qrm ON qr.ID = qrm.`questionnaireID`
WHERE qrm.researcherID = :userID;";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":userID", $userID, PDO::PARAM_STR);
$userID = $_SESSION['UserID'];
$stmt->execute();
$ownedQuestionnaires = $stmt->fetchAll();
unset($stmt);

// When button is pressed start searching questionnaire
if (!(isset($_POST['searchQuestionnaire'])))
{
    $query = "SELECT q.`question number`,a.`participant ID`,q.`Type`,q.Contents,a.contents FROM questionnaire qr
    INNER JOIN question q ON q.`questionnaire ID` = qr.ID
    INNER JOIN answer a ON a.`question ID` = q.ID
    INNER JOIN questionnaireresearchermap qrm ON qr.ID = qrm.`questionnaireID`
    WHERE qrm.researcherID = :userID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":userID", $userID, PDO::PARAM_STR);
    $userID = $_SESSION['UserID'];
    $stmt->execute();
    $searchResults = $stmt->fetchAll();
    unset($stmt);

    $searchName = "Showing all responses";
}
// When button is pressed start searching questionnaire
if (isset($_POST['searchQuestionnaire']))
{
    $query = "SELECT q.`question number`,a.`participant ID`,q.`Type`,q.Contents,a.contents FROM questionnaire qr
    INNER JOIN question q ON q.`questionnaire ID` = qr.ID
    INNER JOIN answer a ON a.`question ID` = q.ID
    INNER JOIN questionnaireresearchermap qrm ON qr.ID = qrm.`questionnaireID`
    WHERE qrm.`researcherID` = :userID and qr.ID = :questionnaireID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":userID", $userID, PDO::PARAM_STR);
    $stmt->bindParam(":questionnaireID", $questionnaireID, PDO::PARAM_STR);
    $userID = $_SESSION['UserID'];
    $questionnaireID = $_POST['questionnaireID'];
    $stmt->execute();
    $searchResults = $stmt->fetchAll();
    unset($stmt);

    $query = "SELECT qr.`name` FROM questionnaire qr
    WHERE qr.ID = :questionnaireID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":questionnaireID", $questionnaireID, PDO::PARAM_STR);
    $questionnaireID = $_POST['questionnaireID'];
    $stmt->execute();
    $searchName = $stmt->fetchColumn();
    unset($stmt);
}



?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"
        integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
        crossorigin="anonymous"></script>
    <title>Dundata</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico"/>
</head>

<body>

    <div id="nav-placeholder">

    </div>
    <div class="container">
        <div class="row">
            <h1><u>View Questionnaires</u></h1>
        </div>
        <div class="row" id="imageRow">
            <div class="dropdown">
                <form method="POST">
                    <select name="questionnaireID">
                        <option value="" disabled selected>Choose a questionnaire...</option>
                        <?php foreach ($ownedQuestionnaires as $questionnaire)
                        {
                        ?>
                            <option value="<?php echo $questionnaire['questionnaireID'] ?>"><?php echo $questionnaire['questionnaireID'].": ".$questionnaire['questionnaireTitle'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <button class="btn btn-success" type="submit" name="searchQuestionnaire">Search</button>
                </form>
            </div>

            <div class="table-responsive">
                <h4><?php echo $searchName ?></h4>
                <table id="dtable" class="table" ;>
                    <thead>
                        <tr> <!-- Table Titles -->
                            <th>Question Number</th>
                            <th>Participant ID</th>
                            <th>Question Type</th>
                            <th>Question</th>
                            <th>Response</th>
                        </tr>
                    </thead>
                    <tbody id="dataTable">
                       <?php // Fill table with the relevant data from sql request
                            foreach($searchResults as $row) {?>
                       <tr>
                        <?php
                                echo "<td>".$row['question number']."</td>";
                                echo "<td>".$row['participant ID']."</td>";
                                echo "<td>".$row['Type']."</td>";
                                echo "<td>".$row['Contents']."</td>";
                                echo "<td>".$row['contents']."</td></tr>";
                         ?>

                        </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>
