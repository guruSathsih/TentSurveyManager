<?php
	require_once "../functions/functions.php";   
if(isset($_POST))
{
	extract($_POST);
	if($_POST['submit']=='Add Event' || strlen($_POST['surveyId'])>0 )
	{ 
		addQuestionAndOptions($ques,$surveyId,$op_1,$op_2,$op_3,$op_4);
	}
	unset($_POST);
	header('Location: add_survey.php'); 
} 
?> 

