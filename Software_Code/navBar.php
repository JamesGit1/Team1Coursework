<?php
require_once('conn.php');
session_start();
require('accountSystem/loginStatus.php');
?>
<nav class="navbar navbar-expand navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php" id="logo">
            <img src="../images/University_of_Dundee_shield_white.png" width="27" height="37" alt="Uni Logo"
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



