<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
<head>
<title>Tent Survey Manager|Vote For Events</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="quiz.css" rel="stylesheet" type="text/css"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> 
<script src="/TSM/js/survey.js"></script>
<script type="text/javascript">
var status = true; 
</script>  
</head>
<style>
	.gridA
	{
		width:40%;
	}
	.gridB
	{
		width:70%;
	}
</style>
<body>
<div data-role="page"> 
<div data-role="header"> 
	 
	<div class="menu-wrapper single-page-nav clearfix">
			<div class="menu-wrapper-bg">
				<div class="container">
					<div class="row"> 		
						<div class="col-lg-3 col-md-3">
							<!-- logo -->
							<div class="logo">
							<div class="logo-header">
								<font style="color:#ffffff;font-weight: 100 !important;letter-spacing: 2px;font-size:25px">TentSurveyManager</font>
		                     	<p style="color:#ffffff !important;font-weight: 100 !important;letter-spacing: 2px;">Vote For Events</p>
								
							 </div>	 	                 
							</div>		
						</div>
 

					</div>
				</div>
			</div> 
	</div>
	
<div> 
	<!--<img src="images/online_vote.png" width="1100" height="600"/>-->
	<img src="images/online-voting-slider.jpg" width="1600" height="500"/>
</div>
<?php
session_start();
include("/functions/functions.php");
extract($_POST);
if(isset($submit))
{
	authorizeUser($loginid,$pass);
}
?>
</div>
<div data-role="main" class="ui-content index-body-style" data-theme="a" >
   <div align="center">
   		<img src="images/login_key.png" width="100" height="100"/>
   </div>
	<div style="background-color: #ffffff;box-shadow:0 1px 3px rgba(0,0,0,.13)">
		
	 	
		
		 <form action="index.php" method="post" name="loginForm" id="loginForm" data-ajax="false">  
		 	 <table align="center" style="text-align: left;padding:50px;">
			<tr>
			   <td>
				<label for="loginid2">Login ID </label>
				<input name="loginid" type="text" id="loginid2" accesskey="U" tabindex="1" autofocus="autofocus"  required="required" placeHolder="UserName" /> 
				</td>
			</tr>
			<tr>
				<td>
				<label for="pass2">Password</label>
				<input name="pass" type="password" id="pass2" accesskey="P" tabindex="2" required="required" placeHolder="Password"/> 
				</td>
			</tr>
			<tr>
				<td>
				<span class="errors">
						  <?php
						  if(isset($_GET['login']))
					  	{
							echo "Invalid Username or Password";
						  }
						  ?>
				</span>
				</td>
			</tr>
		<tr>
		<td>
			<input name="submit" type="submit" id="submit" accesskey="L" tabindex="3" value="Login" class="ui-btn-inline" data-ajax="false"/>    
			</td>
		</tr>
		<tr>
			<td>
			<span class="style4">New User ? Inform Site Admin to add you !!!</span>
			</td>
		</tr>
		<tr>
			<td>
			<span class="style4"><a href="#forgotPassword" data-rel="popup" data-transition="flow"  >Forgot password ?</a></span>
			</td>
		</tr>
		 </table>
		</form> 
	   
	</div>
	<div data-role="popup" id="forgotPassword" data-overlay-theme="a" data-rel="back">
			 		<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
					<div data-role="header" data-theme="b">
						<h2>Forgot Password</h2>
					</div>
					<br/>
					<div data-role="content" data-theme="a"> 
						 <span id="success" style="display: none;color:green"/>Email Sent Successfully!!!</span>
						 <span id="error" style="display: none;color:red"/>Given Mail Id is Not Matched</span>
						<form name="forgotPassword" id="forgotPassword" method="post" >
						<div class="ui-grid-a">  
							<div class="ui-block-a ui-responsive gridA">
								<label for="emailid" style="padding-top:10px"/>Your E-MailId</label>
							</div>
							<div class="ui-block-b ui-responsive gridB" >
								<input name="emailid" id="emailid" type="email"  data-clear-btn="true" required autocomplete="off" data-mini="true" placeholder="Your Mail id"> 									
							</div>
						</div>
						<div class="ui-grid-solo">
								<div class="ui-block-a">
									<input type="button" name="submit"  onclick="emailStatus()" value="Send Mail" data-theme="b" data-mini="true"/>
								</div>
						</div>
						</<form>
					</div> 
	</div>
</div>
<div data-role="footer" style="height:50px;color:#ffffff;background-color:#38D"> 
			<div   align="center">
		 		<font style="color:#ffffff;font-weight: 100 !important;letter-spacing: 2px;font-size:18px;text-align: center;">copyrights@tenfsoftware.com</font>
			</div>
		 
</div>
</div>
</body>
</html>
