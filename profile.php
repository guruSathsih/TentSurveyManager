<!DOCTYPE html>
<html>
	<head> 
	<title>My Profile</title>  
	<?php require_once "js_css_files.html"; ?>
<script type="text/javascript">
var status = true;   
</script>   
</head> 

<body>

<link rel="stylesheet" type="text/css" href="/TSM/js/CuriousSolutions-DateTimePicker/src/DateTimePicker.css" />
 <script type="text/javascript" src="/TSM/js/CuriousSolutions-DateTimePicker/src/DateTimePicker.js"></script>
  <script>
	$(document).ready(function()
 {
   
     $("#dtBox").DateTimePicker();
   
 });
</script>
<div data-role="page">
<div id="dtBox"></div>
	<div data-role="header" data-theme="a">
		<?php 
		 include("functions/functions.php");  
		include("header.php");  
		include("toolbar.php");  
		?> 
	</div>
	<div data-role="main" class="ui-content body-style">
	<?php 
		$profile = userDeatils($_SESSION['login']);
	?>
		<!--<table width="100%" border="0">
		   <tr>
		     <td width="132" rowspan="2" valign="top"><span class="style8"><img src="/TSM/images/connected_multiple_big.jpg" width="131" height="155"></span></td>
		     <td width="468" height="57">
			 	<h2 align="left"><span class="style8">My Profile</span></h2></td>
		   </tr>
		   <tr>
		     <td><form name="update_profile" method="post" action="updateprofile.php"  onSubmit="return updateProfile();" data-ajax="false">
			 <input type="hidden" value="<?php echo $_SESSION['login'];?>s" id="userName" name="userName"/>
		       <table width="500" border="0" align="left">
		         <tr>
		           <td><div align="left" class="style7">FirstName</div></td>
		           <td><input type="text" name="f_name" required placeholder="FirstName" value="<?php echo $profile[1];?>"></td>
		         </tr>
		         <tr>
		           <td class="style7">LastName</td>
		           <td>
				   		<input type="text" name="l_name" placeholder="LastName" value="<?php echo $profile[2];?>">
				   </td>
		         </tr>
		         <tr>
		           <td class="style7">Emp.No </td>
		           <td><input name="emp_no" type="text" required placeholder="Tent EMP No" required readonly value="<?php echo $profile[3];?>"></td>
		         </tr>
		         <tr>
		           <td class="style7">Email@Id</td>
		           <td><input name="email_id" type="email" required placeholder="Your Mail ID is TSM UserName" value="<?php echo $profile[4];?>"></td>
		         </tr> 
		         <tr>
		           <td valign="top" class="style7">Gender</td>
		           <td>
					   <fieldset data-role="controlgroup"> 
					   	  <?php 
						  	if(strcasecmp($profile[6],"m") == 0){ 
						  ?>
						      <label for="male">Male</label>
						      <input type="radio" name="gender" id="male" value="m" checked>
						      <label for="female">Female</label>
						      <input type="radio" name="gender" id="female" value="f"/>
						  <?php }else if(strcasecmp($profile[6],"m") == 0){ ?>
						   	  <label for="male">Male</label>
						      <input type="radio" name="gender" id="male" value="m" >
						      <label for="female">Female</label>
						      <input type="radio" name="gender" id="female" value="f" checked/>
							<?php } ?>
					  </fieldset>
				  </td>
		         </tr>
				  <tr>
		           <td class="style7">Designation</td>
		           <td><input name="designation" type="text" required placeholder="Designation" readonly value="<?php echo $profile[7];?>"></td>
		         </tr>
				 <tr>
		           <td class="style7">DOB</td>
		           <td><input  type="text" data-format="yyyy-MM-dd" id="dob"  name="dob" data-field="date"  required data-mini="true" readonly data-min="1940-01-01" data-max="2015-01-01" placeholder="Date Of Birth" value="<?php echo $profile[8];?>"/>
					</td>
		         </tr>
				  <tr>
		           <td class="style7">DOJ</td>
		           <td><input  type="text" data-format="yyyy-MM-dd" id="doj"  name="doj" data-field="date"  required data-mini="true" readonly data-min="1990-01-01" placeholder="Date Of Joining" value="<?php echo $profile[9];?>"/>
					</td>
		         </tr>
				 <tr>
		           <td class="style7">Approver Mail@Id</td>
		           <td><input name="app_email_id" type="email" required placeholder="ApproverMailID" readonly value="<?php echo $profile[10];?>"></td>
		         </tr>
				 <tr>
				 	<td style="padding-top:25px;padding-bottom:10px"> <h3 class="style8">Change password </h3></td>
				</tr>
				 <tr>
		           <td class="style7">Passowrd</td>
		           <td><input name="pass_wd" type="password" required placeholder="Current Password is <?php echo $profile[5];?>" value="<?php echo $profile[5];?>"> 
				   </td>
		         </tr>
				 <tr>
		           <td class="style7" style="padding-bottom:10px">Retype-Passwod</td>
		           <td style="padding-bottom:10px"><input name="re_pass_wd" type="password" required placeholder="Retype the Password" value="<?php echo $profile[5];?>"></td>
		         </tr>
				  
		         <tr> 
		           <td class="style7"><input type="submit" name="Submit" value="Update" data-ajax="false"/>
		           </td>
				    <td class="style7"><input type="reset" value="Reset"/></td>
		         </tr>
		       </table>
		     </form></td>
		   </tr>
		 </table>-->
		<div class="ui-grid-a ui-responsive">
			<div class="ui-block-a" style="width: 20%">
				<img src="/TSM/images/connected_multiple_big.jpg" width="131" height="155">
			</div>
			<div class="ui-block-b" >
				<h2 align="left"  style="padding-bottom: 15px"><span class="style8">My Profile</span></h2>
				<form name="update_profile" method="post" action="updateprofile.php"  onSubmit="return updateProfile();" data-ajax="false">
					<input type="hidden" value="<?php echo $_SESSION['login'];?>" id="userName" name="userName"/>
					<div class="ui-grid-a">
						<div class="ui-block-a" style="width: 25%"> 
							FirstName
						</div>
						<div class="ui-block-b">
							<input type="text" name="f_name" required placeholder="FirstName" value="<?php echo $profile[1];?>" data-mini="true">
						</div>
						<div class="ui-block-a" style="width: 25%"> 
							LastName
						</div>
						<div class="ui-block-b">
							<input type="text" name="l_name" placeholder="LastName" value="<?php echo $profile[2];?>" data-mini="true">
						</div>
						<div class="ui-block-a" style="width: 25%"> 
							Emp.No
						</div>
						<div class="ui-block-b"> 
							<input name="emp_no" type="text" required placeholder="Tent EMP No" required readonly value="<?php echo $profile[3];?>" data-mini="true">
						</div>
						<div class="ui-block-a" style="width: 25%"> 
							Email@Id
						</div>
						<div class="ui-block-b">
							<input name="email_id" type="email" required placeholder="Your Mail ID is TSM UserName" value="<?php echo $profile[4];?>" data-mini="true">
						</div>
						<div class="ui-block-a" style="width: 25%"> 
							Gender
						</div>
						<div class="ui-block-b">
							<fieldset data-role="controlgroup"> 
							   	  <?php 
								  	if(strcasecmp($profile[6],"m") == 0){ 
								  ?>
								      <label for="male">Male</label>
								      <input type="radio" name="gender" id="male" value="m" checked data-mini="true">
								      <label for="female">Female</label>
								      <input type="radio" name="gender" id="female" value="f" data-mini="true"/>
								  <?php }else if(strcasecmp($profile[6],"m") == 0){ ?>
								   	  <label for="male">Male</label>
								      <input type="radio" name="gender" id="male" value="m" data-mini="true"/>
								      <label for="female">Female</label>
								      <input type="radio" name="gender" id="female" value="f" checked data-mini="true"/>
									<?php } ?>
							  </fieldset>
						</div>
						<div class="ui-block-a" style="width: 25%"> 
							Designation
						</div>
						<div class="ui-block-b">
							<input name="designation" type="text" required placeholder="Designation" readonly value="<?php echo $profile[7];?>" data-mini="true">
						</div>
						<div class="ui-block-a" style="width: 25%"> 
							DOB
						</div>
						<div class="ui-block-b">
							<input  type="text" data-format="yyyy-MM-dd" id="dob"  name="dob" data-field="date"  required data-mini="true" readonly data-min="1940-01-01" data-max="2015-01-01" placeholder="Date Of Birth" value="<?php echo $profile[8];?>"/>
						</div>
						<div class="ui-block-a" style="width: 25%"> 
							DOJ
						</div>
						<div class="ui-block-b">
							<input  type="text" data-format="yyyy-MM-dd" id="doj"  name="doj" data-field="date"  required data-mini="true" readonly data-min="1990-01-01" placeholder="Date Of Joining" value="<?php echo $profile[9];?>"/>
						</div>
						<div class="ui-block-a" style="width: 25%"> 
							Approver Mail@Id
						</div>
						<div class="ui-block-b">
							<input name="app_email_id" type="email" required placeholder="ApproverMailID" readonly value="<?php echo $profile[10];?>" data-mini="true">
						</div>
						<div class="ui-block-a" style="padding-top:25px;padding-bottom:10px;width: 25%"> 
							<h3 class="style8">Change password </h3>
						</div>
						<div class="ui-block-b">
							
						</div>
						<div class="ui-block-a" style="width: 25%"> 
							Passowrd
						</div>
						<div class="ui-block-b">
							<input name="pass_wd" type="password" required placeholder="Current Password is <?php echo $profile[5];?>" value="<?php echo $profile[5];?>" data-mini="true">
						</div>
						<div class="ui-block-a" style="padding-bottom:10px;width: 25%"> 
							Retype-Passwod
						</div>
						<div class="ui-block-b">
							<input name="re_pass_wd" type="password" required placeholder="Retype the Password" value="<?php echo $profile[5];?>" data-mini="true">
						</div> 
					</div>
					<div class="ui-block-a profile-button" style="padding-top: 10px"> 
							<input type="submit" name="Submit" value="Update" data-ajax="false" data-mini="true"/>
						</div>
						<div class="ui-block-b" style="width: 10px;"></div>
						<div class="ui-block-b profile-button" style="padding-top: 10px">
							<input type="reset" value="Reset" data-mini="true"/>
					</div>
				</form>
			</div>
		</div>
	</div>	
 	<?php include "footer.html";?>	
</div> <!-- End of Page-->

</body>
</html> 