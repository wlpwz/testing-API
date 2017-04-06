<?php
        $r['topic'] = "diff";
        $this->beginContent('/layouts/main',array('topic'=>$r));
?>
<script type="text/javascript" charset="utf8" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="static/js/ZeroClipboard/ZeroClipboard.js"></script>
<div class="container">

<div class="row" data-spy="scroll" data-target="#myScrollspy">
<div style="margin-top:20px;margin-left:-50px">
<div class="col-md-2" id="myScrollspy">
	<div class="list-group">
		<B class="list-group-item " style="background-color:#F5F5F5">结果分析</B>
		<a href="#summery" class="list-group-item active">Diff结果概况</a>
		<a href="#additem" class="list-group-item ">新增字段结果</a>
		<a href="#deleteitem" class="list-group-item ">缺失字段结果</a>
		<a href="#diffitem" class="list-group-item">Diff字段结果</a>
	</div>
</div>
<div class="col-md-10">
<!--<table width="100%">
<tr>
<td width="50%">
<ul class="nav nav-pills">
  <li><a href="?r=diff/index">EC产出地址提交</a></li>
  <li class="active"><a href="#">结果分析</a></li>
</ul>
</td>        
<td width="50%" align="right">
</td>
</tr>           
</table>   -->

<div class="head_line">
	<ul class="breadcrumb">
		<li><a href="index.php?r=ecTask/diffmission">结果分析任务列表</a></li>
		<li>结果分析详情</li> 
		<li class="active"><?php echo $diff_id1;?>号任务结果</li> 
	</ul>   
</div> 
<form id='form1' <?php
		if($diff_num>=1)
			echo "style=\"display:block\"";
		else
			echo "style=\"display:none\"";
?>>
    <div>
            <div class="panel panel-primary" id="summery">
            <div class="panel-heading">结果分析</div>
            <table class="table table-bordered table-striped" style="text-align:left;font-size:15px;">
                <thead>
                    <tr>
                        <td width="12.5%"><div align="left"><b>处理时间</b></div></td>
                        <td width="12.5%"><div align="left"><b>相同pack</b></div></td>
                        <td width="12.5%"><div align="left"><b>不同pack</b></div></td>
                        <td width="12.5%"><div align="left"><b>新pack</b></div></td>
                        <td width="12.5%"><div align="left"><b>旧pack</b></div></td>
                        <td width="12.5%"><div align="left"><b>New Item</b></div></td>
                        <td width="12.5%"><div align="left"><b>Miss Item</b></div></td>
                        <td width="12.5%"><div align="left"><b>Diff Item</b></div></td>
                    </tr>
                </thead>
                <tbody id="resultsummary1">
                	<tr>
						<th colspan="8">
							<div align="center">Loading...</div> 
						</th>
					</tr>
				</tbody>
            </table>
            </div>
			<div class="panel panel-info" id="additem">	
    		<div class="panel-heading">新增项</div>
            <table class="table table-bordered table-striped">
				<thead>
						<td width=15%>字段名</td>
						<td width=10%>数量</td>
						<td width=10%>比例</td>
						<td width=25%>地址</td>
						<td width=10%>详情</td>
				</thead>
				<tbody id="newitem1">
				</tbody>
			</table> 
			</div>
			<div class="panel panel-success" id="deleteitem">	
    		<div class="panel-heading">丢失项</div>
            <table class="table table-bordered table-striped" width="100%">
				<thead>
					<tr>
						<td width="24%"><div align="left"><b>字段名</b></div></td>
						<td width="8%"><div align="left"><b>数量</b></div></td>
						<td width="8%"><div align="left"><b>比例</b></div></td>
						<td width="54%"><div align="left"><b>地址</b></div></td>
						<td width="6%"><div align="left"><b>详情</b></div></td>
					</tr>
				</thead>
				<tbody id="missitem1">
				</tbody>
			</table> 
			</div>
			<div class="panel panel-warning" id="diffitem">	
    		<div class="panel-heading">不同项</div>
            <table class="table table-bordered table-striped" width="100%">
				<thead>
					<tr>
						<td width="24%"><div align="left"><b>字段名</b></div></td>
						<td width="8%"><div align="left"><b>数量</b></div></td>
						<td width="8%"><div align="left"><b>比例</b></div></td>
						<td width="54%"><div align="left"><b>地址</b></div></td>
						<td width="6%"><div align="left"><b>详情</b></div></td>
					</tr>
				</thead>
				<tbody id="diffitem1">
				</tbody>
			</table> 
			</div>
