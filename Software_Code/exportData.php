<?php
	require('conn.php');

	$query = "SELECT q.id,q.`name` as `Title`,COUNT(DISTINCT(`participant ID`)) AS `responses` FROM answer a 
INNER JOIN `questionnaire question map` qqm ON a.`question ID` = qqm.`Question ID` 
INNER JOIN questionnaire q ON qqm.`questionnaire ID` = q.ID
GROUP BY q.id;";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchall();

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
		foreach ($result as $row) 
		{
			echo $row['Title'];
			echo $row['responses'];
	?>
	<form method="POST" action="export.php">
		<button type="submit" name="download" value="<?php echo $row['id'] ?>">Download now!</button>
	</form>
	<? 		
		}
	?>
</body>
</html>