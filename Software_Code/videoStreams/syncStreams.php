<?php

require_once('../conn.php');
session_start();
date_default_timezone_set('Europe/London');

?>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/videoStyle.css">
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
<div id="nav-placeholder">

</div>

<div class="row">

    <h1><u>Sync Video Streams</u></h1>
</div>
<div class="row" id="imageRow">

    <!--Form for submitting-->
    <form action="submitTable.php" id="tableForm" method="post" enctype='multipart/form-data'>

        <!-- Video players and uploaders -->
        <div class="row" id=videoRow1>
            <div class="col-sm">
                <input class="form-control" type="file" accept="video/*" capture="camera" id="fileUpload1"
                       name="videoUpload[]" multiple="multiple">
                <video width="100%" id="player1" controls></video>
            </div>
            <div class="col-sm">
                <input class="form-control" type="file" accept="video/*" capture="camera" id="fileUpload2"
                       name="videoUpload[]" multiple="multiple">
                <video width="100%" id="player2" controls></video>
            </div>
            <div class="col-sm">
                <input class="form-control" type="file" accept="video/*" capture="camera" id="fileUpload3"
                       name="videoUpload[]" multiple="multiple">
                <video width="100%" id="player3" controls></video>
            </div>
        </div>
        <!-- Button that all run onclick function -->
        <div>
            <button class="fas fa-plus btn btn-primary" type="button" onclick="addVideo()" id="addVideo"></button>
            <button class="fas fa-play btn btn-primary" type="button" onclick="playAll()" id="playButton"></button>
            <button class="fas fa-flag btn btn-primary" type="button" onclick="flag()" id="flagButton"></button>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Video 1</th>
                <th scope="col">Video 2</th>
                <th id="column4" scope="col">Video 3</th>
                <th scope="col">Comment</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody id="timeStamps">
            </tbody>

        </table>
        <input type="hidden" id="totalRows" name="totalRows">
        <button type="submit" class="btn btn-primary" name="test" method="post" id="submitForm">Update
        </button>

    </form>

</div>
<div class="row justify-content-end" id="imageRow">
    <img src="../images/logo.png" class="fix">
</div>

</body>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

<script>
    $(function () {
        $("#nav-placeholder").load("../navBar.php");
    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://kit.fontawesome.com/8741ca18b0.js" crossorigin="anonymous"></script>
<script src="videoScript.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">

    </html>
