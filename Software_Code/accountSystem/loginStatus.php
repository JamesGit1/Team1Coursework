<?php
// Set Session variable of name
if(isset($_SESSION['name'])){
    $name = $_SESSION['name'];
}
// Redirects the user if logged in
if(!isset($_SESSION["loggedIn"])|| $_SESSION["loggedIn"] !==true)
{

    header("location: ../accountSystem/logIn.php");
    exit;
}

?>
