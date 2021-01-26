<?php  
	require('conn.php');

	$sql = "SELECT * FROM answer";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();

	$csv_filename = 'db_export_'.date('Y-m-d').'.csv';

	$csv = '"questionID", "participantID", "answerID", "contents"';
	$csv.= '
	';

	foreach ($result as $row) { 
		$csv.= '"'.$row['question ID'].'", "'.$row['participant ID'].'", "'.$row['id'].'", "'.$row['contents'].'"';
		$csv.= '
		';
	}


header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=".$csv_filename."");
echo($csv);
?>
