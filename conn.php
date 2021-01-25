<?php
try {
	$user = "mysqldbuser@dundata-mysqldbserver"
	$user = "dundata123!"
    $dbh = new PDO('mysql:host=dundata-mysqldbserver.mysql.database.azure.com;dbname=dundatadatabase', $user, $pass);
    
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>