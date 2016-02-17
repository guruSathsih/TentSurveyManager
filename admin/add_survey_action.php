<?php
	require_once "../functions/functions.php";   
if(isset($_POST))
{
	
	extract($_POST);
	session_start();
	addSurvey($survey_name,$mode,$q_type,$expiry_date,$_SESSION['login']);
	unset($_POST);
	header('Location: add_survey.php'); 
} 
?> 
