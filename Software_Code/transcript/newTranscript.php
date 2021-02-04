<?php
session_start();
require_once('../conn.php');
require('../accountSystem/loginStatus.php');

//submit the title and description and creates the new questionnaire
if(isset($_POST['submit']))
{
    $sql = "CALL createTranscriptReturnID (:name,:description,:creatorID);";
    if ($stmt = $pdo->prepare($sql)) 
    {
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":creatorID", $creatorID, PDO::PARAM_STR);

        $name = $_POST['name'];
        $description = $_POST['description'];
        $creatorID = $_SESSION['UserID'];

        $stmt->execute();
        $result = $stmt->fetchColumn();

        $_SESSION['transcriptID'] = $result;    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <title>Dundata Transcript Tool</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico" />

    <div id="nav-placeholder">

    </div>
</head>

<body>

    <div class="container">
        <div class="row">
            <h1><u>Create a new Transcript</u></h1>
        </div>
        <div class="row" id="imageRow">
            <form method="POST">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Title</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                        placeholder="e.g. Quiz" required>
                </div>
                <div class="form-group">
                    <label for="txtarea">Description</label>
                    <textarea class="form-control" name="description" id="txtarea" rows="3"
                        placeholder="e.g. Description of the meeting and reason for the transcript" required
                        style="margin-bottom: 10px;"></textarea>
                </div>
                <button name="submit" value="Submit" type="submit" class="btn btn-primary">Make a new
                    Transcript</button>
            </form>
        </div>
        <div class="row justify-content-end" id="imageRow">
            <img src="../images/logo.png" class="fix">
        </div>
    </div>
</body>

</html>
<script src="jquery-3.5.1.min.js"></script>
<script>
    $(function () {
        $("#nav-placeholder").load("../navBar.php");
    });
</script>