<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head> 
	<title>Vote For Survey</title> 
	<?php require_once "js_css_files.html"; ?> 
</head> 

<body>
<div data-role="page">
	<div data-role="header" data-theme="a">
		<?php
		include("/functions/functions.php"); 
		include("header.php");  
		include("toolbar.php");  
		
		$queId = $_GET['queid']; 
		$userName = $_SESSION['login']; 
		?> 
	</div>
	<div data-role="content"  class="body-style" data-theme="a"> 
		 <?php  
			$question = getQuestionById($queId);
			$options = getOptionsByQuestionId($queId);
		 ?>  
		
		 <form  action="save_survey.php" method="post" data-ajax="false">
		 	
		 	<table align="center"> 
				
				<caption>
					 <img src="/TSM/images/voting.jpg"/>
					<p><strong><legend><?php echo "$question"; ?></legend></strong></p>
				</caption>
				<tr>
					<td>
						<input type="radio" data-mini="true" name="opt" id="op1" value="<?php echo $options['op_id_0']?>" data-theme="b" checked="checked"><label for="op1"><?php echo $options['option_0']?></label> 
					</td>
					<td>
						<input type="radio" data-mini="true" name="opt" id="op2" value="<?php echo $options['op_id_1']?>" data-theme="b" ><label for="op2"><?php echo $options['option_1']?></label> 
					</td>
				</tr>
				<tr>
					<td>
						<input type="radio" data-mini="true" name="opt" id="op3" value="<?php echo $options['op_id_2']?>" data-theme="b"><label for="op3"><?php echo $options['option_2']?></label> 
					</td>
					<td>
						<input type="radio" data-mini="true" name="opt" id="op4"  value="<?php echo $options['op_id_3']?>" data-theme="b"><label for="op4"><?php echo $options['option_3']?></label> 
					</td>
				</tr>
			</table>
		 	<center><input type="submit"  value="Vote" data-icon="check" data-inline="true" data-theme="b"/>		</center>
		 </form>
	</div>	 
	 <?php include "footer.html";?>
</div>
</body>
</html> 