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
    <div id="nav-placeholder">

    </div>
</head>

<body>

<div class="container">
    <div class="row">
        <h1><u>Questionnaire Submitted!</u></h1>
    </div>
    <div class="row">
        <div class="linkpage" style="text-align:center;">
            <?php
            // show the link for the new form that has been created
            echo "<button type='button' id='copyText' class='btn btn-primary' onclick='copyToClipboard(`#copyText`)'>https://dundata.azurewebsites.net/Software_Code/formAnswering/" . $link . "</button>";
            ?>
        </div>
    </div>
    <div class="row">
        <a class="btn btn-primary" id="homeButton" href="../dashboard.php">Back to home</a>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    // code to copy the link to the clipboard
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