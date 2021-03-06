<!doctype html>
<?php

require('../conn.php');
session_start();

if (isset($_SESSION['UserID'])) {
    header("Location: ../dashboard.php");
}

$username = "";
$username_err = "";

// when the user wants to make a new account, run a query that adds them to the database as a researcher
if (isset($_POST['submitAccount'])) {
    $query = "SELECT ID FROM account WHERE account.`Username` = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $username = $_POST['username'];
    $stmt->execute();
    // if the username is already found in the database, tell the user that this account already exists in the database
    if ($stmt->rowCount() == 1) {
        $username_err = "This username is already taken";
    } else {
        $username = $_POST['username'];
    }

    if (empty($username_err))   // insert the account into the database
    {
        $query = "INSERT INTO account (`firstname`,`Username`,`Password`,`Role`, `lastname`) VALUES (:name,:username,:password,'researcher',:lastname)";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $hashedPassword, PDO::PARAM_STR);

        $name = $_POST['name'];
        $username = $_POST['username'];
        $passEntered = $_POST['password'];
        $hashedPassword = hash('sha256', $passEntered);
        $lastname = $_POST['lastname'];

        $stmt->execute();
        unset($stmt);

        header("Location: logIn.php");
    }
}

?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <title>Register Now</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico"/>
</head>

<body class="text-center" id="background">
<div class="cont">
    <!-- a form for signing up as a user -->
    <form class="form-signin" method="POST">
        <img class="mb-4" src="../images/University_Of_Dundee_shield.png" alt="" width="72" height="100">

        <h1 class="h3 mb-3 font-weight-normal">Please register with Dundata</h1>

        <input type="text" name="name" id="inputName" class="form-control" placeholder="firstname" required autofocus>
        <input type="text" name="lastname" id="inputLastname" class="form-control" placeholder="lastname" required
               autofocus>
        <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required
               autofocus>
        <span class="help-block"><?php echo $username_err; ?></span>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submitAccount">Sign up</button>
    </form>
</div>
</body>

</html>
