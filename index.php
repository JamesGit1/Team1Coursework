<?php

$host = 'dundata-mysqldbserver.mysql.database.azure.com';
$db   = 'dundatadatabase';
$user = 'mysqldbuser@dundata-mysqldbserver';
$pass = 'dundata123!';
$port = "3306";
$charset = 'utf8mb4';

$options = [
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES   => false,
];
$dsn = "mysql:host=$host;dbname=$db";
try {
     $pdo = new \PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
echo 'Current PHP version: ' . phpversion();
echo "SUP NERDS!";
?>