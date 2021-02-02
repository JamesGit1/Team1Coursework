<?php
if(isset($_SESSION['name'])){
    $name = $_SESSION['name'];
}
if(!isset($_SESSION["loggedIn"])|| $_SESSION["loggedIn"] !==true)
{
    
    header("location: ../accountSystem/logIn.php");
    exit;
}

?>