</form>

    <hr/>


<form id='form2' <?php
		if($diff_num==2)
			echo "style=\"display:block\"";
		else
			echo "style=\"display:none\"";
?>>
        <br/>
        <br/>
        <br/>
        <br/>
    <div class="page-header">
    <h3 style="font-family:'微软雅黑'"><b><?php 
		if($diff_id2!="null")
		echo "任务".$diff_id2; ?>结果分析</b></h3>
    </div>
    <div>
            <div class="panel panel-primary" id="summery">
            <div class="panel-heading">结果分析</div>
            <table class="panel-body table">
                <thead>
                    <tr>
                        <td width="12.5%"><div align="left"><b>处理时间</b></div></td>
                        <td width="12.5%"><div align="left"><b>相同pack</b></div></td>
                        <td width="12.5%"><div align="left"><b>不同pack</b></div></td>
                        <td width="12.5%"><div align="left"><b>新pack</b></div></td>
                        <td width="12.5%"><div align="left"><b>旧pack</b></div></td>
                        <td width="12.5%"><div align="left"><b>New Item</b></div></td>
                        <td width="12.5%"><div align="left"><b>Miss Item</b></div></td>
                        <td width="12.5%"><div align="left"><b>Diff Item</b></div></td>
                    </tr>
                </thead>
                <tbody id="resultsummary2">
                	<tr>
						<th colspan="8">
							<div align="center">Loading...</div> 
						</th>
					</tr>
				</tbody>
            </table>
            </div>
			<td>
			<div class="panel panel-info" id="additem">	
    		<div class="panel-heading">新增项</div>
            <table class="table table-bordered table-striped" width="100%">
				<thead>
					<tr>
						<td ><div align="left"><b>字段名</b></div></td>
						<td ><div align="left"><b>数量</b></div></td>
						<td ><div align="left"><b>比例</b></div></td>
						<td ><div align="left"><b>地址</b></div></td>
						<td ><div align="left"><b>详情</b></div></td>
					</tr>
				</thead>
				<tbody id="newitem2">
				</tbody>
			</table> 
			</div>
			<div class="panel panel-success" id="deleteitem">	
    		<div class="panel-heading">丢失项</div>
            <table class="panel-body table" width="100%">
				<thead>
					<tr>
						<td width="24%"><div align="left"><b>字段名</b></div></td>
						<td width="8%"><div align="left"><b>数量</b></div></td>
						<td width="8%"><div align="left"><b>比例</b></div></td>
						<td width="54%"><div align="left"><b>地址</b></div></td>
						<td width="6%"><div align="left"><b>详情</b></div></td>
					</tr>
				</thead>
				<tbody id="missitem2">
				</tbody>
			</table> 
			</div>
			<div class="panel panel-warning" id="diffitem">	
    		<div class="panel-heading">不同项</div>
            <table class="panel-body table" width="100%">
				<thead>
					<tr>
						<td width="24%"><div align="left"><b>字段名</b></div></td>
						<td width="8%"><div align="left"><b>数量</b></div></td>
						<td width="8%"><div align="left"><b>比例</b></div></td>
						<td width="54%"><div align="left"><b>地址</b></div></td>
						<td width="6%"><div align="left"><b>详情</b></div></td>
					</tr>
				</thead>
				<tbody id="diffitem2">
				</tbody>
			</table> 
			</div>
</form>


</div>
</div>
</div>
</div>
</div>
</div>
<script>

var tinterval;
window.onload=setloading;

