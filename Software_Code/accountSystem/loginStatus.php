<?php

if(!isset($_SESSION["loggedIn"])|| $_SESSION["loggedIn"] !==true)
{
    header("location: logIn.php");
    exit;
}

?>