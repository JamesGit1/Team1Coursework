<?php
require_once('../conn.php');
session_start();
require('../accountSystem/loginStatus.php');

$link = $_SESSION["questionnaireLink"];
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
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico"/>
</head>

<body>
    <nav class="navbar navbar-dark">
        <a class="navbar-brand" href="../dashboard.php">
            <img src="../images/University_of_Dundee_shield_white.png" width="27" height="37" alt="Uni Logo"
                 style="margin-right: 20px;">Home
        </a>
    </nav>

    <div class="container">
        <div class="row">
            <h1><u>Questionnaire Submitted!</u></h1>
        </div>
        <div class="row">
            <div class="linkpage" style="text-align:center;">
                <?php 
                echo "<button type='button' id='copyText' class='btn btn-primary' onclick='copyToClipboard(`#copyText`)'>https://dundata.azurewebsites.net/Software_Code/formAnswering/".$link."</button>";
            ?>
            </div>
        </div>
        <div class="row">
            <a class="btn btn-primary" id="homeButton" href="../dashboard.php">Back to home</a>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();

        /* Alert the copied text */
        alert("Copied the text!");
    }
    </script>
</body>

</html>