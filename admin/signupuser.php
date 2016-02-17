<?php
	require_once "../functions/functions.php";   
if(isset($_POST))
{
	extract($_POST); 
	addUser($f_name,$l_name,$emp_no,$email_id,$re_pass_wd,$gender,$designation,$dob,$doj,$app_email_id,$user_type);
	unset($_POST);
	header('Location: add_survey.php'); 
} 
?> 
