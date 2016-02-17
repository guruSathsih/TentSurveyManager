<?php 
	require_once "dbmanager.php";
	require_once "/../plugin/PHPMailer/PHPMailerAutoload.php"; 
	/*
		Heres done all the common function for TSM Applicaiton
	*/
	
	//Function Returns all the surveys available
	function getSurvey()
	{
		try{
			$con = getDBConnection();
			$rs = mysql_query("SELECT * FROM survey ",$con);
		}catch(Exception $ex){
			echo "Warning Message:".$ex->getMessage();
		}finally{
			closeConnection($con);
		} 
		return $rs;
	}
	
	//Function Retrieves the Question for the Given $surveyId
	function getQuestions($surveyId)
	{ 
		try{
			$con = getDBConnection();
			$rs = mysql_query("SELECT * FROM question where survey_id = $surveyId ",$con); 
			
		}catch(Exception $ex){
			echo "Warning Message:".$ex->getMessage();
		}finally{
			closeConnection($con);
		}
		return $rs;
	}
	
	//Function Authorize an user by given password and username
	function authorizeUser($username,$password)
	{
		try{
			$con = getDBConnection();
			$rs = mysql_query("select user_type from user where email_id='$username' and password='$password'",$con); 
			if(mysql_num_rows($rs)<1)
			{ 
				$found="N";
				 
				header('Location: index.php?login=$found'); 
			}
			else
			{
				$_SESSION[login]=$username;
				while($row = mysql_fetch_array($rs))
				{
					$_SESSION[usertype]=$row[0];
				}
				 
				header('Location: home.php'); 
			}
		}catch(Exception $ex){
			echo "Warning Message:".$ex->getMessage();
		}finally{
			closeConnection($con);
		} 
	}
	
	//Function Retrieves the Info about Options 
	//queId = questionId
	function getOptionsByQuestionId($queId)
	{
		$options = array();// Holds the Options details
		try{
			$con = getDBConnection();
			
			$rs = mysql_query("SELECT * FROM OPTIONS WHERE QUE_ID = $queId"); 
			$i = 0;
			while($row = mysql_fetch_array($rs))
			{
				$options['op_id_'.$i] = $row[0];
				$options['option_'.$i] = $row[1];
				$i += 1;
			}   
			
		}catch(Exception $ex){
			echo "Warning Message:".$ex->getMessage();
		}finally{
			closeConnection($con);
		}
		return $options;
	}
	
	//Function to get the question by the questionIds
	function getQuestionById($queId)
	{
		$question;//Holds the Question
		try{
			$con = getDBConnection();
			$rs = mysql_query("SELECT QUESTION FROM QUESTION WHERE QUE_ID = $queId",$con);
			while($row = mysql_fetch_array($rs))
			{
				$question = $row[0];
			}
		}catch(Exception $ex){
			echo "Warning Message:".$ex->getMessage();
		}finally{
			closeConnection($con);
		}
		return $question;
	}
	
	//Function to save the survey
	function saveSurvey($username,$optionId)
	{ 
		$queId;//Holds the Question Id for the Selected Option
		$surveyId;//Holds the Survey Id for the Selected Option
		$status = false;//Saved the Survey or Not
		try{
			$con = getDBConnection();
			$rs = mysql_query("SELECT QUE_ID FROM OPTIONS WHERE OPT_ID = $optionId ",$con);
			while($row = mysql_fetch_array($rs))
			{
				$queId =$row[0];
			}
			$rs = mysql_query("SELECT SURVEY_ID FROM QUESTION WHERE QUE_ID = $queId ",$con);
			while($row = mysql_fetch_array($rs))
			{
				$surveyId =$row[0];
			}  
			$status = mysql_query("INSERT INTO SURVEY_MANAGER VALUES('$username',$surveyId,$queId,$optionId,now())",$con);
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		} 
		return $status;
	}
	
	//Function to say whether the given user is voted for the survey already or not
	//Voted - 1
	//Not Voted - 0
	function isVoted($userName,$queId)
	{
		$status = 0;
		try{
			$con = getDBConnection();
			$rs = mysql_query("SELECT COUNT(*) FROM SURVEY_MANAGER WHERE USER_NAME ='$userName' AND QUE_ID = $queId",$con);
			$row = mysql_fetch_array($rs);  
			if($row[0] > 0)
			{
				$status = 1;
			}
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		} 
		return $status;
	}
	
	//Function used to retrieve all the details about a survey
	//The last submitted details of the survey will be retruned
	function surveyDetails($userName)
	{
		$surveyName;
		$question;
		$queId; 
		try{
			$con = getDBConnection();
			$sql = " select sur.survey_name,que.question,que.que_id from survey_manager sm 
					 left join survey sur on sur.survey_id = sm.survey_id
					 left join question que on que.survey_id = sur.survey_id
					 where sm.user_name = '$userName' 
					 order by sm.submitted_time desc limit 1";
			$rs = mysql_query($sql,$con);
			while($row = mysql_fetch_array($rs))
			{
				 $surveyName = $row[0];
				 $question = $row[1];
				 $queId = $row[2];
			} 
			$survey['surveyName']= $surveyName;
			$survey['question']= $question;
			$survey['queId']= $queId; 
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		} 
		return $survey;
	}
	
	//Function retrieves the count on each option for the specific query
	function getOptionCounts($queId)
	{
		$optionCount; 
		try{
			$con = getDBConnection();
			$rs = mysql_query("select opt_id,option_name from options where que_id = $queId",$con);
			while($row = mysql_fetch_array($rs))
			{ 
				$rs2 = mysql_query("select count(user_name) from survey_manager where  que_id = $queId and opt_id = $row[0]",$con);
				while($row2 = mysql_fetch_array($rs2))
				{
					$optionCount[$row[1]] = $row2[0];					
				}
			} 
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		} 
		return $optionCount;
	}
	
	//Function returns associative array like Id - surveyName
	function getSurveyNameId()
	{
		$surveyIdName = [];
		try{
			$con = getDBConnection();
			$rs = mysql_query("select distinct survey_id,survey_name from survey order by expiry_date",$con); 
			 
			while($row = mysql_fetch_array($rs))
			{
				$surveyIdName[$row[0]] = $row[1];
			}
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		} 
		return $surveyIdName;
	}
	
	//Function returns Questions for the given survey Id
	function getQuestionBySurveyId($surveyId)
	{  
		try{
			$con = getDBConnection();
			$rs = mysql_query("select distinct que_id,question from question where survey_id = $surveyId",$con); 
			
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		} 
		return $rs;
	}
	
	//Returns Admin = 1
	//Normal user = 0
	function isAdmin($userType)
	{
		$status = 0;
		try{
			if($userType == 'ADMIN')
			{
				$status = 1;
			}
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}
		return $status;
	}
	
	//Function Adds an survey to the DB
	function addSurvey($survey_name,$mode,$q_type,$expiry_date,$postId)
	{ 
		try	
		{	  
			$con = getDBConnection();
			$rs = mysql_query("INSERT INTO SURVEY VALUES(DEFAULT,'$survey_name','$postId','$mode','$q_type','$expiry_date')",$con);
			
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		}
	}
	
	//Function Retrieves the opened surveys
	function getOpenedSurveys()
	{
		try{
			$con = getDBConnection();
			$rs = mysql_query("select * from survey where survey_mode = '1' order by survey_name ASC",$con);
			
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		}
		return $rs;
	}
	
	//Function Adds Question to the Survey and Options to the Questions
	function addQuestionAndOptions($question,$surveyId,$op_1,$op_2,$op_3,$op_4)
	{
		try{
			$con = getDBConnection();
			$rs = mysql_query("insert into question values(DEFAULT,'$question','$surveyId')",$con) ;
			$queId = mysql_insert_id($con);
			$rs = mysql_query("select survey_id from question where que_id = $queId",$con);
			while($row = mysql_fetch_array($rs))
			{
				$surveyId = $row[0];
			} 
			mysql_query("insert into options values(DEFAULT,'$op_1',NULL,'$queId','$surveyId')",$con);
			mysql_query("insert into options values(DEFAULT,'$op_2',NULL,'$queId','$surveyId')",$con);
			mysql_query("insert into options values(DEFAULT,'$op_3',NULL,'$queId','$surveyId')",$con);
			mysql_query("insert into options values(DEFAULT,'$op_4',NULL,'$queId','$surveyId')",$con);
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		}
	}
	
	//function used to delete the survey by given surveyId
	function deleteSurvey($surveyId)
	{	
		try{
			$con = getDBConnection();
			$rs = mysql_query("delete from survey where survey_id = $surveyId",$con) ;
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		}
	}
	
	function getSurveyById($surveyId)
	{
		try{
			$con = getDBConnection();
			$rs = mysql_query("select *  from survey where survey_id = $surveyId",$con) ;
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		}
		return $rs;
	}
	
	//Function updates a survey
	function updateSurvey($surveyId,$surveyName,$surveyMode,$qType,$expiryDate)
	{	
		try{
			$con = getDBConnection();
			$timestamp = strtotime($expiryDate);
			$expiryDate = date("Y-m-d H:i:s", $timestamp);
			$rs = mysql_query("update survey set survey_name = '$surveyName',survey_mode = '$surveyMode', survey_type = '$qType', expiry_date = '$expiryDate' where survey_id = $surveyId",$con) ;
			 
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		}
	} 
	//Function Returns the survey page with current values
	function currentSurveyHtml()
	{
		$conf = include('generated-survey.php');
		return $conf;
	}
	
	//Function used to get the count down
	function getCountDown($surveyId){
		$survey_date;
		$interval;
		try{ 
			$con = getDBConnection();
			$rs = mysql_query("select expiry_date FROM survey where survey_id = $surveyId",$con);
			while($row = mysql_fetch_array($rs)){
				$survey_date = $row[0];
			}
			
			date_default_timezone_set('Asia/Calcutta'); 
			$survey_date = new DateTime($survey_date); 
			$today = new DateTime();  
			$interval = $today->diff($survey_date,true);
			if(! ($today < $survey_date)){
				$interval = $today->diff($today,true);
			}else{
				$interval = $today->diff($survey_date,true);
			}
			/*echo "today:";
			print_r($today);
			echo "survey:";
			print_r($survey_date);
			echo "diff:";
			print_r($interval);*/
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		}  
		return $interval;
	}
	 
	 //Function returns the options for the questions id
	function getOptions($questionId){
		try{
			$con = getDBConnection();
			if($questionId != NULL && strlen($questionId) > 0){
				$rs = mysql_query("select * from options where que_id = $questionId",$con);
			}
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		}
		return $rs;
	}
	
	//Function updates a question and the respected options
	function udpateQuestionAndOptions($queId,$question,$surveyId,$op_1,$op_2,$op_3,$op_4,$opt_1_id,$opt_2_id,$opt_3_id,$opt_4_id)
	{
		try{
			$con = getDBConnection();
			mysql_query("update question set question='$question', survey_id=$surveyId WHERE  que_id=$queId",$con) ;
			 
			mysql_query("update options set option_name = '$op_1' where opt_id=$opt_1_id",$con);
			mysql_query("update options set option_name = '$op_2' where opt_id=$opt_2_id",$con);
			mysql_query("update options set option_name = '$op_3' where opt_id=$opt_3_id",$con);
			mysql_query("update options set option_name = '$op_4' where opt_id=$opt_4_id",$con);
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		}
		return true;
	}
	
	//function used to delete the event by given questionId
	function deleteEvent($queId)
	{	
		try{
			$con = getDBConnection();
			$rs = mysql_query("delete from question where que_id = $queId",$con) ;
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		}
	}	 
	
	//Function returns the opended Survey Id'S  
	function getOpenedSurveyIds()
	{
		try{
			$con = getDBConnection();
			$rs = mysql_query("select survey_id from survey where survey_mode = '1' order by survey_name ASC",$con);
			
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		}
		return $rs;
	}
	
	//Function adds an user to the SurveyManager
	function addUser($fName,$lName,$empNo,$emailId,$passwd,$gender,$designation,$dob,$doj,$appMail,$userType){
		try{
			$con = getDBConnection(); 
			mysql_query("insert into user values(DEFAULT,'$fName','$lName','$empNo','$emailId','$passwd','$gender','$designation','$dob','$doj','$appMail','$userType')",$con);
			//Send userName and password Mail to the $emailId
			 $message = "<div>Hi $name,<br/><br/><font color='#229954'><b>TentSurveyManager(TSM)</b></font> admin has created username and password for you.<br/><br/><table align='center' style='padding-top:3px;padding-bottom:3px;font-weight:bold'><tr><td>UserName:</td><td>$userName</td></tr><tr><td>Password:</td><td>$password</td></tr></table><p>You can now vote for the events.</P></div><br/><br/><br/><font style='text-align:left;float:left'>Thanks,<br/><b>TentSoftware<b></font>";
			 $subject = "Greetings From TSM";
			deliver_mail($emailId,$fname.$lName,$emailId,$passwd,"sathishkumarb1139@gmail.com",$message,$subject);
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		} 
	}
	
	//Function delivers a mail
	function deliver_mail($sendmail_to,$fname,$userName,$password,$adminMail,$message,$subject) { 
    // if the submit button is clicked, send the email 

        // sanitize form values
        $name    = $fname;
        $email   = $sendmail_to;
        
       

        // get the blog administrator's email address 
        $headers = "From:". $adminMail. "\r\n";  
		
		 $Mailer           = new PHPMailer();
		 
		 $Mailer->IsSMTP();
		 $Mailer->SMTPAuth   = true;
		 $Mailer->SMTPSecure = 'ssl';
		 $Mailer->Host       = 'smtp.gmail.com';
		 $Mailer->Port       = 465;
		 
		 $Mailer->Username   = 'sathishkumarb1139@gmail.com';
		 $Mailer->Password   = 'goodgurub1139';
		 
		 $Mailer->Sender=$email;
		 $Mailer->addReplyTo($adminMail, 'Reply to Admin');
 		 $Mailer->setFrom($adminMail,"TSM Admin",TRUE);   
 
		// $Mailer->From       = $email;
		// $Mailer->FromName   = $name;
		 $Mailer->Subject    = $subject;
		 $Mailer->AltBody    = $message;
		 
		 $Mailer->MsgHTML($message);
		 
		 $Mailer->AddAddress($email, 'Admin');
		 
		 
		$Mailer->IsHTML(true);
		 
		 if (!$Mailer->send())
		 {
		   print 'Mailer Error: ' . $Mailer->ErrorInfo;
		 }
		 else
		 {
		 	//print 'Email has been sent';
		 }

	} 
	
	
	//Function retrieves the All the details about a requested user
	function userDeatils($userName){
		try{
			$con = getDBConnection(); 
			$rs = mysql_query("select * from user where email_id = '$userName'",$con);
			
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		} 	
		return mysql_fetch_row($rs);	
	}
	
	//Function updates the user profile
	function updateProfile($f_name,$l_name,$email_id,$re_pass_wd,$gender,$dob,$doj,$userName){
		try{ 
			$con = getDBConnection();  
			mysql_query("update user set first_name = '$f_name', last_name='$l_name', email_id = '$email_id', password='$re_pass_wd', gender='$gender', dob='$dob', doj='$doj'  WHERE email_id = '$userName'",$con);
			
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		}
	} 
	
	//Function retrieves all the user details
	function allUserDetails(){
		try{ 
			$con = getDBConnection(); 
			$rs = mysql_query("select * from user",$con);
			
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		}
		return $rs;
	}
	
	//Function sends username and password to the requested mail id
	function sendUsernamePassword($emailTo){
		try{ 
			$con = getDBConnection();  
			$rs = mysql_query("select first_name,last_name,email_id,password from user where email_id = '$emailTo'",$con);
			if(mysql_num_rows($rs) > 0){
				$row = mysql_fetch_row($rs); 
				$subject = "Forgot Password";
				$message = "<div>Hi $row[0]&nbsp; $row[1],<br/><br/><font color='#229954'><b>TentSurveyManager(TSM)</b></font> admin has sent your username and password for TSM.<br/><br/><table align='center' style='padding-top:3px;padding-bottom:3px;font-weight:bold'><tr><td>UserName:</td><td>$row[2]</td></tr><tr><td>Password:</td><td>$row[3]</td></tr></table><p>You can now vote for the events.</P></div><br/><br/><br/><font style='text-align:left;float:left'>Thanks,<br/><b>TentSoftware<b></font>";
				deliver_mail($row[2],$row[0].$row[1],$row[2],$row[3],"sathishkumarb1139@gmail.com",$message,$subject);	
				return 1;
			}else{
				return 0;
			}
			
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		} 
	}

	//Function deletes the given userDeatils
	function deleteUser($userName){
		try{ 
			$con = getDBConnection(); 
			mysql_query( "delete from user WHERE email_id = '$userName'",$con);
			
		}catch(Exception $ex){
			echo "Warning Message: ".$ex->getMessage();
		}finally{
			closeConnection($con);
		}
	}	 
?>