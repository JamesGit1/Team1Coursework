<?php  
	require('conn.php');

	$sql = "SELECT * FROM answer";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Export data</title>
</head>
<body>
	<?php
		$array1 = array();
		foreach ($result as $row) 
		{
			$array1[] = $row
		}

		echo json_encode($emparray);
	?>
	<button name="download">Download</button>
</body>
</html>