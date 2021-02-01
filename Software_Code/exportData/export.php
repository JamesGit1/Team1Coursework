<?php
require_once('../conn.php');

if(isset($_POST['download']))
{
	$questionnaireID = "";
	if(empty(trim($_POST["download"])))
	{
		echo "";
	} else
	{
		$questionnaireID = trim($_POST["download"]);
	}

	$sql = "SELECT q.id as `question ID`,q.`question number`,a.`participant ID`,a.id,a.contents as `aContents`,q.contents, qr.`name` AS `qrTitle`, q.`type` FROM answer a
INNER JOIN question q ON q.id = a.`question ID`
INNER JOIN questionnaire qr ON q.`questionnaire ID` = qr.ID
WHERE q.`questionnaire ID` = :questionnaireID";
	if($stmt = $pdo->prepare($sql))
	{
		$stmt->bindparam(":questionnaireID", $param_questionnaireID, PDO::PARAM_STR);

		$param_questionnaireID = $questionnaireID;

		$stmt->execute();
	}
	
	$result = $stmt->fetchAll();

	foreach ($result as $row) { 
		$title = $row['qrTitle'];
	}

	$csv_filename =$title.'_results_export'.date('Y-m-d').'.csv';

	$csv = '"'.$title.'"';
	$csv.= '"Question Number", "Question", "Participant ID", "Answer", "Question Type"';
	$csv.= '
';

	foreach ($result as $row) 
	{ 
		$csv.= '"'.$row['question number'].'", "'.$row['contents'].'", "'.$row['participant ID'].'", "'.$row['aContents'].'", "'.$row['type'].'"';
		$csv.= '
';
	}


	header("Content-type: text/x-csv");
	header("Content-Disposition: attachment; filename=".$csv_filename."");
	echo($csv);
}