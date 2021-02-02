<?php
require_once('../conn.php');
session_start();
require('loginStatus.php');

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
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
            <a class="navbar-brand" href="index.html" id="logo">
                <img src="../images/University_of_Dundee_shield_white.png" width="27" height="37" alt="Uni Logo"
                    style="margin-right: 20px;">Home
            </a>
            <form class="d-flex">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" style="margin-right: 3em;">
                            Hello, <?php if(isset($username)){echo $username;}else{echo "user";}?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="accountDetails.php">Account Details</a>
                            </li>
                            <li><a class="dropdown-item" href="#">Something</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logOut.php">Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <h1><u>Account Details</u></h1>
        </div>
        <div class="row">
            <div class="col-4">
                <h2>Name:</h2>
                <h2>Username:</h2>
                <h2>Password:</h2>
            </div>
            <div class="col-8">
                <h2>Name</h2>
                <h2>Username</h2>
                <h2>*********</h2>
            </div>
        </div>
        <div class="row justify-content-end">
            <!-- Button trigger modal -->
            <div class="button-holder" style="justify-content:flex-end;display:flex;">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">
                        Edit
                    </button>
                </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Body -->
                        <form class="row g-3" style="padding-top: 0px;">
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Name</label>
                                <input type="text" class="form-control" id="inputAddress">
                            </div>
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Username</label>
                                <input type="text" class="form-control" id="inputAddress" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Old Password</label>
                                <input type="email" class="form-control" id="inputEmail4">
                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword4" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="inputPassword4">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                        <!-- Form Body End -->
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
</body>

</html>