<?php
	
	
	/*
		DB Manager takes care of the opening and closing a connection when it is requested
	*/ 
	
	function getDBConnection()
	{ 
		//$config = parse_ini_file("../config/smt_config.ini"); 
		//$connection = mysql_connect($config['db_url'],$config['db_username'],$config['db_password']) or die("Could not Connect My Sql"); 
		$connection = mysql_connect("localhost","smadmin","sm@admin") or die("Could not Connect My Sql"); 
		mysql_select_db("pigeon",$connection)  or die("Could not connect to Database");
		return $connection;
	}
	
	function closeConnection($con)
	{
		mysql_close($con);
	} 
?>