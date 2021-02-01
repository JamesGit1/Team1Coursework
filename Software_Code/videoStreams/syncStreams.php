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

    <div class="container">
        <div class="row">
            <h1><u>Sync Video Streams</u></h1>
        </div>
        <div class="row" id="imageRow">

            <!--Allow user to upload a video file and thumnail!-->
            <form action="upload.php" method="post" enctype="multipart/form-data"> Select video to upload:
                <input type="file" accept="video/*" name="videoToUpload" id="videoToUpload">
                <input type="submit" value="Submit" name="submit">
            </form>
            <form action="upload.php" method="post" enctype="multipart/form-data"> Select thumbnail to upload:
                <input type="file" name="thumbnailToUpload" id="thumbnailToUpload">
                <input type="submit" value="Submit" name="submit">
            </form>

            <!--Access webcam
            https://www.kirupa.com/html5/accessing_your_webcam_in_html5.htm
            https://www.html5rocks.com/en/tutorials/getusermedia/intro/
            -->
            <div id="container">
                <video autoplay="true" id="videoElement">
                </video>
            </div>

            <!--
                Upload a video and play it.
            https://developers.google.com/web/fundamentals/media/recording-video
            -->
            <input type="file" accept="video/*" capture="camera" id="recorder">
            <video id="player" controls></video>
        </div>
        <div class="row justify-content-end" id="imageRow">
            <img src="../images/logo.png" class="fix">
        </div>
    </div>
</body>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="videoScript.js"></script>

</html>
