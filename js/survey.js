function showHint(surveyName)
{
	status = true;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
	{ 
		if(xmlhttp.readyState == 4)
		{  
			//document.getElementById("hint1").innerHTML = xmlhttp.responseText;
			if(xmlhttp.responseText.trim().length > 0)
			{
				status = false; 
			}  
		}
	}
	xmlhttp.open("GET","/TSM/admin/survey_suggestion.php?s_name="+surveyName.trim(),true);
	xmlhttp.send();
}
function validateSurveyName()
{ 
	if(status == "true")
	{
		return true;
	}else{ 
		document.getElementById("hint1").innerHTML = "Entered Survey Name is Already Exist !!!";
		return false;
	} 
}

function updateSurvey(formId)
{ 
	formdata = $("#edit_survey_form_"+formId).serialize(); 
	$.ajax({
           type: "POST",
           url: 'login.php', 
		   data: formdata,
           success: function(data)
           {//alert(data);
		   	//$("#AllSurveys").html(data);
		   	window.location.href= "/TSM/admin/add_survey.php";
           }
         });
	return false;
}

//Function validates the user sign up form
function checkSignUp()
{ 
  if(document.signup.pass_wd.value!=document.signup.re_pass_wd.value)
  {
    alert("Confirm Password does not matched");
	document.signup.re_pass_wd.focus();
	return false;
  }
  if(document.getElementById("dob").value.trim() == "")
  {
    alert("Please Enter Your Date Of Birth");
	document.signup.dob.focus();
	return false;
  } 
  if(document.getElementById("doj").value.trim() == "")
  {
    alert("Please Enter Your Date of Joining");
	document.signup.doj.focus();
	return false;
  }
  return true;
}

//Validates the Updating Profile
function updateProfile()
{ 
  if(document.update_profile.pass_wd.value!=document.update_profile.re_pass_wd.value)
  {
    alert("Confirm Password does not matched");
	document.update_profile.re_pass_wd.focus();
	return false;
  }
  if(document.getElementById("dob").value.trim() == "")
  {
    alert("Please Enter Your Date Of Birth");
	document.update_profile.dob.focus();
	return false;
  } 
  if(document.getElementById("doj").value.trim() == "")
  {
    alert("Please Enter Your Date of Joining");
	document.update_profile.doj.focus();
	return false;
  }
  return true;
}

function emailStatus(){ 
	formdata = document.getElementById("emailid").value; 
	$.ajax({
           type: "POST",
           url: 'sendUnamePword.php', 
		   data: {'emailid':formdata},
           success: function(data)
           {  
		   		if(data == 1){
					document.getElementById("error").style.display = "none";	
					document.getElementById("success").style.display = "block";	
					setTimeout(function(){window.location.href= "/TSM/index.php"}, 3000); 
				}else{
					document.getElementById("success").style.display = "none";	
					document.getElementById("error").style.display = "block";	
				} 
		   		 
           }
         });
	return false;
}

function submitForm(formId){alert(formId);
	document.getElementById(formId).submit();
	return true;
}
// JavaScript Document