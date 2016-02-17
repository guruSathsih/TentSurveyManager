<?php 
	session_start();   
	if(!isset($_SESSION['login']))
	{ 
		header("Location:/TSM/index.php");
	}
?>  
<!--<div data-role="header" style="background-color: #55ACEE;height: 80px">   
<!--<?php 
	session_start();   
	if(!isset($_SESSION['login']))
	{ 
		header("Location:/TSM/index.php");
	}
?>  
 
</div>-->