function setloading(){
	<?php
	if($diff_num>=1)
	{
		echo "tinterval1=setInterval(\"Get_Result_Data(1)\",30000);";
    	echo "Get_Result_Data(1);";
	}
	if($diff_num==2)
	{
		echo "tinterval2=setInterval(\"Get_Result_Data(2)\",30000);";
    	echo "Get_Result_Data(2);";
	}
	
	?>
}; 


function Get_Result_Data(flag) {
        var fd = new FormData();
        <?php
            if($diff_num >= 1)
            {
                echo "if(flag==1){";
				echo "fd.append(\"Diff_id\",\"".$diff_id1."\");}\n";
            };
        ?>
        <?php
            if($diff_num ==2)
            {
                echo "if(flag==2){";
                echo "fd.append(\"Diff_id\",\"".$diff_id2."\");}\n";
            };
        ?>
        var xhr = new XMLHttpRequest(); 
        if(flag==1)
		{
			xhr.addEventListener("load",writeResult1,false);
        }
		if(flag==2)
		{
			xhr.addEventListener("load",writeResult2,false);
        }
		xhr.open("POST", "?r=diff/resultdata");
        //xhr.open("POST", "?r=compile/test");
        xhr.send(fd);
        //alert("Transmit OK!");    
}


function writeResult1(evt)
{
    var resultdata_original=evt.target.responseText;
    var resultdata=resultdata_original.split("<!-- -->");
  	for(var i=0; i<resultdata.length;i++)
	{
		if(resultdata[i].indexOf("<!-- Loading -->")>0)
		{
		
		}

		if(resultdata[i].indexOf("<!-- First Line -->")>0)
		{
			window.clearInterval(tinterval1);
			$('#resultsummary1').empty();
		    var p=$('#resultsummary1 p:last');
    		p=$(resultdata[i]).appendTo('#resultsummary1');
		}

		if(resultdata[i].indexOf("<!-- New_Items -->")>0)
		{
		    var p=$('#newitem1 p:last');
    		p=$(resultdata[i]).appendTo('#newitem1');
		}

		if(resultdata[i].indexOf("<!-- Miss_Items -->")>0)
		{
		    var p=$('#missitem1 p:last');
    		p=$(resultdata[i]).appendTo('#missitem1');
		}

		if(resultdata[i].indexOf("<!-- Diff_Items -->")>0)
		{
		    var p=$('#diffitem1 p:last');
    		p=$(resultdata[i]).appendTo('#diffitem1');
		}
	}
}


function writeResult2(evt)
{
    var resultdata_original=evt.target.responseText;
    var resultdata=resultdata_original.split("<!-- -->");
  	for(var i=0; i<resultdata.length;i++)
	{
		if(resultdata[i].indexOf("<!-- Loading -->")>0)
		{
		
		}

		if(resultdata[i].indexOf("<!-- First Line -->")>0)
		{
			window.clearInterval(tinterval2);
			$('#resultsummary2').empty();
		    var p=$('#resultsummary2 p:last');
    		p=$(resultdata[i]).appendTo('#resultsummary2');
		}

		if(resultdata[i].indexOf("<!-- New_Items -->")>0)
		{
		    var p=$('#newitem2 p:last');
    		p=$(resultdata[i]).appendTo('#newitem2');
		}

		if(resultdata[i].indexOf("<!-- Miss_Items -->")>0)
		{
		    var p=$('#missitem2 p:last');
    		p=$(resultdata[i]).appendTo('#missitem2');
		}

		if(resultdata[i].indexOf("<!-- Diff_Items -->")>0)
		{
		    var p=$('#diffitem2 p:last');
    		p=$(resultdata[i]).appendTo('#diffitem2');
		}
	}
}

    ZeroClipboard.setMoviePath("static/js/ZeroClipboard/ZeroClipboard.swf");
    function toClipboard(copy_id,input_id) {
        var clip = new ZeroClipboard.Client();
        clip.setHandCursor(true); 
        clip.setText(document.getElementById(input_id).value); 
        clip.addEventListener('complete', function (client) {
            alert("复制成功");   
        });  
        clip.glue(copy_id);  
    }
</script>

<?php $this->endContent(); ?>
