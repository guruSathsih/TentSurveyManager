<?php
	session_start();
	require "/functions/functions.php"; 
	if(isset($_POST['opt']) && isset($_SESSION['login']))
	{
		$optionId = $_POST['opt']; 
		$username = $_SESSION['login']; 
		$status = saveSurvey($username,$optionId); 
		if($status)
		{
			echo "Successfully Saved the Survey";
			header ("Location: survey_status.php");
		}else{
			echo "Not Successfully Saved the Survey";
		}
	}else{
		//Lead to error page 
	}	
?>