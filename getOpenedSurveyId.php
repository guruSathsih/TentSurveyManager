<?php 
	require_once "/functions/functions.php";   
	$rs = getOpenedSurveyIds(); 
	$ids = [];
	while($row = mysql_fetch_array($rs)){
		$ids[] = $row[0]; 
	} 
	echo json_encode($ids);
?>