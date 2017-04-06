var ec_type="null";
function radiocheck(content)
{
	ec_type=content;
}

function Submit_Form(flag) {
	
	var m_description="none";
	var	newec_ver="none";
	var oldec_ver="none";
	var newec_input="none";
	var oldec_input="none";

	m_description = document.getElementById("mission_description").value;
	newec_ver = document.getElementById("new_ver").value;
	oldec_ver = document.getElementById("old_ver").value;
	newec_input= document.getElementById("new_ftp").value;
	oldec_input= document.getElementById("old_ftp").value;

	if(m_description=="")
	{
		alert("您没有填写任务描述!");
		return;	
	}
	if(newec_ver=="")
	{
		alert("您没有填写新EC版本!");
		return;	
	}
	if(oldec_ver=="")
	{
		alert("您没有填写旧EC版本!");
		return;	
	}
	if(newec_input=="")
	{
		alert("您没有填写新EC输出包的FTP地址!");
		return;	
	}
	if(oldec_input=="")
	{
		alert("您没有填写旧EC输出包的FTP地址!");
		return;
	}
	if(ec_type=="null")
	{
		alert("您没有选择EC类型!");
		return;
	}
	var fd = new FormData();
	fd.append("Mission_Description",m_description);
	fd.append("NewEC_Ver",newec_ver);
	fd.append("OldEC_Ver",oldec_ver);
	fd.append("NewEC_input",newec_input);
	fd.append("OldEC_input",oldec_input);
	fd.append("EC_Type",ec_type);
	var xhr = new XMLHttpRequest(); 
	xhr.addEventListener("load",markComplete,false);
    xhr.open("POST", "?r=diff/upload");
    //xhr.open("POST", "?r=diff/testtest");
	xhr.send(fd);
	alert("Transmit OK!");	
}

function markComplete(evt)
{
    //alert(evt.target.responseText);
    var id_num=evt.target.responseText;
    alert("Diff Mission id:"+id_num);
    //id_url='?r=diff/resultanalysis';
    id_url='?r=diff/resultanalysis&diffid='+id_num;
    window.location.href=id_url;
}



