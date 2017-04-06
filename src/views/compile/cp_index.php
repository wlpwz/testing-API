<?php
        $r['topic'] = "compile";
        $this->beginContent('/layouts/main',array('topic'=>$r));
?>
<div class="container">
<br/>
<ul class="nav nav-pills">
  <li class="active"><a href="#">任务提交</a></li>
  <li><a href="?r=compile/log">日志输出</a></li>
  <li><a href="#">结果分析</a></li>
</ul>

<form id='form'>
  <div>

    <div class="page-header">
    <h3>新旧EC选择</h3>
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
        <br/>


        <h3>依赖变化配置</h3>
        <div id="basicparameter">
        <table width="100%">
            <div id="dform">
            </div>
            <tr>
              <td align="center">
                   <div class="btn-group">
                      <button  class="btn btn-default" type='button' id='addlib'>新增依赖</button>
                   </div>
              </td>
            </tr>
        </table>
        </div>
        
    <hr/>


    <br/>
    <br/>
      <table width="100%">
        <tr>
          <td align="center">
              <div class='btn-group'>
                <button class='btn btn-default' id="subtn"  style="height:32px;width:200px" type=submit onclick="Submit_Form(0)">提 交 一 下</button>
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
//var list = "<?php echo $version_list; ?>" ;
//alert(list);


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


function Submit_Form(flag) {
	
	var fd = new FormData();
	fd.append("bbbb","15");

	var xhr = new XMLHttpRequest(); 
	xhr.addEventListener("load", markComplete,false);
    xhr.open("POST", "?r=compile/test2");
	xhr.send(fd);
	alert("Transmit OK!");	
}

function markComplete(evt)
{
    var id_num=evt.target.responseText;
	alert("Mission id:"+id_num);
	id_url='?r=compile/test3&id='+id_num;
	//window.open(id_url,"newwindow");
	window.location.href=id_url;
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
