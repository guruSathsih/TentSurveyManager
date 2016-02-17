<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head> 
	<title>Surveys</title>  
	<?php require_once "js_css_files.html"; ?>
<script type="text/javascript">
var status = true; 
</script>  
</head> 

<body>
<div data-role="page">
	<div data-role="header" data-theme="a">
		<?php 
		 include("/functions/functions.php");  
		include("header.php");  
		include("toolbar.php");  
		?> 
	</div>
	<div data-role="main" class="ui-content body-style"  data-theme="a"> 
		 	<h2 class="style8"><center>Survey</center></h2>
		 <br />
		
		<div data-role="collapsible-set" data-theme="a" data-content-theme="a" data-iconpos="right" data-collapsed-icon="arrow-r" data-expanded-icon="arrow-d" data-mini="true">
			
			<?php
				$rs = getSurvey();
				$no_of_row = mysql_num_rows($rs);
				if($no_of_row == 0)
				{
					echo "<center><h4><marquee><font color='red'>Admin Has Not Added Any Survey to Vote For !!!</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='red'>Admin Has Not Added Any Survey to Vote For !!!</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='red'>Admin Has Not Added Any Survey to Vote For !!!</font></marquee></h4></center>";
				}
				while($row=mysql_fetch_array($rs))
				{
					if($row[3] == '2')
					{
			?>
					<div data-role="collapsible" data-theme="b" data-content-theme="a">
					
					<?php }else{?>
						<div data-role="collapsible">
					<?php }?>
						<h3><?php echo "$row[1]"; ?></h3>
						<p>SurveyMode: <?php  if($row[3] == '1'){echo "Open"; }else{ echo "Closed";}?></p>
						<p>Will be closed with in <?php $s_time = date_parse($row[5]);?></p>  
						<table id="<?php echo $row[0];?>">  
							<tr>
								<td class="countdown"><span id="day<?php echo $row[0];?>"><?php echo $s_time['day']; ?></span></td>
								<td class="countdown"><span id="hour<?php echo $row[0];?>"><?php echo $s_time['hour']; ?></span></td>
								<td class="countdown"><span id="min<?php echo $row[0];?>"><?php echo $s_time['minute']; ?></span></td>
								<td class="countdown"><span id="sec<?php echo $row[0];?>"><?php echo $s_time['second']; ?></span></td>
							</tr>	
							<tr>
								<td class="countdown2">Days</td>
								<td class="countdown2">Hours</td>
								<td class="countdown2">Mins</td>
								<td class="countdown2">Secs</td>
							</tr>	
						</table>
						<?php 
						if($row[3] == '1')
						{
							$questions = getQuestions($row[0]);
							while($data = mysql_fetch_array($questions))
							{  
							?>
								<ul data-role="listview" data-theme="b" data-inset="true"  data-mini="true">
									<li>
										<?php if(isVoted($_SESSION['login'],$data[0]) == 1)
											{
										?> 
												<a href="#myPopup" data-rel="popup" data-transition="flow"> 
													<?php echo"$data[1]"; ?>&nbsp;<font color="red">|</font>&nbsp;<font color="06B9FF">You have Already Voted!!!</font>
												</a>
												 
										<?php
											}else{
										?>
												<a href="/TSM/vote4survey.php?queid=<?php echo $data[0] ?>"> 
												<?php echo"$data[1]"; ?>
												</a>
										<?php
											}
										?>	
									</li>
								</ul>
							<?php } 
						} ?>
						</div>
				<?php 
					}
				?>	  
    
				<div data-role="popup" id="myPopup">
				  <p>You have already Voted For This event !!! &nbsp;<a href="all_survey_status.php" data-ajax="false">Click Here</a>To Look at the Survey Status</p>
				</div> 

		</div>	 
		
	</div>
	
	 
</div> 
</div>
<script src="/TSM/js/countdown.js"></script>  
</body>
</html> 