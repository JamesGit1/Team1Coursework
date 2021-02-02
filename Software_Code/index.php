<?php
session_start();

require('accountSystem/loginStatus.php');

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <link rel="stylesheet" type="text/css" href="createForm/ethicsStyle.css">
    <title>Dundata</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico"/>
</head>

<nav class="navbar navbar-dark">
    <a class="navbar-brand" href="index.html">
        <img src="images/University_of_Dundee_shield_white.png" width="27" height="37" alt="Uni Logo" style="margin-right: 20px;">Home
    </a>
</nav>

<body>
    <div class="container">
        <div class="row">
            <h1><u id="fade">Welcome to Dundata</u></h1>
        </div>
        <div class="row" id="homepageIcon">
            <div class="col-md-4" align="center">
                <div class="card text-center" id="height">
                    <div class="card-body">
                        <h3 class="card-title">Create a questionnaire</h3>
                        <p class="card-text">Use our create questionnaire tool to help you streamline your questionnaire
                            process</p>
                        <!--href="new_Questionnaire.php"-->
                        <a data-modal-target="#modal" class="btn btn-primary">Create!</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4" align="center">
                <div class="card text-center" id="height">
                    <div class="card-body">
                        <h3 class="card-title">View a questionnaire</h3>
                        <p class="card-text">View all your questionnaire responses on the website</p>
                        <a href="dataViewing/dataViewer.php" class="btn btn-primary">View!</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4" align="center">
                <div class="card text-center" id="height">
                    <div class="card-body">
                        <h3 class="card-title">Export a questionnaire</h3>
                        <p class="card-text">Export your questionnaire responses as CSV files to download</p>
                        <a href="exportData/exportData.php" class="btn btn-primary">Export!</a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end" id="imageRow">
                <img src="images/logo.png" class="fix" id="fade">
            </div>
        </div>
    </div>


    <div class="modal.activate" id="modal">
        <div id="header">
            <div id="title">Ethics Form</div>
            <button data-close-button type="button" class="btn-close btn-close-white" aria-label="Close"></button>
        </div>

        <div id="body">
            <p>By clicking continue you are agreeing with the University of Dundee's ethics form </p>
    
    
            <div id="user_enter">
                <div class="form-outline">
                    <label class="form-label" for="form1">Please enter code</label>
                    <input type="text" id="ethics_txt" class="form-control" />
                  </div> 
              
        </div>
    
            <div id="user-click">
                <div id="checkbox">
                    <input type="checkbox" id="ethics">
                    <label for="ethics">I agree with the ethics form</label>
    
                </div>
                <button type="button" id="continue" class="btn btn-primary" disabled>Continue!</button>
            </div>
        </div>
    </div>
    <div id="overlay"></div>
    </div>
    
    </body>
    </html>

<script src="createForm/ethicsJS.js"></script>