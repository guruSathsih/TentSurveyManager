<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<title>User Management</title>
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
<style>
	.ui-shadow{
		box-shadow:1px 1px 3px rgba(0, 0, 0, 1) !important;
	}	
</style>
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
	<div data-role="main" class="ui-content body-style" >
				<h2 class="style8" align="center">User Details</h2>
				<table data-role="table"  class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b"  data-column-popup-theme="a">
							<thead>
								<tr class="ui-bar-d">
									<th>#</th>
									<th data-priority="1">Name</th> 
									<th>EmailId</th>
									<th>Emp.No</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$users = allUserDetails();
									$i = 1;
									while($userdata = mysql_fetch_array($users))
									{
										?>
										<tr>
											<th><?php echo $i; ?></th>
											<td><?php echo $userdata[1]." ".$userdata[2];?></td>
											<td><?php echo $userdata[4];?></td>
											<td><?php echo $userdata[3];?></td>
											<td>
												<form method="post" action="updateuserprofile.php" data-ajax="false">
												<a href=""  data-transition="flow" class="ui-btn ui-shadow ui-corner-all ui-icon-edit ui-btn-icon-notext ui-btn-b ui-btn-inline" data-ajax="false" onclick="$(this).closest('form').submit()" >Edit</a>
												
												<input type="hidden" value="<?php echo $userdata[4]?>" id="emailID" name="emailID"/></form>
											
											</td>
											<td>
												<a href="#<?php echo $userdata[4]?>"  data-rel="popup" data-transition="flow" class="ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext ui-btn-b ui-btn-inline">Delete</a>
												<div data-role="popup" id="<?php echo $userdata[4]?>">
																				
													<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
													
													<div data-role="header" data-theme="b"  data-icon="user">  
														<h2><b><label>Delete User</label></b></h2>
														<a href="#"  class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-user ui-btn-icon-notext ui-btn-botton" data-theme="a"> </a>
													</div>
												<div data-role="main" class="ui-content">
														 
														
														<div class="ui-grid-solo">
															<div class="ui-block-a">
																<h3>Do you want to delete this user <?php echo $userdata[4]?>   </h3>
															</div>
															<div class="ui-block-a">
																<div class="ui-grid-a">
																	<div class="ui-block-a">
																		<a class="ui-btn" href="deleteuser.php?emailid=<?php echo $userdata[4]?>" data-ajax="false" data-theme="b">Ok</a>
																	</div>
																	<div class="ui-block-b">
																		<a data-rel="back" class="ui-btn">Cancel</a>
																	</div>
																</div>
															</div>
														</div>
													</div> 
													
												</div>
											</td>
										</tr>
										<?php
											$i++;
								}
								?>
							</tbody>
						</table>
		</div>
	 <?php include "../footer.html";?>
 </div>

</body>
</html>
