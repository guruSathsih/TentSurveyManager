<?php
	require_once "../functions/functions.php";   
if(isset($_GET))
{
	extract($_GET); 
	deleteUser($emailid);
	unset($_GET);
	header('Location: /TSM/admin/updateuser-admin.php');  
	return true;
} 
?>  