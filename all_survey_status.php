<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head> 
	<title>All Survey Status</title> 
	<?php require_once "js_css_files.html"; ?> 
	<script type="text/javascript" src="js/jquery.jqplot.1.0.8/jquery.jqplot.min.js"></script>
	<link rel="stylesheet" type="text/css" href="js/jquery.jqplot.1.0.8/jquery.jqplot.min.css" />
	<script type="text/javascript" src="js/jquery.jqplot.1.0.8/plugins/jqplot.barRenderer.min.js"></script> 
	<script type="text/javascript" src="js/jquery.jqplot.1.0.8/plugins/jqplot.categoryAxisRenderer.min.js"></script>
	<script type="text/javascript" src="js/jquery.jqplot.1.0.8/plugins/jqplot.pointLabels.min.js"></script>
	<script src="/TSM/js/survey.js"></script> 
	
</head> 
<style>
	@media all and (max-width: 35em) {
	.my-breakpoint .ui-block-a, 
	.my-breakpoint .ui-block-b, 
	.my-breakpoint .ui-block-c,
	.my-breakpoint .ui-block-d,
	.my-breakpoint .ui-block-e { 
		width: 100%; 
		float:none; 
	}
}
</style>
<script>
		var chartList = []; 
		function setCharts(survey,id)
		{ 
			chartList[id] = survey;  
		}
		 function showSurveys(id)
		 { 
		 	$('#chart_b'+id).remove(); 
			survey = chartList[id]; 
		 	var s1= [];
			var ticks = [];
			var iter = 0;
		 	for(var x in survey)
			{ 
				s1[iter] = parseInt(survey[x]); 
				ticks[iter] = ""+x;
				iter++;
			}   
			id = "chart"+id; 
		 	  $(document).ready(function(){
        $.jqplot.config.enablePlugins = true; 
         
        plot1 = $.jqplot(id, [s1], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true },
				 rendererOptions: {
                // Set the varyBarColor option to true to use different colors for each bar.
                // The default series colors are used.
                varyBarColor: true
            	}
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks
                }
            },
            highlighter: { show: false }
        });
     
        $('#'+id).bind('jqplotDataClick', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
    });
	}
	 
function addOnclickEvent(surveyName,id,su_id)
	{  
		$("h2[class="+"s_"+su_id+"]").click(showSurveys(id));
	}
		 </script>
<body>
<div data-role="page">
	<div data-role="header" data-theme="a">
		<?php
			include("/functions/functions.php");  
			include("header.php");  
			include("toolbar.php");  
			
			$survey = getSurveyNameId();
			if(count($survey) == 0)
			{
				echo "<center><h4><marquee><font color='red'>Admin Has Not Added Any Survey to Vote For !!!</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='red'>Admin Has Not Added Any Survey to Vote For !!!</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='red'>Admin Has Not Added Any Survey to Vote For !!!</font></marquee></h4></center>";
			}
		?> 
	</div>
	<div data-role="content"  class="body-style" data-theme="a"> 
		<h2 class="style8"><center>Survey Results</center></h2>
		<div data-role="collapsible-set" data-theme="b" data-content-theme="a" data-mini="true" >
			<?php 
				$i = 0;
				$div_id = 1;
				foreach($survey as $id => $name)
				{ 
					$questions = getQuestionBySurveyId($id); 
			?>
				 <?php 
						if($i == 0)
						{
					?>
					<div data-role="collapsible"  data-collapsed="false">
					
					<?php 
						}else{
					?>
					<div data-role="collapsible">
					<?php } ?>
					 
					<h2 class="s_<?php echo $id;?>"><?php echo $name;?></h2>
					   
					  <div class="ui-grid-b my-breakpoint"> 
					 <?php 
					 	 while($question = mysql_fetch_array($questions))
						 {
						 	
					?>
						<div class="ui-block-a ui-responsive">
							<p>Event Name:&nbsp;<b><font color="#008000"><?php echo $question[1];?></font></b></p>
							<?php  						
								$surveyStatus = getOptionCounts($question[0]);  
							?>	
							<div id="chart<?php echo $div_id; ?>"> 
									<input id="chart_b<?php echo $div_id; ?>" type="button" value="Show The Result" onclick="showSurveys(<?php echo $div_id;?>)" data-mini="true" data-inline="true"/> 
							</div>
							<script>  
								var resultSet = <?php echo json_encode($surveyStatus); ?>;   
								setCharts(resultSet,<?php echo $div_id; ?>); 
								<?php
									if($i == 0)
									{
								?>
										showSurveys(<?php echo $div_id;?>); 
								<?php 
									}
								?>
							</script> 
							
						</div>  
						
					<?php 
							 
						$div_id++;
						}
					?>
					</div>
				</div>  
			<?php 
				$i++;
				}
			?>
		 </div>
		 
		 
	</div>	 
	 <?php include "footer.html";?>
</div>
</body>
</html> 