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
		foreach ($result as $row) 
		{
			echo $row['id'];
			echo $row['contents'];
			echo $row['question ID'];
			echo $row['participant ID'];
		}
	?>
	<button name="download">Download</button>
</body>
</html>