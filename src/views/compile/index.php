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
  <li class="active"><a href="#">任务提交</a></li>
  <li><a href="?r=compile/log">日志输出</a></li>
</ul>
</td>
<td width="50%" align="right">
<?php
	if($runid!="")
		echo "<h3 style=\"font-family:'微软雅黑'\"><b>您的运行任务号为：<font color=\"red\">".$runid."</font></b></h3>";
?>
</td>
</tr>
</table>

<form id='form'>
  <div>

    		<div class="page-header">
    		<h3 style="font-family:'微软雅黑'"><b>第1步. 选择需要编译的新旧EC</b></h3>
    		</div>


    <div>
    <table width="100%">
       <tr>
          <td align="center" width="50%">
             <div align="center" class="btn-group">
             <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="selectnewec" value="none" style="height:32px;width:200px">选择新EC版本 <span class="caret"></span></button>
             <ul class="dropdown-menu" role="menu">
			 <li onclick="refreshNewVersion('none')" style="height:32px;width:200px"><a>选择新EC版本 </a></li>
             <?php
                $array = split("&&",$version_list);
                for ($i = 0;$i < count($array); $i++)
                {
                   echo "<li onclick=\"refreshNewVersion('".$array[$i]."')\" value=\"".$array[$i]."\"><a>".$array[$i]."</a></li>";
                }
             ?>
			 <li class="divider"></li>
             <li id='addnewECurl' onclick="refreshNewVersion('url')"><a href="#">新EC地址</a></li>	
             </ul>
             </div>
             <br/>
          </td>
          <td align="center" width="50%">
             <div align="center" class="btn-group">
             <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="selectoldec" value="none" style="height:32px;width:200px">选择旧EC版本 <span class="caret"></span></button>
             <ul class="dropdown-menu" role="menu">
			 <li onclick="refreshOldVersion('none')" style="height:32px;width:200px"><a>选择旧EC版本 </a></li>
             <?php
                $array = split("&&",$version_list);
                for ($i = 0;$i < count($array); $i++)
                {
                   echo "<li onclick=\"refreshOldVersion('".$array[$i]."')\"><a>".$array[$i]."</a></li>";
                }
             ?>
             <li class="divider"></li>
			 <li id='addoldECurl' onclick="refreshOldVersion('url')"><a href="#">旧EC地址</a></li>
			 </ul>
             </div>
             <br/>
           </td>
        </tr>
		<tr>
			<td>
				<div id="newec">
				</div>
			</td>
			<td>
				<div id="oldec">	
				</div>
			</td>
		</tr>
       </table>
     </div>




        <br/>


    	<div class="page-header">
        <h3 style="font-family:'微软雅黑'"><b>第2步. 配置需要变化的编译依赖</b></h3>
		</div>
        <div id="basicparameter">
        <table width="100%">
            <div id="dform">
            </div>
            <tr>
              <td align="center">
                   <div class="btn-group">
    				  <br/>
                      <button  class="btn btn-default" style="height:32px;width:200px" type='button' id='addlib'>新 增 依 赖</button>
                   </div>
              </td>
            </tr>
        </table>
        </div>
        
    <br/>
    <hr/>


      <table width="100%">
        <tr>
          <td align="center">
              <div class='btn-group'>
                <button class='btn btn-default' id="subtn" style="height:32px;width:200px" type="button" onclick="Submit_Form(1)">提 交 任 务</button>
                <button class='btn btn-default' id="runbtn" style="height:32px;width:200px" type="button" onclick="Submit_Form(2)" <?php 
				if($runid!="")
                	echo "disabled=\"disabled\"";
				?>>后台编译，去配置运行信息</button>
              </div>
          </td>
        </tr>
     </table>
  </div>
</form>

<!--
                <form method="post" action="?r=compile/compile">
                    <label class="radio"><input name="pinggu" type="radio" id="pinggu1" value="aa"/>aaaa</label> 
                    <label class="radio"><input name="pinggu" type="radio" id="pinggu2" value="" onclick="Mark(0)"/>一样</label> 
                    <label class="radio"><input name="pinggu" type="radio" id="pinggu3" value="" onclick="Mark(2)"/>变坏</label> 
                 <input type="submit"/>
                </form> 
-->


</div>
<script>


var newECurlcount=0;
var oldECurlcount=0;
function appendnewECurl(){

    var p=$('#newec p:last');
    if (newECurlcount == 0)
    {
    	p=$("<table width='100%'><tr><td><div class='input-group'><span class='input-group-addon'>新EC地址:</span><input class='form-control' id='newecurl' placeholder='https://svn.baidu.com/ps/spider/tags/i18n-ec/i18n-ec'></div></td></tr></table>").appendTo('#newec');
    	newECurlcount = 1;
    }
}
function appendoldECurl(){

    var p=$('#oldec p:last');
    if (oldECurlcount == 0)
    {
    	p=$("<table width='100%'><tr><td><div class='input-group'><span class='input-group-addon'>旧EC地址:</span><input class='form-control' id='oldecurl' placeholder='https://svn.baidu.com/ps/spider/tags/i18n-ec/i18n-ec'></div></td></tr></table>").appendTo('#oldec');
    	oldECurlcount = 1;
    }
}

$('#addnewECurl').click(function(){
    appendnewECurl();
});

$('#addoldECurl').click(function(){
    appendoldECurl();
});

