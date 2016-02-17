<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<title>Add New user </title>
<?php require_once "../js_css_files.html"; ?>  
<link rel="stylesheet" type="text/css" href="/TSM/js/CuriousSolutions-DateTimePicker/src/DateTimePicker.css" />
 <script type="text/javascript" src="/TSM/js/CuriousSolutions-DateTimePicker/src/DateTimePicker.js"></script>
  <script>
	$(document).ready(function()
 {
   
     $("#dtBox").DateTimePicker();
   
 });
</script> 

</head>

<body>
<div id="dtBox"></div>

<div data-role="page">
	<div data-role="header" data-theme="a"> 
		<?php  
		include("../header.php");  
		 
		 include("../functions/functions.php");  
		if(isAdmin($_SESSION['usertype'] ) != 1)
		{
			header('Location: /TSM/home.php'); 
		}
 
		include("../toolbar.php");  
		?> 
	</div>
	<div data-role="main" class="ui-content body-style">
		<div class="ui-grid-a ui-responsive">
			<div class="ui-block-a" style="width: 20%">
				<img src="/TSM/images/connected_multiple_big.jpg" width="131" height="155">
			</div>
			<div class="ui-block-b">
				<h2 align="left"><span class="style8">Add New User</span></h2>
				<form name="signup" method="post" action="signupuser.php"  onSubmit="return checkSignUp();" data-ajax="false"> 
					<div class="ui-grid-a" >
						<div class="ui-block-a" style="width: 25%"> 
							FirstName
						</div>
						<div class="ui-block-b">
							<input type="text" name="f_name" required placeholder="FirstName"   data-mini="true">
						</div>
						<div class="ui-block-a"  style="width: 25%"> 
							LastName
						</div>
						<div class="ui-block-b">
							<input type="text" name="l_name" placeholder="LastName"  data-mini="true">
						</div>
						<div class="ui-block-a"  style="width: 25%"> 
							Emp.No
						</div>
						<div class="ui-block-b"> 
							<input name="emp_no" type="text" required placeholder="Tent EMP No" required data-mini="true">
						</div>
						<div class="ui-block-a"  style="width: 25%"> 
							Email@Id
						</div>
						<div class="ui-block-b">
							<input name="email_id" type="email" required placeholder="Your Mail ID is TSM UserName" data-mini="true">
						</div>
						<div class="ui-block-a" style="width: 25%"> 
							Gender
						</div>
						<div class="ui-block-b">
							 <fieldset data-role="controlgroup"> 
							      <label for="male">Male</label>
							      <input type="radio" name="gender" id="male" value="m" checked data-mini="true">
							      <label for="female">Female</label>
							      <input type="radio" name="gender" id="female" value="f" data-mini="true"> 
							  </fieldset>
						</div>
						<div class="ui-block-a" style="width: 25%"> 
							Designation
						</div>
						<div class="ui-block-b">
							<input name="designation" type="text" required placeholder="Designation" data-mini="true">
						</div>
						<div class="ui-block-a" style="width: 25%"> 
							DOB
						</div>
						<div class="ui-block-b">
							<input  type="text" data-format="yyyy-MM-dd" id="dob"  name="dob" data-field="date"  required  readonly data-min="1940-01-01" data-max="2015-01-01" placeholder="Date Of Birth"  data-mini="true"/>
						</div>
						<div class="ui-block-a" style="width: 25%"> 
							DOJ
						</div>
						<div class="ui-block-b">
							<input  type="text" data-format="yyyy-MM-dd" id="doj"  name="doj" data-field="date"  required  readonly data-min="1990-01-01" placeholder="Date Of Joining" data-mini="true"/>
						</div>
						<div class="ui-block-a" style="width: 25%"> 
							Approver Mail@Id
						</div>
						<div class="ui-block-b">
							<input name="app_email_id" type="email" required placeholder="ApproverMailID" data-mini="true">
						</div>
						<div class="ui-block-a" style="padding-top:25px;padding-bottom:10px"> 
							<h3 class="style8">Change password </h3>
						</div>
						<div class="ui-block-b">
							
						</div>
						<div class="ui-block-a" style="width: 25%"> 
							Passowrd
						</div>
						<div class="ui-block-b">
							<input name="pass_wd" type="password" required placeholder="Password For TSM" data-mini="true">
						</div>
						<div class="ui-block-a" style="width: 25%;padding-bottom:10px"> 
							Retype-Passwod
						</div>
						<div class="ui-block-b">
							<input name="re_pass_wd" type="password" required placeholder="Retype the Password" data-mini="true">
						</div>
						<div class="ui-block-a" style="width: 25%"> 
							UserType
						</div>
						<div class="ui-block-b">
							  <fieldset data-role="controlgroup"> 
							      <label for="normal">Normal</label>
							      <input type="radio" name="user_type" id="normal" value="NORMAL" checked data-mini="true">
							      <label for="admin">Admin</label>
							      <input type="radio" name="user_typclasse" id="admin" value="ADMIN" data-mini="true"> 
							  </fieldset>
						</div> 
					</div>
					<div class="ui-block-a profile-button"> 
							<input type="submit" name="Submit" value="Signup" data-ajax="false" data-mini="true"/>
						</div>
						<div class="ui-block-b" style="width: 10px;"></div>
						<div class="ui-block-b profile-button">
							<input type="reset" value="Reset" data-mini="true"/>
					</div>
				</form>
			</div>
		</div>
 	</div>
	 <?php include "../footer.html";?>
 </div>

</body>
</html>
