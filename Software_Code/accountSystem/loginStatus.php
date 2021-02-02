<?php

if(!isset($_SESSION["loggedIn"])|| $_SESSION["loggedIn"] !==true)
{
    header("location: ../accountSystem/logIn.php");
    exit;
}

?>