var button_flag=0;
function Submit_Form(flag) {
	button_flag=flag;
	var newec_url="none";
	var ec_new_pattern = document.getElementById("selectnewec").value;
	//alert(ec_new_pattern);
	
	var oldec_url="none";
	var ec_old_pattern = document.getElementById("selectoldec").value;
	//alert(ec_old_pattern);

	if(ec_new_pattern=="none")
	{
		alert("你没有选择新EC!");
		return;	
	}
	if(ec_old_pattern=="none")
	{
		alert("你没有选择旧EC!");
		return;	
	}

	var fd = new FormData();
	if(ec_new_pattern=="url")
	{
		newec_url=document.getElementById("newecurl").value;
		if(newec_url=="")
		{
			alert("你没有填写新EC地址!");
			return;	
		}
		fd.append("NewEC_Pattern","Url")
		fd.append("NewEC_Url",newec_url);
	}
	else
	{
		fd.append("NewEC_Pattern","Version");
		fd.append("NewEC_Version",ec_new_pattern);
	}

	if(ec_old_pattern=="url")
	{
		oldec_url=document.getElementById("oldecurl").value;
		if(oldec_url=="")
		{
			alert("你没有填写旧EC地址!");
			return;	
		}
		fd.append("OldEC_Pattern","Url")
		fd.append("OldEC_Url",oldec_url);
	}
	else
	{
		fd.append("OldEC_Pattern","Version");
		fd.append("OldEC_Version",ec_old_pattern);
	}

	<?php
	if($runid!="")
	{
		echo "fd.append(\"Run_Task_Id\",".$runid.");";
	}

	?>


	
	var find_id = 10;
	var d_name = "null";
	var d_new = "null";
	var d_old = "null";
	fd.append("Dependence_Count",dependence_count);
	for(var ii = 0 ; ii < dependence_count ; ii++ , find_id = find_id + 10)
	{
		if(document.getElementById(find_id)==null)
		{
			ii= ii - 1;
			continue;
		}
		d_name =document.getElementById(find_id).value;	
		d_new =document.getElementById(find_id+1).value;	
		d_old =document.getElementById(find_id+2).value;	
		fd.append("Dependence_name"+ii,d_name);
		fd.append("Dependence_new_ver"+ii,d_new);
		fd.append("Dependence_old_ver"+ii,d_old);
	}

	var xhr = new XMLHttpRequest(); 
	xhr.addEventListener("load",markComplete,false);
    xhr.open("POST", "?r=compile/compile");
	xhr.send(fd);
	alert("Transmit OK!");	
}
var run_id;

function markComplete(evt)
{
    //alert(evt.target.responseText);
    var id_num=evt.target.responseText;
    alert("Compile Mission id:"+id_num);
	if(button_flag==1)
	{
	<?php
        
		if($runid!="")
		{
			echo "run_id=".$runid.";\n";
		}
	?>
	
    id_url='?r=compile/log&compileid='+id_num<?php
                if($runid!="")
                    echo "+'&runid='+run_id";
	?>;
    //window.open(id_url,"newwindow");
	}
	else if(button_flag==2)
	{
    	id_url='?r=run/index&compileid='+id_num;
	}

	window.location.href=id_url;
}


function refreshNewVersion(s){
	var word="0";
	if(s=="none")
	{
		alert("请选择新EC版本号！");
		word="选择新EC版本 ";
	}	
	else if(s=="url"){
		word="新EC地址";
	}
	else{
		word="新EC："+s+" <span class=\"caret\"></span>";
	}
	$('#selectnewec.btn').html(word);
	$('#selectnewec').val(s);
	if (newECurlcount == 1)
	{
		$('#newec').empty();
        newECurlcount = 0;
	}
}


function refreshOldVersion(s){
	var word="0";
	if(s=="none")
	{
		alert("请选择旧EC版本号！");
		word="选择旧EC版本 ";
	}	
	else if(s=="url"){
		word="旧EC地址";
	}
	else{
		word="旧EC："+s+" <span class=\"caret\"></span>";
	}
	$('#selectoldec.btn').html(word);
	$('#selectoldec').val(s);
	if (oldECurlcount == 1)
	{
		$('#oldec').empty();
        oldECurlcount = 0;
	}
}

var dependence_id=0;
var dependence_id_new=0;
var dependence_id_old=0;
var dependence_count=0;
function append(){
    dependence_id = dependence_id + 10;
    dependence_id_new = dependence_id + 1;
	dependence_id_old = dependence_id + 2;
	dependence_count = dependence_count + 1;
    var p=$('#dform p:last');
    var last=p.length>0? parseInt(p.attr('cc'))+1:0;
    p=$("<p cc='"+last+"'></p>").appendTo('#dform');
    p.append("<table width='100%'><tr><td><div class='input-group'><span class='input-group-addon'>依赖名<font color='#FF0000'> * </font></span><input class='form-control' id='"+dependence_id+"' placeholder='ps/se/page-value'></div></td><td><div class='input-group'><span class='input-group-addon'>新版本(4位)<font color='#FF0000'> * </font></span><input type='text' class='form-control' size='10' id='"+dependence_id_new+"' placeholder='1.0.33.1'></div></td><td><div class='input-group'><span class='input-group-addon'>旧版本(位)<font color='#FF0000'> * </font></span><input type='text' class='form-control' size='10' id='"+dependence_id_old+"' placeholder='1.0.32.0'></div></td><td><div class='btn-group'><button class='btn btn-default'>删除依赖</button></div></td></tr></table>");
    
	p.find('button').click(function(){
    	$(this).parent().parent().parent().parent().parent().parent().remove();
    	dependence_count = dependence_count - 1;
	});
}

$('#addlib').click(function(){
    append();
});


</script>

<?php $this->endContent(); ?>
