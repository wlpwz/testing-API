<?php
        $r['topic'] = "compile";
        $this->beginContent('/layouts/main',array('topic'=>$r));
?>
<div class="container">
<br/>

<table width="100%">
<tr>
<td width="50%">
<ul class="nav nav-pills">
  <li><a href="?r=compile/index">任务提交</a></li>
  <li class="active"><a href="#">日志输出</a></li>
</ul>
</td>
<td width="50%" align="right">
<?php
    if($compileid!="")
        echo "<h3 style=\"font-family:'微软雅黑'\"><b>您的编译任务号为：<font color=\"red\">".$compileid."</font>";
    if($runid!="")
        echo "  您的运行任务号为：<font color=\"red\">".$runid."</font>";
    if($compileid!="")
		echo "</b></h3>";

?>
</td>
</tr>
</table>










<form id='form'>
  <div>

    <div class="page-header">
            <h3 style="font-family:'微软雅黑'"><b>相关日志</b></h3>
    </div>
    <div>
    <table width="100%">
       <tr>
          <td align="center" width="50%">
             <div align="center" class="btn-group">
			 <button  class="btn btn-default" type='button' id='show_err_msg'>实时显示Err日志</button>	
             </div>
             <br/>
          </td>
          <td align="center" width="50%">
             <div align="center" class="btn-group">
			 <button  class="btn btn-default" type='button' id='show_log_msg'>实时显示Log日志</button>	
             </div>
             <br/>
          </td>
        </tr>

       <tr>
          <th colspan="2">
			<p></p> 
			<div class="panel panel-info">	
    		<div class="panel-heading">Err日志</div>
			<div align="left" class="panel-body" id="errmsg">
             </div>
			</div>
			<div class="panel panel-success">	
    		<div class="panel-heading">Log日志</div>
			<div align="left" class="panel-body" id="logmsg">
             </div>
			</div>
          </th>
        </tr>

	
       </table>
     </div>
        <br/>
    <hr/>
  </div>
</form>

<table width="100%">
	<tr>
		<td align="center" width="100%">
		<div align="center" class="btn-group">
			<button class="btn btn-default" type='button' id='runbtn' onclick="Submit_Run(0)" <?php
			if ($runid!="")
				echo "disabled=\"disabled\"";
			?>>在后台编译，先配置运行信息</button>	
			<button class="btn btn-default" type='button' id='analysisbtn' onclick="Submit_Analysis(0)" disabled="disabled">编译已完成，前往效果分析页面</button>	
		</div>
		</td>
	</tr>
</table>
</div>
<script>
var tinterval_err;
$('#show_err_msg').click(function(){
	//window.clearInterval(tinterval_log);
	tinterval_err=setInterval("Err_Msg_Data()",3000);
});

var tinterval_log;
$('#show_log_msg').click(function(){
	//window.clearInterval(tinterval_err);
	tinterval_log=setInterval("Log_Msg_Data()",3000);
});

var err_count=0;
function Err_Msg_Data() {
		var fd = new FormData();
		fd.append("Count",err_count);
		<?php
			if($compileid == "")
			{
				echo "fd.append(\"Mission_id\",\"null\");\n";
			}
			else{
        		echo "fd.append(\"Mission_id\",\"".$compileid."\");\n";
			};
		?>
		var xhr = new XMLHttpRequest(); 
		xhr.addEventListener("load",err_markComplete,false);
    	xhr.open("POST", "?r=compile/errmsgdata");
    	//xhr.open("POST", "?r=compile/test");
		xhr.send(fd);
		//alert("Transmit OK!");	
}
var err_flag=0;
var err_display=0;
function err_markComplete(evt)
{
	var err_msg=evt.target.responseText;
	//if (log_flag > 0)
	//{
		//$('#logmsg').empty();
	//	var logstyle = document.getElementById ("logmsg");	
	//	logstyle.style.display="none";
	//	log_display=0;
	//}
    //if(err_flag===1 && err_display===0)
	//{
	//	var errstyle = document.getElementById ("errmsg");  
    //    errstyle.style.display="none";
    //    err_display=0;
	//}
	var p=$('#errmsg p:last');
	p=$(err_msg).appendTo('#errmsg');
    p=$('#errmsg p:last');
    err_count=parseInt(p.attr('cc'));
	err_flag=1;
	//err_display=1;
	var missioncomplete=document.getElementById("missioncomplete");
	if (missioncomplete!==null)
	{
		window.clearInterval(tinterval_err);
	}
}


var log_count=0;
function Log_Msg_Data() {
		var fd = new FormData();
		fd.append("Count",log_count);
		<?php
			if($compileid == "")
			{
				echo "fd.append(\"Mission_id\",\"null\");\n";
			}
			else{
        		echo "fd.append(\"Mission_id\",\"".$compileid."\");\n";
			};
		?>
		var xhr = new XMLHttpRequest(); 
		xhr.addEventListener("load",log_markComplete,false);
    	xhr.open("POST", "?r=compile/logmsgdata");
    	//xhr.open("POST", "?r=compile/test");
		xhr.send(fd);
		//alert("Transmit OK!");	
}
var log_flag=0;
var log_display=0;
function log_markComplete(evt)
{
	var log_msg=evt.target.responseText;
	//if (err_flag > 0)
	//{
	//	//$('#errmsg').empty();
	//	var logstyle = document.getElementById ("logmsg");	
	//	logstyle.style.display="none";
	//	log_display=0;
	//}
	var p=$('#logmsg p:last');
	p=$(log_msg).appendTo('#logmsg');
    p=$('#logmsg p:last');
    log_count=parseInt(p.attr('ccc'));
	//log_flag=1;
	//log_display=1;
	var logmissioncomplete=document.getElementById("logmissioncomplete");
	if (logmissioncomplete!==null)
	{
		window.clearInterval(tinterval_log);
		<?php
			if($runid!="")
				echo "document.getElementById(\"analysisbtn\").disabled=false;\n";
		?>
	}
}


function Submit_Run(flag) {
		<?php
			if($compileid == "")
			{
				echo "alert(\"没有编译任务ID!\");\n"; 
			}
			else{
    			echo "id_url=\"?r=run/index&compileid=".$compileid."\";\n";
    			echo "window.location.href=id_url;\n";
			};
		?>
}

function Submit_Analysis(flag) {
		<?php
			if($runid == "")
			{
				echo "alert(\"没有运行任务ID!\");\n"; 
			}
			else{
    			echo "id_url=\"?r=diff/resultanalysis&runid=".$runid."\";\n";
    			echo "window.location.href=id_url;\n";
			};
		?>
}

</script>

<?php $this->endContent(); ?>
