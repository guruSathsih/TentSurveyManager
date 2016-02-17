<?php
	require_once "../functions/functions.php";   
if(isset($_POST))
{
	extract($_POST);
	if($_POST['submit']=='Update Event' || strlen($_POST['surveyId'])>0 )
	{
		print_r($_POST);
		$status = udpateQuestionAndOptions($queId,$ques,$surveyId,$op_1,$op_2,$op_3,$op_4,$opt_1_id,$opt_2_id,$opt_3_id,$opt_4_id); 
	}
	unset($_POST);
	header('Location: add_survey.php'); 
} 
?> 