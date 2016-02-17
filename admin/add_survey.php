<!DOCTYPE html>
<html> 
	<head> 
	<title>Admin Home</title>  
	<?php require_once "../js_css_files.html"; ?>
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
			include("../functions/functions.php");   
		include("../header.php");    
		include("../toolbar.php");
		if(isAdmin($_SESSION['usertype'] ) != 1)
		{
			header('Location: /TSM/home.php'); 
		}
		?> 
</div>  
	<div data-role="main" class="ui-content body-style">  
			<div align="center" style="padding-bottom: 25px">
				<a href="signup.php" data-ajax="false"/>
						<img src="/TSM/images/add-user.jpg" width="110px" alt="Add New User to TSM" align="middle"/>
				</a><img src="/TSM/images/reply-icon.png"/>Add User
				<a href="updateuser-admin.php" data-ajax="false"/>
						<img src="/TSM/images/User Edit.jpg" width="110px" alt="Update User" align="middle"/>
				</a><img src="/TSM/images/reply-icon.png"/>Update User
			</div> 
			<div class="ui-grid-solo" style="padding-bottom: 10px">  
				<div class="ui-block-a ui-responsive">
				<a href="#addSurvey" data-rel="popup" data-transition="flow" class="ui-btn ui-corner-all ui-shadow  ui-icon-plus ui-btn-icon-left" >Add Survey</a> 
				</div>
			</div>
				<div data-role="collapsible-set" data-theme="b" data-content-theme="a" data-iconpos="right" data-collapsed-icon="arrow-r" data-expanded-icon="arrow-d" data-mini="true" >
			
			<?php
				$rs = getSurvey();
				while($row=mysql_fetch_array($rs))
				{
					  
			?>
					<div data-role="collapsible" data-theme="b" data-content-theme="a" > 
						<h3>
							<?php echo "$row[1]"; ?>  
						</h3> 
						<a href="#surveyDeleteConfirm_<?php echo "$row[0]"; ?>" data-transition="slideup" data-rel="popup" class="ui-btn ui-shadow ui-icon-delete ui-btn-icon-left ui-btn-b ui-btn-inline">Delete Survey</a>
						<a href="#edit_<?php echo $row[0];?>" data-rel="popup" data-transition="flow" class="ui-btn ui-shadow  ui-icon-edit ui-btn-icon-left ui-btn-b ui-btn-inline">Edit Survey</a>
						<a href="#addEvent" data-rel="popup" data-transition="flow" class="ui-btn ui-shadow  ui-icon-plus ui-btn-icon-left ui-btn-inline" >Add Event To The Survey</a>
						<div data-role="popup" id="surveyDeleteConfirm_<?php echo "$row[0]"; ?>">
			   
						<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
						
						<div data-role="header" data-theme="b"  data-icon="alert">  
							<h2><b><label>Confimation</label></b></h2>
							<a href="#"  class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-alert ui-btn-icon-notext ui-btn-botton" data-theme="a"> </a>
						</div>
						<div data-role="main" class="ui-content">
							<div class="ui-grid-solo">
								<div class="ui-block-a">
									<h3>Do you  really want to delete the survey and all of it's Events?</h3>
								</div>
								<div class="ui-block-a">
									<div class="ui-grid-a">
										<div class="ui-block-a">
											<a class="ui-btn" href="deletesurvey.php?surveyId=<?php echo "$row[0]"; ?>" data-ajax="false">Ok</a>
										</div>
										<div class="ui-block-b">
											<a data-rel="back" class="ui-btn">Cancel</a>
										</div>
									</div>
								</div>
							</div>
							
							
						</div>
					   </div>
			   
						<div data-role="popup" id="edit_<?php echo $row[0]?>">
						<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
							<div data-role="header" data-theme="b">
								<h2>Edit Survey</h2>
							</div>
							<div data-role="main" class="ui-content"> 
								<form name="edit_survey_form_<?php echo $row[0]?>" id="edit_survey_form_<?php echo $row[0]?>" method="post" data-ajax="true" >
								<input type="hidden" value="<?php echo $row[0]?>" name="survey_id"/>
								<div class="ui-grid-solo">
										<div class="ui-block-a">
											<span id="hint" style="color:red"></span>
										</div>
								</div> <br/>
								<div class="ui-grid-a">  
									<div class="ui-block-a ui-responsive gridA" >
										Survey Name
									</div>
									<div class="ui-block-b ui-responsive gridB" >
										<input name="survey_name" type="text" onKeyUp="showHint(this.value);" data-clear-btn="true" required autocomplete="off" data-mini="true" placeholder="Enter Survey Name" value="<?php echo $row[1]?>">						
									</div>
									<div class="ui-block-a ui-responsive gridA" >
										Survey Mode
									</div>
									<div class="ui-block-b ui-responsive gridB">
										<select   name="mode" data-mini="true">
											<?php if($row[3] == 1) 
												{
											?>
											<option value="1" selected>Open</option>
											<option value="2">Close</option>
											<?php 
												}else{
											?>
											<option value="1" >Open</option>
											<option value="2" selected>Close</option>
											<?php 
												}
											?>
										</select>
									</div>
									<div class="ui-block-a ui-responsive gridA" >
										Question Type
									</div>
									<div class="ui-block-b ui-responsive gridB">
										<select   name="q_type" data-mini="true">
											<?php if($row[4] == "Options") 
												{
											?>
											<option value="Yes/No">Yes/No</option>
											<option value="Options" selected>Options</option>
											<?php 
												}else{
											?>
											<option value="Yes/No" selected>Yes/No</option>
											<option value="Options" >Options</option>
											<?php 
												}
											?>
											
										</select>
									</div>
									<div class="ui-block-a ui-responsive gridA" >
										Expiry Date
									</div>
									<div class="ui-block-b ui-responsive gridB">
										<?php 
											$date = new DateTime($row[5]);
											$ex_date = $date->format('Y-m-d H:i:s');
										?>
										<input  type="text" data-format="yyyy-MM-dd hh:mm:ss"   name="expiry_date" data-field="datetime"  required data-mini="true" readonly value="<?php  echo $ex_date;?>"/>
									</div> 
								</div> <br/>
								<div class="ui-grid-solo">
										<div class="ui-block-a">
											<input type="submit" name="submit"  value="Update Survey" data-theme="b" data-mini="true" onClick="if(validateSurveyName()){updateSurvey(<?php echo $row[0];?>);}"/>
										</div>
								</div>
							 </form><!--End of Survey Form -->
							</div> <!-- End of popup content-->
			             </div>
						 <?php
						 	$questions = getQuestions($row[0]);
							if(mysql_num_rows($questions) > 0){ ?>
						 <table data-role="table"  class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b"  data-column-popup-theme="a">
							<thead>
								<tr class="ui-bar-d">
									<th>#</th>
									<th data-priority="1">Event Name</th> 
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
									
									$i = 1;
									while($data = mysql_fetch_array($questions))
									{
										?>
										<tr>
											<th><?php echo $i; ?></th>
											<td><?php echo $data[1]?></td>
											<td><a href="#editEvent_<?php echo $data[0]?>" data-rel="popup" data-transition="flow" class="ui-btn ui-shadow ui-corner-all ui-icon-edit ui-btn-icon-notext ui-btn-b ui-btn-inline">Edit</a>
											<div data-role="popup" id="editEvent_<?php echo $data[0]?>" data-overlay-theme="a" data-rel="back">
													 		<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
															<div data-role="header" data-theme="b">
																<h2>Edit Event</h2>
															</div>
															<div data-role="content">
															<form name="editQuestion" method="post" action="edit_questions_action.php" data-ajax="false">
															<input type="hidden" name="queId" value="<?php echo $data[0];?>"/>
																<div class="ui-grid-a">  
																	<div class="ui-block-a ui-responsive " >
																		Survey Name
																	</div>
																	<div class="ui-block-b ui-responsive " >
																		<select name="surveyId" id="surveyId" data-mini="true">
																			<?php
																				$sur=getOpenedSurveys();
																				  while($sur_row=mysql_fetch_array($sur))
																				{ 
																					if($sur_row[0] == $row[0]){
																						echo "<option value='$sur_row[0]' selected>$sur_row[1]</option>"; 
																					}else{
																						echo "<option value='$sur_row[0]'>$sur_row[1]</option>"; 
																					}
																					
																				}
																			 
																			?>								
																		 </select>	
																	</div> 
																	<div class="ui-block-a ui-responsive gridA" >
																		Event Name
																	</div>
																	<div class="ui-block-b ui-responsive gridB">
																		<textarea name="ques" cols="60" rows="2" id="ques" required  autofocus="on" data-mini="true"  data-clear-btn="true"><?php echo $data[1];?></textarea>
																	</div>
																	<?php 
																	$options = getOptions($data[0]); 
																	$iter = 1;
																	while($opt = mysql_fetch_array($options)){
																	?>																											<div class="ui-block-a ui-responsive gridA" >
																		Option <?php echo $iter;?>
																	</div>
																	<input type="hidden" name="opt_<?php echo $iter;?>_id" value="<?php echo $opt[0];?>"/>
																	<div class="ui-block-b ui-responsive gridB">
																		<input name="op_<?php echo $iter;?>" type="text" id="op_<?php echo $iter;?>"  maxlength="85" required data-mini="true"  data-clear-btn="true" value="<?php echo $opt[1];?>"/>
																	</div>
																	<?php 
																	 $iter++;
																	}
																	?>
																</div> <br/>
																<div class="ui-grid-solo">
																		<div class="ui-block-a">
																			<input type="submit" name="submit"  value="Update Event" data-theme="b" data-mini="true" />
																		</div>
																</div>
															</form><!--End of Survey Form -->
														  </div> <!-- End of popup content-->
													   </div>  <!-- End of addSurvey popup --> 
											</td>
											<td>
												<a href="#eventDeleteConfrim_<?php echo $data[0]; ?>" class="ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext ui-btn-b ui-btn-inline" data-rel="popup" data-transition="slideup">Delete</a>
												<div data-role="popup" id="eventDeleteConfrim_<?php echo $data[0]; ?>">
			   
														<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
														
														<div data-role="header" data-theme="b"  data-icon="alert">  
															<h2><b><label>Confimation</label></b></h2>
															<a href="#"  class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-alert ui-btn-icon-notext ui-btn-botton" data-theme="a"> </a>
														</div>
														<div data-role="main-content" class="ui-content">
															<div class="ui-grid-solo">
																<div class="ui-block-a">
																	<h3>Do you want really delete the Event and all of it's options?</h3>
																</div>
																<div class="ui-block-a">
																	<div class="ui-grid-a">
																		<div class="ui-block-a">
																			<a class="ui-btn" href="deleteevent.php?queId=<?php echo $data[0]; ?>" data-ajax="false">Ok</a>
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
						<?php }?>
						</div>
				<?php  
					}
				?>	  
				</div> 
			
			
			<div data-role="popup" id="addSurvey" data-overlay-theme="a" data-rel="back">
					<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
					<div data-role="header" data-theme="b">
						<h2>Add Survey</h2>
					</div>
					<div data-role="main" class="ui-content"> 
						<form name="survey_form" id="survey_form" method="post" action="add_survey_action.php" onSubmit="return validateSurveyName()" data-ajax="false">
						<div class="ui-grid-solo">
								<div class="ui-block-a">
									<span id="hint1" style="color:red"></span>
								</div>
						</div> <br/>
						<div class="ui-grid-a">  
							<div class="ui-block-a ui-responsive gridA" >
								Survey Name
							</div>
							<div class="ui-block-b ui-responsive gridB" >
								<input name="survey_name" type="text" onKeyUp="showHint(this.value);" data-clear-btn="true" required autocomplete="off" data-mini="true" placeholder="Enter Survey Name"> 									
							</div>
							<div class="ui-block-a ui-responsive gridA" >
								Survey Mode
							</div>
							<div class="ui-block-b ui-responsive gridB">
								<select id="mode" name="mode" data-mini="true">
									<option value="1" selected>Open</option>
									<option value="2">Close</option>
								</select>
							</div>
							<div class="ui-block-a ui-responsive gridA" >
								Question Type
							</div>
							<div class="ui-block-b ui-responsive gridB">
								<select id="q_type" name="q_type" data-mini="true">
									<option value="Yes/No">Yes/No</option>
									<option value="Options" selected>Options</option>
								</select>
							</div>
							<div class="ui-block-a ui-responsive gridA" >
								Expiry Date
							</div>
							<div class="ui-block-b ui-responsive gridB">
								<input type="text" data-format="yyyy-MM-dd hh:mm:ss"  id="expiry_date" data-field="datetime"  name="expiry_date"  required data-mini="true" readonly/>
							</div> 
							 
						</div> <br/>
						<div class="ui-grid-solo">
								<div class="ui-block-a">
									<input type="submit" name="submit"  value="Add Survey" data-theme="b" data-mini="true"/>
								</div>
						</div>
					 </form><!--End of Survey Form -->
					</div> <!-- End of popup content-->
			   </div>  <!-- End of addSurvey popup -->
			   
			 <div data-role="popup" id="addEvent" data-overlay-theme="a" data-rel="back">
			 		<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
					<div data-role="header" data-theme="b">
						<h2>Add Event</h2>
					</div>
					<div data-role="content">
					<form name="addQuestion" method="post" action="questionadd_action.php" data-ajax="false">
						<div class="ui-grid-a">  
							<div class="ui-block-a ui-responsive " >
								Survey Name
							</div>
							<div class="ui-block-b ui-responsive " >
								<select name="surveyId" id="surveyId" data-mini="true">
									<?php
										$rs=getOpenedSurveys();
										  while($row=mysql_fetch_array($rs))
										{ 
											echo "<option value='$row[0]'>$row[1]</option>"; 
										}
									 
									?>								
								 </select>	
							</div>
							<div class="ui-block-a ui-responsive gridA" >
								Event Name
							</div>
							<div class="ui-block-b ui-responsive gridB">
								<textarea name="ques" cols="60" rows="2" id="ques" required  autofocus="on" data-mini="true"  data-clear-btn="true"></textarea>
							</div>
							<div class="ui-block-a ui-responsive gridA" >
								Option 1
							</div>
							<div class="ui-block-b ui-responsive gridB">
								<input name="op_1" type="text" id="op_1"  maxlength="85" required data-mini="true"  data-clear-btn="true">
							</div>
							<div class="ui-block-a ui-responsive gridA" >
								Option 2
							</div>
							<div class="ui-block-b ui-responsive gridB">
								<input name="op_2" type="text" id="op_2"  maxlength="85" required data-mini="true"  data-clear-btn="true">
							</div> 
							<div class="ui-block-a ui-responsive gridA" >
								Option 3
							</div>
							<div class="ui-block-b ui-responsive gridB">
								<input name="op_3" type="text" id="op_3"  maxlength="85" required data-mini="true"  data-clear-btn="true">
							</div>
							<div class="ui-block-a ui-responsive gridA" >
								Option 4
							</div>
							<div class="ui-block-b ui-responsive gridB">
								<input name="op_4" type="text" id="op_4"  maxlength="85" required data-mini="true"  data-clear-btn="true">
							</div> 
						</div> <br/>
						<div class="ui-grid-solo">
								<div class="ui-block-a">
									<input type="submit" name="submit"  value="Add Event" data-theme="b" data-mini="true" />
								</div>
						</div>
					</form><!--End of Survey Form -->
				  </div> <!-- End of popup content-->
			   </div>  <!-- End of addSurvey popup -->  
			   
			   <!-- Success Popup -->
			  <div data-role="popup" id="successPop">
					<div data-role="header" data-theme="b">
						
					</div>
					<div data-role="main" class="ui-content">
						<div id="suc_contentId" style="color:green">
							Success !!!
						</div>
					</div>
					<div data-role="footer" data-theme="b">
					</div>
			  </div>
			  <!-- on Error Popup -->
			  <div data-role="popup" id="errorPop">
			  	<div data-role="header" data-theme="b">
					
				</div>
				<div data-role="main" class="ui-content">
					<div id="err_contentId" style="color:red">
					</div>
				</div>
				<div data-role="footer" data-theme="b">
				</div>
			  </div> 
			</div> <!--End of main Content -->		
 			<?php include "../footer.html";?>	
</div> <!-- End of Page-->

</body>
</html> 