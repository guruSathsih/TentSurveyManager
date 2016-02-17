<div data-role="header" data-theme="a" style="border-width:1px !important">
  
	<div data-role="navbar"> 
		<ul>
			<li><a href="/TSM/home.php"  id="home_" data-transition="slide" data-icon="home" data-rel="external" data-ajax="false"> Home </a></li>
			<li><a href="/TSM/all_survey_status.php" id="survey_" data-rel="external" data-ajax="false" data-transition="slide" class="ui-btn" data-icon="grid" >Survey Status</a> </li>
			<?php
				if(isAdmin($_SESSION['usertype'] ) == 1)
				{
			?>
			<li><a href="/TSM/admin/add_survey.php" id="admin_" data-rel="external" data-ajax="false" data-transition="slide" data-direction="slide" class="ui-btn" data-icon="gear">Manage Survey</a> </li>
			<?php
				}
			?>
			<li><a href="/TSM/profile.php" id="profile" data-transition="slide" data-direction="reverse" class="ui-btn" data-icon="user" data-rel="external" data-ajax="false">My Profile</a> </li>
			<li><a href="/TSM/signout.php"  data-transition="slide" data-direction="reverse" class="ui-btn" data-icon="lock">Signout</a> </li>
		</ul>
	</div>
</div>
<script>
	var path = location.pathname; 
	if(path == "/TSM/home.php"){    
		var d = document.getElementById("home_");
		d.className = d.className + " ui-btn-active";
	}else if(path == "/TSM/all_survey_status.php"){      
		var d = document.getElementById("survey_");
		d.className = d.className + " ui-btn-active"; 
	}else if(path == "/TSM/admin/add_survey.php"){    
		var d = document.getElementById("admin_");
		d.className = d.className + " ui-btn-active";
	}else if(path == "/TSM/admin/signup.php"){    
		var d = document.getElementById("admin_");
		d.className = d.className + " ui-btn-active";
	}else if(path == "/TSM/profile.php"){     
		var d = document.getElementById("profile");
		d.className = d.className + " ui-btn-active";
	}else if(path == "/TSM/admin/updateuser-admin.php"){    
		var d = document.getElementById("admin_");
		d.className = d.className + " ui-btn-active";
	}else if(path == "/TSM/admin/updateuserprofile.php"){    
		var d = document.getElementById("admin_");
		d.className = d.className + " ui-btn-active";
	}
</script>