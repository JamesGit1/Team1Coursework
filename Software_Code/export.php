<?php  
	require('conn.php');

	$sql = "SELECT * FROM answer";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();

	$csv = '"questionID", "participantID", "answerID", "contents"';
	$csv.= '
	';

	foreach ($result as $row) { 
		$csv.= '"'.$row['question id'].'", "'.$row['participant id'].'", "'.$row['id'].'", "'.$row['contents'].'"';
		$csv.= '
		';
	}


header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=".$csv_filename."");
echo($csv_export);
?>
