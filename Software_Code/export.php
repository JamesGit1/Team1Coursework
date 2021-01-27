<?php  
	require('conn.php');

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

	$sql = "SELECT q.id as `question ID`,q.`question number`,a.`participant ID`,a.id,a.contents as `aContents`,q.contents FROM answer a
INNER JOIN question q ON q.id = a.`question ID`
WHERE q.`questionnaire ID` = :questionnaireID";
	if($stmt = $pdo->prepare($sql))
	{
		$stmt->bindparam(":questionnaireID", $param_questionnaireID, PDO::PARAM_STR);

		$param_questionnaireID = $questionnaireID;

		$stmt->execute();
	}
	
	$result = $stmt->fetchAll();
	$csv_filename = 'db_export_'.date('Y-m-d').'.csv';

	$csv = '"Question Number", "Question", "Participant ID", "Answer"';
	$csv.= '
';

	foreach ($result as $row) 
	{ 
		$csv.= '"'.$row['question number'].'", "'.$row['contents'].'", "'.$row['participant ID'].'", "'.$row['aContents'].'"';
		$csv.= '
';
	}


	header("Content-type: text/x-csv");
	header("Content-Disposition: attachment; filename=".$csv_filename."");
	echo($csv);
}