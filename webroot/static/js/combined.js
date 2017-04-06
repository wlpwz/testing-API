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
	
	/*	<?php
    		if($runid!="")
   			 {
        		echo "fd.append(\"Run_Task_Id\",".$runid.");";
    		}

    	?>*/


    
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
   /* <?php

        if($runid!="")
        {
            echo "run_id=".$runid.";\n";
        }
    ?>
    
    id_url='?r=compile/log&compileid='+id_num
	<?php
                if($runid!="")
                    echo "+'&runid='+run_id";
    ?>;*/
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




bin_pattern="null";
function bincheck(content)
{
    bin_pattern=content;
	console.log(bin_pattern);
}

var conf_pattern="null";
function confcheck(content)
{
    conf_pattern=content;
}

var input_pattern="null";
function inputcheck(content)
{
    input_pattern=content;
}

var type_attr="null";
function typecheck(content)
{
    type_attr=content;
}

var ecrun_pattern="null";
function ecruncheck(content)
{
    ecrun_pattern=content;
}

var consistentdiff_flag=true;
var newolddiff_flag=true;
function diffcheck(content)
{
    //consistent_diff=content;
	consistentdiff_flag=document.getElementById("consistentdiff").checked;
	newolddiff_flag=document.getElementById("newolddiff").checked;
	if(newolddiff_flag==false)
	{
		document.getElementById("selectoldecbin").disabled=true;
		document.getElementById("oldecftp1").disabled=true;
		document.getElementById("oldecftp2").disabled=true;
		document.getElementById("selectoldecconf").disabled=true;
		document.getElementById("newecconf1").disabled=true;
		document.getElementById("newecconf2").disabled=true;
		document.getElementById("oldecconf1").disabled=true;
        document.getElementById("oldecconf2").disabled=true;
		document.getElementById("productoldconfid").disabled=true;
        document.getElementById("ftpoldconfid").disabled=true;
		document.getElementById("productoldbinid").disabled=true;
    	document.getElementById("ftpoldbinid").disabled=true;
	}
	if(newolddiff_flag==true)
//	else if(content=="noconsistentdiff")
	{
		document.getElementById("selectoldecbin").disabled=false;
		document.getElementById("oldecftp1").disabled=false;
		document.getElementById("oldecftp2").disabled=false;
		document.getElementById("selectoldecconf").disabled=false;
		document.getElementById("newecconf1").disabled=false;
        document.getElementById("newecconf2").disabled=false;
        document.getElementById("oldecconf1").disabled=false;
        document.getElementById("oldecconf2").disabled=false;
        document.getElementById("productoldconfid").disabled=false;
        document.getElementById("ftpoldconfid").disabled=false;
		document.getElementById("productoldbinid").disabled=false;
		document.getElementById("ftpoldbinid").disabled=false;
	}

}
function bintypecheck(content)
{
	compile_flag=document.getElementById("compilebinid").checked;
	if(compile_flag==true)
	{
		document.getElementById("selectoldecbin").disabled=true;
		document.getElementById("selectnewecbin").disabled=true;
		document.getElementById("newecftp1").disabled=true;
		document.getElementById("newecftp2").disabled=true;
		document.getElementById("oldecftp1").disabled=true;
		document.getElementById("oldecftp2").disabled=true;
		document.getElementById("productnewbinid").disabled=true;
		document.getElementById("productoldbinid").disabled=true;
		document.getElementById("ftpnewbinid").disabled=true;
		document.getElementById("ftpoldbinid").disabled=true;
	}
	if(compile_flag==false)
	{
		document.getElementById("selectoldecbin").disabled=false;
		document.getElementById("selectnewecbin").disabled=false;
		document.getElementById("newecftp1").disabled=false;
		document.getElementById("newecftp2").disabled=false;
		document.getElementById("oldecftp1").disabled=false;
		document.getElementById("oldecftp2").disabled=false;
		document.getElementById("productnewbinid").disabled=false;
		document.getElementById("productoldbinid").disabled=false;
		document.getElementById("ftpnewbinid").disabled=false;
		document.getElementById("ftpoldbinid").disabled=false;
	}
}
var button_flag=0;
function Submit_Form(flag) {
	button_flag=flag;
	
	if(button_flag==1)
	{
		bin_pattern="none";
	}
	


	var fd = new FormData();
/*
<?php
	if($compile_id!="null")
	echo "bin_pattern=\"compile\"";	
?>
*/

	
	if(consistentdiff_flag==false&&newolddiff_flag==false)
	{
		alert("请选择是否进行新版一致性Diff比较!");
		return;	
	}
	else if(consistentdiff_flag==true&&newolddiff_flag==true)
	{
		fd.append("Consistent_Diff","both");
	}
	else if(consistentdiff_flag==true&&newolddiff_flag==false)
	{
		fd.append("Consistent_Diff","consistentdiff");
	}
	else if(consistentdiff_flag==false&&newolddiff_flag==true)
	{
		fd.append("Consistent_Diff","newolddiff");
	}
	else
	{
		alert("是否一致性Diff选择出现未知问题");
		return;
	}
	

	var ec_new_bin_value;
	var ec_old_bin_value;
	var compile_id_num;

	if(bin_pattern=="null")
	{
		alert("你需要选择使用EC BIN文件!");
		return;	
	}
	else if(bin_pattern=="none")
	{
		fd.append("Bin_Pattern",bin_pattern);
	}
	else if(bin_pattern=="product")
	{
		ec_new_bin_value = document.getElementById("selectnewecbin").value;
		ec_old_bin_value = document.getElementById("selectoldecbin").value;
		if (newolddiff_flag==true&&(ec_new_bin_value=="none"||ec_old_bin_value=="none"))
    	{
        	alert("你需要选择EC bin文件的版本!");
        	return; 
    	}
		else if (newolddiff_flag==false&&ec_new_bin_value=="none")
    	{
        	alert("你需要选择EC bin文件的版本!");
        	return; 
    	}
		fd.append("Bin_Pattern",bin_pattern);
		fd.append("New_EC_Bin_Value",ec_new_bin_value);
		if (newolddiff_flag==true)
			fd.append("Old_EC_Bin_Value",ec_old_bin_value);
	}
	else if(bin_pattern=="compile")
	{
		compile_id_num = document.getElementById("compiletaskid").value; 
		if (compile_id_num=="")
    	{
        	alert("你需要填写EC编辑的任务号!");
        	return; 
    	}
		fd.append("Bin_Pattern",bin_pattern);
		fd.append("Compile_Id",compile_id_num);
	}
	else if(bin_pattern=="ftp")
	{
		ec_new_bin_value = document.getElementById("newecftp").value;
		ec_old_bin_value = document.getElementById("oldecftp").value;
		if (newolddiff_flag==true&&(ec_new_bin_value==""||ec_old_bin_value==""))
    	{
        	alert("你需要填写EC bin文件的FTP地址!");
        	return; 
    	}
		else if (newolddiff_flag==false&&ec_new_bin_value=="")
    	{
        	alert("你需要填写EC bin文件的FTP地址!");
        	return; 
    	}
		fd.append("Bin_Pattern",bin_pattern);
		fd.append("New_EC_Bin_Value",ec_new_bin_value);
		if (newolddiff_flag==true)
			fd.append("Old_EC_Bin_Value",ec_old_bin_value);
	}
	else
	{
		alert("EC Bin选择出现未知问题");
		return;
	}


	if(type_attr=="null")
	{
		alert("请选择EC的类型!");
		return;	
	}
	else if(type_attr=="chineseec")
	{
		fd.append("EC_Type",type_attr);
	}
	else if(type_attr=="internationalec")
	{
		fd.append("EC_Type",type_attr);
	}
	else
	{
		alert("EC类型选择出现未知问题");
		return;
	}

	var ec_new_conf_value;
	var ec_old_conf_value;
	if(conf_pattern=="null")
	{
		alert("你需要选择使用EC CONF文件!");
		return;	
	}
	else if(conf_pattern=="product")
	{
		ec_new_conf_value = document.getElementById("selectnewecconf").value;
		ec_old_conf_value = document.getElementById("selectoldecconf").value;
		if (newolddiff_flag==true&&(ec_new_conf_value=="none"||ec_old_conf_value=="none"))
    	{
        	alert("你需要选择EC配置文件版本!");
        	return; 
    	}
		else if (newolddiff_flag==false&&ec_new_conf_value=="none")
    	{
        	alert("你需要选择EC配置文件版本!");
        	return; 
    	}
		fd.append("Conf_Pattern",conf_pattern);
		fd.append("New_EC_Conf_Value",ec_new_conf_value);
		if (newolddiff_flag==true)
			fd.append("Old_EC_Conf_Value",ec_old_conf_value);
	}
	else if(conf_pattern=="svn")
	{
		ec_new_conf_value = document.getElementById("newecsvn").value;
		ec_old_conf_value = document.getElementById("oldecsvn").value;
		if (newolddiff_flag==true&&(ec_new_conf_value==""||ec_old_conf_value==""))
    	{
        	alert("你需要填写EC配置文件的ftp地址!");
        	return; 
    	}
		else if (newolddiff_flag==false&&ec_new_conf_value=="")
    	{
        	alert("你需要填写EC配置文件的ftp地址!");
        	return; 
    	}
		fd.append("Conf_Pattern",conf_pattern);
		fd.append("New_EC_Conf_Value",ec_new_conf_value);
		if (newolddiff_flag==true)
			fd.append("Old_EC_Conf_Value",ec_old_conf_value);
	}
	else
	{
		alert("EC Conf选择出现未知问题");
		return;
	}
	
	var ec_input_name="null";
	var ec_input_num="null";
	var ec_input_path="null";
	if(input_pattern=="null")
	{
		alert("你需要选择EC输入数据类型!");
		return;	
	}
	else if(input_pattern=="product")
	{
		ec_input_name = document.getElementById("ecinputproduct").value;
		ec_input_num = document.getElementById("ecinputnum").value;
		if (ec_input_name=="none"||ec_input_num=="none")
    	{
        	alert("你需要选择EC输入数据类型!");
        	return; 
    	}
		fd.append("Input_Pattern",input_pattern);
		fd.append("Input_Name",ec_input_name);
		fd.append("Input_Num",ec_input_num);
	}
	else if(input_pattern=="path")
	{
		ec_input_path = document.getElementById("ecinputpath").value;
		if (ec_input_path=="")
    	{
        	alert("你需要填写输入包的地址!");
        	return; 
    	}
		fd.append("Input_Pattern",input_pattern);
		fd.append("Input_Path",ec_input_path);
	}
	else
	{
		alert("EC输入方式出现未知问题");
		return;
	}

	if(ecrun_pattern=="null")
	{
		alert("你需要选择EC运行地址!");
		return;	
	}
	else if(ecrun_pattern=="default")
	{
		fd.append("Ecrun_Pattern",ecrun_pattern);
	}
	else if(ecrun_pattern=="outside")
	{
		ec_run_host_name = document.getElementById("ecrunhostname").value;
		ec_run_path = document.getElementById("ecrunpath").value;
		if (ec_run_host_name=="none"||ec_run_path=="none")
    	{
        	alert("你输入EC的运行地址信息!");
        	return; 
    	}
		fd.append("Ecrun_Pattern",ecrun_pattern);
		fd.append("Ecrun_Host_Name",ec_run_host_name);
		fd.append("Ecrun_Path",ec_run_path);
	}

	var xhr = new XMLHttpRequest(); 
	xhr.addEventListener("load", markComplete,false);
    xhr.open("POST", "?r=run/upload");
	xhr.send(fd);
	alert("编译运行成功!");	
}

