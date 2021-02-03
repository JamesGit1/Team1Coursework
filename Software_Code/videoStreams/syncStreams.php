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
<nav class="navbar navbar-dark">
    <a class="navbar-brand" href="../index.html">
        <img src="../images/University_of_Dundee_shield_white.png" width="27" height="37" alt="Uni Logo"
             style="margin-right: 20px;">Home
    </a>
</nav>

    <div class="row">
        <h1><u>Sync Video Streams</u></h1>
    </div>
    <div class="row" id="imageRow">

        <div class = "row" id=videoRow>
            <div class="col-sm">
                <input class="form-control" type="file" accept="video/*" capture="camera" id="fileUpload1">
                <video width="100%" id="player1" controls></video>
            </div>
            <div class="col-sm">
                <input class="form-control" type="file" accept="video/*" capture="camera" id="fileUpload2">
                <video width="100%" id="player2" controls></video>
            </div>
            <div class="col-sm">
                <input class="form-control" type="file" accept="video/*" capture="camera" id="fileUpload3">
                <video width="100%" id="player3" controls></video>
            </div>
        </div>

        <div>
            <button class="fas fa-plus btn btn-primary" onclick="addVideo()" id="addVideo"></button>
            <button class="fas fa-play btn btn-primary" onclick="playAll()" id="playButton"></button>
            <button class="fas fa-flag btn btn-primary" onclick="flag()" id="flagButton"></button>
        </div>
        <form action="submitTable.php" id="tableForm" method="post">
            <table class="table">
                <thead>
                <tr>
                    <th width="10%" scope="col">#</th>
                    <th width="10%" scope="col">1st Video</th>
                    <th width="10%" scope="col">2nd Video</th>
                    <th width="10%" scope="col">3rd Video</th>
                    <th width="50%" scope="col">Comment</th>
                    <th width="10%" scope="col">Delete</th>
                </tr>
                </thead>
                <tbody id="timeStamps">
                <!-- <tr>
                  <th scope="row">1</th>
                  <td>1</td>
                  <td>2</td>
                  <td>3</td>
                  <td>4</td>
                  <td>5</td>
    <tr>
    <th scope="row">'+ row +'</th>
    <td>'+timestampArray[0]+'</td>
    <td>'+timestampArray[1]+'</td>
    <td>'+timestampArray[2]+'</td>
    <td>rrr</td>
    </tr>
                </tr> -->
                </tbody>

            </table>
            <input type="text" id="totalRows" name="totalRows">
            <button type="submit" class="btn btn-primary" name="submitTable" method="post" id="submitForm">Update
            </button>

        </form>

    </div>
    <div class="row justify-content-end" id="imageRow">
        <img src="../images/logo.png" class="fix">
    </div>

</body>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://kit.fontawesome.com/8741ca18b0.js" crossorigin="anonymous"></script>
<script src="videoScript.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">

    </html>
