
<?php 
$surveyName = $_REQUEST['s_name']; 
require_once("../database.php");
$hint = "";
$rs = mysql_query("select survey_name from survey where survey_name = '$surveyName'",$cn);  
	if(mysql_num_rows($rs) > 0){
		$hint = "Entered Survey Name is Available Already !!!";
	}
 echo $hint;
?>