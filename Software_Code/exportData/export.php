<?php
//connection to database
require_once('../conn.php');

//only runs of POST form is not empty 
if(isset($_POST['download']))
{
	$questionnaireID = "";
	if(empty(trim($_POST["download"])))
	{
		echo "";
	} else
	{
		//setting questionnaireID to the variable from the form
		$questionnaireID = trim($_POST["download"]);
	}

	//SQSL Statement which returns all relevant information about the answer and the question a respondant was answering
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

	//gets title of questionnaire 
	foreach ($result as $row) { 
		$title = $row['qrTitle'];
		break;
	}

	//formating CSV
	$csv_filename =$title.'_results_export_'.date('Y-m-d').'.csv';

	$csv = '"'.$title.' Results"';
	$csv.= '
';
	$csv.= '"Question Number", "Question", "Participant ID", "Answer", "Question Type"';
	$csv.= '
';

	foreach ($result as $row) 
	{ 
		$csv.= '"'.$row['question number'].'", "'.$row['contents'].'", "'.$row['participant ID'].'", "'.$row['aContents'].'", "'.$row['type'].'"';
		$csv.= '
';
	}

	//prompt to download
	header("Content-type: text/x-csv");
	header("Content-Disposition: attachment; filename=".$csv_filename."");
	echo($csv);
}