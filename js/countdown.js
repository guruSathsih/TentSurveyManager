var temp = [];
function getSurveyIds(){
	$.ajax({
		type:"post",
		url:"getOpenedSurveyId.php", 
		success:function(data){  
			var array = JSON.parse("[" + data + "]");
			var str = ""+array[0];
			temp = str.split(",");  
			}
	});
}
getSurveyIds();
$(document).ready(function () {        
	setInterval(function(){for(i=0;i<temp.length;i++){
			  	increment(temp[i]); 
	}},600);   
});

function increment(tableId){
         
	survey_id = tableId;
	
	$.ajax({
		type:"post",
		url:"countdown.php",
		data:{
			  "surveyId":survey_id
			},
		success:function(data){  
			  datetime = data.split(":");  
			  $("#sec"+tableId).text(parseInt(datetime[3]));  
			  $("#min"+tableId).text(parseInt(datetime[2]));  
			  $("#hour"+tableId).text(parseInt(datetime[1]));  
			  $("#day"+tableId).text(parseInt(datetime[0]));
			}
	});
}