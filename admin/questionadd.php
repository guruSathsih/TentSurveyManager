<?php
session_start();
require("../database.php");

error_reporting(1);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
<head>
<title>Add Survey</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../quiz.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
</head> 
<body>
<div data-role="page" data-theme="a" >
<?php 
	 include("header.php");
 echo "<BR><h3 class=head1>Add Question </h3>";
	extract($_GET);  
   if(count($_GET) != 0){
	if($added)
	{?>
	  <p class="head1">Question Added to the Survey Successfully </p>
<?php 
	}else{ ?>
		<p class="head1">Question Not Added to the Survey Successfully </p>
<?php	}
 }

?> 

<div style="margin:auto;width:90%;height:500px;box-shadow:2px 1px 2px 2px #CCCCCC;text-align:left">
<form name="addQuestion" method="post" onSubmit="return check();" action="questionadd_action.php">
  <table width="80%"    align="center">
    <tr>
      <td width="24%" height="32"><div align="left"><strong>Survey Name </strong></div></td>
      <td width="1%" height="5">  
      <td width="75%" height="32">
		  <select name="surveyId" id="surveyId">
			<?php
			$rs=getOpenedSurveys();
				  while($row=mysql_fetch_array($rs))
				{ 
					echo "<option value='$row[0]'>$row[1]</option>"; 
				}
			 
			?>
		 </select>
	<tr>
        <td height="26"><div align="left"><strong> Question </strong></div></td>
        <td>&nbsp;</td>
	    <td><textarea name="ques" cols="60" rows="2" id="ques" required oninvalid="this.setCustomValidity('Minimum 10 characters required')" autofocus="on"></textarea></td>
    </tr>
    <tr>
      <td height="26"><div align="left"><strong>Option 1</strong></div></td>
      <td>&nbsp;</td>
      <td><input name="op_1" type="text" id="op_1" size="85" maxlength="85" required></td>
    </tr>
    <tr>
      <td height="26"><strong>Option 2</strong></td>
      <td>&nbsp;</td>
      <td><input name="op_2" type="text" id="op_2" size="85" maxlength="85" required></td>
    </tr>
    <tr>
      <td height="26"><strong>Option 3 </strong></td>
      <td>&nbsp;</td>
      <td><input name="op_3" type="text" id="op_4" size="85" maxlength="85" required></td>
    </tr>
    <tr>
      <td height="26"><strong>Option 4</strong></td>
      <td>&nbsp;</td>
      <td><input name="op_4" type="text" id="op_4" size="85" maxlength="85" required></td>
    </tr> 
    <tr>
      <td height="26"></td>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Add Question to Survey" /></td>
    </tr>
  </table> 
</form>
<p>&nbsp; </p>
</div>
</div>
</body>
</html>