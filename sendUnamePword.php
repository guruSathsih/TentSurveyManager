<?php
 	 require_once "/functions/functions.php";   
 	if(isset($_POST))
	{ 
		extract($_POST); 
		$status = sendUsernamePassword($emailid); 
		unset($_POST); 
		echo $status;
	}  
	
?>