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
        $sql = "CALL createFormReturnID (:title,:dateopened,:creatorID,:description);";
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