<?php
require_once('../conn.php');

	$sql = "SELECT * FROM answer";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();



	$array1 = array();
	foreach ($result as $row) 
	{
		$array1[] = $row;
	}


	echo json_encode($array1);

	header("Content-type: application/json");
	header("Content-Disposition: attachment; filename=testjson.json");
?>