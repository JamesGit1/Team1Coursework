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

	$sql = "SELECT q.id as `question ID`,a.`participant ID`,a.id,a.contents FROM answer a
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

	$csv = '"questionID", "participantID", "answerID", "contents"';
	$csv.= '
';

	foreach ($result as $row) 
	{ 
		$csv.= '"'.$row['question ID'].'", "'.$row['participant ID'].'", "'.$row['id'].'", "'.$row['contents'].'"';
		$csv.= '
';
	}


	header("Content-type: text/x-csv");
	header("Content-Disposition: attachment; filename=".$csv_filename."");
	echo($csv);
}