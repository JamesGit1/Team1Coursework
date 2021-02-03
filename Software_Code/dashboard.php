<?php
session_start();
if(isset($_SESSION['name'])){
    $name = $_SESSION['name'];
}
if(!isset($_SESSION["loggedIn"])|| $_SESSION["loggedIn"] !==true)
{
    
    header("location: accountSystem/logIn.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <link rel="stylesheet" type="text/css" href="createForm/ethicsStyle.css">

    <title>Dundata Dashboard</title>

    <link rel="icon" type="image/x-icon" href="images/favicon.ico" />
</head>

<nav class="navbar navbar-expand navbar-dark">
  <div class="container-fluid">
  <a class="navbar-brand" href="dashboard.php" id="logo">
        <img src="images/University_of_Dundee_shield_white.png" width="27" height="37" alt="Uni Logo"
            style="margin-right: 20px;">Home
    </a>
      <form class="d-flex">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">  
          <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" style="margin-right: 3em;">
            Hello, <?php if(isset($name)){echo $name;}else{echo "user";}?>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="accountSystem/accountDetails.php">Account Details</a></li>
            <?php if ($_SESSION["role"] == "labmanager") {
                echo '<li><a class="dropdown-item" href="accountSystem/manageUsers.php">Manage Researchers</a></li>';
            } ?>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="accountSystem/logOut.php">Log Out</a></li>
          </ul>
        </li>
      </ul>
      </form>
  </div>
</nav>

<body>
    <div class="container">
        <div class="row">
            <h1><u id="fade">Welcome to Dundata</u></h1>
        </div>
        <div class="row" id="homepageIcon">
            <div class="col-md-4 col-sm-6" align="center">
                <div class="card text-center" id="height">
                    <div class="card-body">
                        <div class="row" id="imageRow">
                            <h3 class="card-title">Create a questionnaire</h3>
                        </div>
                        <div class="row" id="imageRow">
                            <p class="card-text">Use our create questionnaire tool to help you streamline your questionnaire
                            process</p>
                        </div>
                        <!--href="new_Questionnaire.php"-->
                        <div class="row" id="imageRow">
                            <a data-modal-target="#modal" class="btn btn-primary">Create!</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" align="center">
                <div class="card text-center" id="height">
                    <div class="card-body">
                        <div class="row" id="imageRow">
                            <h3 class="card-title">View a questionnaire</h3>
                        </div>
                        <div class="row" id="imageRow">
                            <p class="card-text">View all your questionnaire responses on the website</p>
                        </div>
                        <div class="row" id="imageRow">
                            <a href="dataViewing/dataViewer.php" class="btn btn-primary">View!</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" align="center">
                <div class="card text-center" id="height">
                    <div class="card-body">
                        <div class="row" id="imageRow">
                            <h3 class="card-title">Export a questionnaire</h3>
                        </div>
                        <div class="row" id="imageRow">
                            <p class="card-text">Export your questionnaire responses as CSV files to download</p>
                        </div>
                        <div class="row" id="imageRow">
                            <a href="exportData/exportData.php" class="btn btn-primary">Export!</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" align="center">
                <div class="card text-center" id="height">
                    <div class="card-body">
                        <div class="row" id="imageRow">
                            <h3 class="card-title">Analyse a video</h3>
                        </div>
                        <div class="row" id="imageRow">
                            <p class="card-text">Use our analysis tool to help you tag and comment on synchronized videos</p>
                        </div>
                        <!--href="new_Questionnaire.php"-->
                        <div class="row" id="imageRow">
                            <a href="videoStreams/syncStreams.php" class="btn btn-primary">Analyse!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-end" id="imageRow">
            <img src="images/logo.png" class="fix" id="fade">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>