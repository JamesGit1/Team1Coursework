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
			$array1[] = $row;
		}

		$fp = fopen('empdata.txt', 'w');
		fwrite($fp, json_encode($array1));
		fclose($fp);
	?>
	<button name="download">Download</button>
</body>
</html>


present json in php and change headers to download automatically