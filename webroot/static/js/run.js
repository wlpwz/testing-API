
bin_pattern_new="scm";
function bincheck1(content)
{
    bin_pattern_new=content;
}

bin_pattern_old="scm";
function bincheck2(content)
{
    bin_pattern_old=content;
}
var conf_pattern="null";
function confcheck(content)
{
    conf_pattern=content;
}

var input_pattern="platform_data";
function inputcheck(content)
{
    input_pattern=content;
}

var type_attr="chineseec";
function typecheck(content)
{
    type_attr=content;
}

var ecrun_pattern="default";
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
	
	var fd = new FormData();
	var run_type="";
	var desc=document.getElementById("des").value;
	if (desc == "")
	{ alert("请输入任务描述~"); return;}
	fd.append("desc",desc);	
	
	if(consistentdiff_flag==false&&newolddiff_flag==false)
	{
		alert("请选择是否进行新版一致性Diff比较!");
		return;	
	}
	else if(consistentdiff_flag==true&&newolddiff_flag==true)
	{
		run_type="both";
		fd.append("run_type","both");
	}
	else if(consistentdiff_flag==true&&newolddiff_flag==false)
	{
		run_type="consistentdiff";
		fd.append("run_type","consistentdiff");
	}
	else if(consistentdiff_flag==false&&newolddiff_flag==true)
	{
		run_type="newolddiff";
		fd.append("run_type","newolddiff");
	}
	else
	{
		alert("是否一致性Diff选择出现未知问题");
		return;
	}
	

	fd.append("new_flag",bin_pattern_new);
	if(bin_pattern_new=="scm")
	{
		var new_version=document.getElementById("new_scm").value;
		if (new_version == "")
		{
			alert("出现未知问题 new_scm");
			return;	
		}
		fd.append("new_version",new_version);
	}
	else if (bin_pattern_new="ftp")
	{
		new_ec1_bin=document.getElementById("newecftp1").value;
		new_ec2_bin=document.getElementById("newecftp2").value;
		new_ec1_conf=document.getElementById("newecconf1").value;
		new_ec2_conf=document.getElementById("newecconf2").value;
		if (new_ec1_bin ==""|| new_ec2_bin == "")
    	{
        	alert("你需要给出new EC bin的ftp地址!");
        	return; 
    	}
		if (new_ec1_conf == "" || new_ec2_conf == "")
		{
        	alert("你需要给出new EC conf的ftp地址!");
			return;
		}
		fd.append("new_ec1_bin",new_ec1_bin);
		fd.append("new_ec2_bin",new_ec2_bin);
		fd.append("new_ec1_conf",new_ec1_conf);
		fd.append("new_ec2_conf",new_ec2_conf);
	}
	else
	{
		alert("请选择scm或者ftp方式");
		return ;
	}
	if (run_type=="newolddiff" || run_type == "both")
	{
		fd.append("old_flag",bin_pattern_old);
		if (bin_pattern_old == "scm")
		{
			var old_version = document.getElementById("old_scm").value;
			if (old_version == "")
			{
				alert("未知错误 old_scm");
				return ;
			}
			fd.append("old_version",old_version);
		}
		else if (bin_pattern_old = "ftp")
		{
			var old_ec1_bin = document.getElementById("oldecftp1").value;
			var old_ec2_bin = document.getElementById("oldecftp2").value;
			var old_ec1_conf = document.getElementById("oldecconf1").value;
			var old_ec2_conf = document.getElementById("oldecconf2").value;
			if (old_ec1_bin == "" || old_ec2_bin == "")
			{
				alert("你需要给出old EC的bin的ftp地址");
				return ;
			}
			if (old_ec1_conf == "" || old_ec2_conf == "")
			{
				alert("你需要给出old EC的conf的ftp地址");
				return ;
			}
			fd.append("old_ec1_bin",old_ec1_bin);
			fd.append("old_ec2_bin",old_ec2_bin);
			fd.append("old_ec1_conf",old_ec1_conf);
			fd.append("old_ec2_conf",old_ec2_conf);	
		}
		else
		{
			alert("请选择scm或者ftp方式");
			return ;
		}
	}
	if(type_attr=="chineseec")
	{
		fd.append("langtype",type_attr);
	}
	else if(type_attr=="internationalec")
	{
		fd.append("langtype",type_attr);
	}
	else
	{
		alert("EC类型选择出现未知问题");
		return;
	}

	
	
	if(input_pattern=="null")
	{
		alert("你需要选择EC输入数据类型!");
		return;	
	}
	else if(input_pattern=="platform_data")
	{
		ec_input_num = document.getElementById("ecinputnum").value;
		if (ec_input_num=="none")
    	{
        	alert("你需要选择EC输入数据类型!");
        	return; 
    	}
		fd.append("input_flag","plat");
		fd.append("pack_num",ec_input_num);
	}
	else if(input_pattern=="path")
	{
		ec_input_path = document.getElementById("ecinputpath").value;
		if (ec_input_path=="")
    	{
        	alert("你需要填写输入包的地址!");
        	return; 
    	}
		fd.append("input_flag","ftp");
		fd.append("pack",ec_input_path);
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
	alert("任务提交成功");	
}

function markComplete(evt)
{
    //alert(evt.target.responseText);
    var run_id_num=evt.target.responseText;
	alert("Run Mission id:"+run_id_num);
/*	if(button_flag==1)
	{
   		var id_url='?r=compile/index&runid='+run_id_num;
	}
	else if(button_flag==2)
	{
	    var id_url='?r=diff/resultanalysis&runid='+run_id_num;
	}*/
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


