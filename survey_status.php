<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head> 
	<title>Survey Status</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link href="quiz.css" rel="stylesheet" type="text/css">
<!--	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
	<!--<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.migrate/jquery-migrate-1.0.0.min.js"/>-->
	 
	  	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	
	<script type="text/javascript" src="js/jquery.jqplot.1.0.8/jquery.jqplot.min.js"></script>
	<link rel="stylesheet" type="text/css" href="js/jquery.jqplot.1.0.8/jquery.jqplot.min.css" />
	<script type="text/javascript" src="js/jquery.jqplot.1.0.8/plugins/jqplot.barRenderer.min.js"></script> 
	<script type="text/javascript" src="js/jquery.jqplot.1.0.8/plugins/jqplot.categoryAxisRenderer.min.js"></script>
	<script type="text/javascript" src="js/jquery.jqplot.1.0.8/plugins/jqplot.pointLabels.min.js"></script>
	
</head> 

<body>
<div data-role="page">
	<div data-role="header" data-theme="c">
		<?php
			include("/functions/functions.php"); 
			include("header.php");  
			include("toolbar.php");  
			
			$survey = surveyDetails($_SESSION['login']);  
			$queId = $survey['queId'];
			$surveyStatus = getOptionCounts($queId);
		?> 
	</div>
	<div data-role="content" style="height:500px" data-theme="e">
		<table align="center" style="padding-top:20px"> 
			<tr>
				<td> <strong>Survey Name:</strong> </td>
				<td> <?php echo $survey['surveyName']; ?> </td>
			</tr>
			<tr>
				<td> <strong>ResultFor:</strong> </td>
				<td> <?php echo $survey['question']; ?> </td>
			</tr> 
		 </table>
		 <table align="center">
		 	<tr>
				<td><div id="chart1" style="width:300px"></div> </td>
			</tr>
		 </table>
		 <script>
		 	var s1 = [];
			var ticks = [];
		 	<?php 
				$i = 0;
				foreach($surveyStatus as $option => $vote)
				{
			?>
					s1[<?php echo $i;?>] = <?php echo $vote; ?>;
					ticks[<?php echo $i;?>] = "<?php echo $option; ?>";
			<?php	
					$i++;
				}
			?> 
		 	$(document).ready(function(){
        $.jqplot.config.enablePlugins = true;
       /* var s1 = [1, 1,2, 4]; 
        var ticks = ['Puli', 'Padayappa', 'Thanioruvan', 'Bahubali'];*/
         
        plot1 = $.jqplot('chart1', [s1], {
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
     
        $('#chart1').bind('jqplotDataClick', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
    });
		 </script>
		 
	</div>	 
	<div data-role="footer" data-theme="b">
		 <a  data-rel="back"  data-role="button" data-transition="reverse"  data-inline="true" data-theme="a" data-inset="true" data-icon="back">Go Back</a> 
	</div>
</div>
</body>
</html> 