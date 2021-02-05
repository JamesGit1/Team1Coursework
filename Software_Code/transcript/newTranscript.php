<?php
session_start();
require_once('../conn.php');
require('../accountSystem/loginStatus.php');

//SUBMIT THE NEW TRANSCRIPT
if(isset($_POST['submit'])) //POST from submission
{
    //Call pre-definded MySQL procedure, creates a new transcript in the database and required dependancies as well as returing a helpful ID back
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

        header("Location: blankTranscript.php"); //GOTO transcript creation
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
            <h1><u>Create a New Transcript</u></h1>
        </div>
        <div class="row" id="imageRow">
            <form method="POST">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Title</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                        placeholder="e.g. Friday Meetup" required>
                </div>
                <div class="form-group">
                    <label for="txtarea">Description</label>
                    <textarea class="form-control" name="description" id="txtarea" rows="3"
                        placeholder="e.g. Description of the meeting and reason for the transcript" required
                        style="margin-bottom: 10px;"></textarea>
                </div>
                <button name="submit" value="Submit" type="submit" class="btn btn-primary">Make a New
                    Transcript</button>
            </form>
        </div>
        <div class="row justify-content-end" id="imageRow">
            <img src="../images/logo.png" class="fix" style="padding-top: 40px;">
        </div>
    </div>
</body>
</html>

<!-- include relevant jquery then load navbar and rest of bootstrap dependancies-->
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/8741ca18b0.js" crossorigin="anonymous"></script>