function markComplete(evt)
{
    //alert(evt.target.responseText);
    var run_id_num=evt.target.responseText;
	//alert("Run Mission id:"+run_id_num);
	if(button_flag==1)
	{
   		var id_url='?r=compile/index&runid='+run_id_num;
	}
	else if(button_flag==2)
	{
	    var id_url='?r=diff/resultanalysis&runid='+run_id_num;
	}
//	window.location.href=id_url;
    
//	window.open(id_url,"newwindow");
}


function refreshBinNewVersion(s){
	var word="0";
	if(s=="none")
	{
		alert("请选择新EC Bin版本！");
		word="在产品库选择新EC Bin "+" <span class=\"caret\"></span>";
	}	
	else{
		word="新EC Bin："+s+" <span class=\"caret\"></span>";
	}
	$('#selectnewecbin.btn').html(word);
	$('#selectnewecbin').val(s);
}

function refreshBinOldVersion(s){
	var word="0";
	if(s=="none")
	{
		alert("请选择旧EC Bin版本！");
		word="在产品库选择旧EC Bin "+" <span class=\"caret\"></span>";
	}	
	else{
		word="旧EC Bin："+s+" <span class=\"caret\"></span>";
	}
	$('#selectoldecbin.btn').html(word);
	$('#selectoldecbin').val(s);
}


