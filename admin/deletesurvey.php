<?php
	require_once "../functions/functions.php";   
if(isset($_GET))
{
	extract($_GET); 
	deleteSurvey($surveyId);
	unset($_GET);
	header('Location: /TSM/admin/add_survey.php');  
	return true;
} 
?>  