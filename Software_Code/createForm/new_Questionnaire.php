<?php
session_start();
require_once('../conn.php');
require('../accountSystem/loginStatus.php');

date_default_timezone_set('Europe/London');

//submit the title and description and creates the new questionnaire
if(isset($_POST['submit']))
{
    $title = $description = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $sql = "CALL createFormReturnID (:title,:dateopened,:creatorID,:description,9999);";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":title", $title, PDO::PARAM_STR);
            $stmt->bindParam(":dateopened", $datetime, PDO::PARAM_STR);
            $stmt->bindParam(":creatorID", $creatorID, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);

            $datetime = date('Y/m/d h:i:s', time());

            $title = $_POST['title'];
            $description = $_POST['description'];
            $creatorID = $_SESSION['UserID'];

            $stmt->execute();
            $result = $stmt->fetchColumn();

            $_SESSION['id'] = $result;
            header('Location: blank_Questionnaire.php');
        }
    }
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
    <title>Dundata</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico" />

    <div id="nav-placeholder">
    
    </div>
</head>

<body>

    <div class="container">
        <div class="row">
            <h1><u>Create a new Questionnaire</u></h1>
        </div>
        <div class="row" id="imageRow">
            <form method="POST">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Title</label>
                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1"
                        placeholder="e.g. Quiz" required>
                </div>
                <div class="form-group">
                    <label for="txtarea">Description</label>
                    <textarea class="form-control" name="description" id="txtarea" rows="3"
                        placeholder="e.g. This is is what the questionnaire is about or something like that" required
                        style="margin-bottom: 10px;"></textarea>
                </div>
                <button name="submit" value="Submit" type="submit" class="btn btn-primary">Make a new
                    Questionnaire</button>
            </form>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>
