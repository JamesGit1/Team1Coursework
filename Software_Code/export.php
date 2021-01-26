<?php  
	require('conn.php');

	$sql = "SELECT * FROM answer";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();

	$csv_export = '';
	$field = mysql_num_fields($query);

	for ($i=0; $i < $field; $i++) { 
		$csv_export.=mysql_field_name($query, $i).',';
	}

	$csv_export.= '
	';

	while($row = mysql_fetch_array($query)) {
	  for($i = 0; $i < $field; $i++) {
	    $csv_export.= '"'.$row[mysql_field_name($query,$i)].'",';
	  }	
	  $csv_export.= '
	';	
}
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=".$csv_filename."");
echo($csv_export);
?>