function refreshConfNewVersion(s){
	var word="0";
	if(s=="none")
	{
		alert("请选择新EC Conf版本！");
		word="在产品库选择新EC Conf "+" <span class=\"caret\"></span>";
	}	
	else{
		word="新EC Conf："+s+" <span class=\"caret\"></span>";
	}
	$('#selectnewecconf.btn').html(word);
	$('#selectnewecconf').val(s);
}

function refreshConfOldVersion(s){
	var word="0";
	if(s=="none")
	{
		alert("请选择旧EC Conf版本！");
		word="在产品库选择旧EC Con "+" <span class=\"caret\"></span>";
	}	
	else{
		word="旧EC Conf："+s+" <span class=\"caret\"></span>";
	}
	$('#selectoldecconf.btn').html(word);
	$('#selectoldecconf').val(s);
}


function refreshInput(s){
	var word="0";
	if(s=="none")
	{
		alert("请选择输入数据类型！");
		word="选择EC输入数据 "+" <span class=\"caret\"></span>";
	}	
	else{
		word="输入数据类型："+s+" <span class=\"caret\"></span>";
	}
	$('#ecinputproduct.btn').html(word);
	$('#ecinputproduct').val(s);
}

function refreshInputNum(s){
	var word="0";
	if(s=="none")
	{
		alert("请选择输入包数量");
		word="数量 "+" <span class=\"caret\"></span>";
	}	
	else{
		word="数量："+s+"个 <span class=\"caret\"></span>";
	}
	$('#ecinputnum.btn').html(word);
	$('#ecinputnum').val(s);
}


