<?php 
	require_once "../functions/functions.php";   
	extract($_POST);
	if(isset($survey_id))
	{	
		updateSurvey($survey_id,$survey_name,$mode,$q_type,$expiry_date);
		echo "Y";
	}else{ 
		echo "N";
	}
?>