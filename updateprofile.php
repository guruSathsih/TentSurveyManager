<?php
	require_once "functions/functions.php";   
if(isset($_POST))
{
	extract($_POST);  
	updateProfile($f_name,$l_name,$email_id,$re_pass_wd,$gender,$dob,$doj,$userName);
	unset($_POST);
	header('Location: profile.php'); 
} 
?> 
