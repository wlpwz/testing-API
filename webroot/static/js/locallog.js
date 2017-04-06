(function()
 {
	var temp=$('#log').html();
	console.log(temp);
	var Locallog = function()
	{
		var _this=this;
		var	resulturl="index.php?r=localresult/log";
		alert(taskid);
		
	}/*
	Locallog.prototype.countSecond = function(taskid)
	{
		var sendData ={taskid:taskid};
		$.post(_this.resultUrl, function(ajaxObj)
		{
			var result = $.parseJSON(ajaxObj);
			console.log(result.taskid);
			$('#log').html('result.taskid');
			
		});
		setTimeout(function(){_this.countSecond(jobid);}, 10*1000);
		
	}*/
 })();
