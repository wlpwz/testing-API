{%$this->beginContent('/layouts/column1', ['topic'=>$topic])%}    
<div class="page-title"><i class="i_icon"></i> 项目信息 </div>
    <div class="pd10 left">
      <div class="panel ">
        <div class="panel-main panel-gray">
          <div class="form pd10">
            <form id="form_info">
                <input type="hidden" name="act" value="edit"/>
                <p style="display:none;" id="prj_id">{%$id%}</p>
                <input type="hidden" name="topic_id" value="{%$topic%}">
            <table border="0" cellspacing="0" cellpadding="0" width="100%">
              <tr>
            <td align="right">优先级：</td>
                <td align="left">
                    <select name="priority" id="select"  class="select width-sm2" >
                        {%if $project->priority%}{%$prjPriority=$project->priority%}{%else%}{%$prjPriority=3%}{%/if%}
                        {%html_options options=$priority_list selected=$prjPriority%}
                    </select>
                </td>
              </tr>
              <tr>
                <td align="right">项目分级：</td>
                <td align="left"><select name="level" class="select width-sm2" >
                        {%if $project->level%}{%$prjLevel=$project->level%}{%else%}{%$prjLevel=3%}{%/if%}
                        {%html_options options=$level_list selected=$prjLevel%}  
                </select></td>
              </tr>
              <tr>
                <td align="right">icafe项目：</td>
                <td align="left"><input type="text" name="icafe" value="{%$project->icafe|escape:html%}" class="input width-md2" width="200" maxlength="1024" placeholder="wdm-177-ccode中文query识别准确优化"/>
              </tr>
              <tr>
                <td align="right"><p>模块：</p></td>
                <td align="left"><input type="text" name="module" value="{%$project->module|escape:html%}"  class="input width-md2" maxlength="256" placeholder="ccode" />
              </tr>
              <tr>
                <td align="right"><p>版本：</p></td>
                <td align="left"><input type="text" name="version" value="{%$project->version|escape:html%}"  class="input width-md2" maxlength="256" placeholder="3.5.41.0" />
              </tr>
              <tr>    
                <td align="right"><p>代码规模：</p></td>
                <td align="left"><input type="text" name="codelines" value="{%$project->codelines|escape:html%}"  class="input" placeholder="500"/>
              </tr>   
              <tr>        
                <td align="right"><p>RD负责人：</p></td>
                <td align="left"><input type="text" name="rd" value="{%if $project->rd%}{%$project->rd|escape:html%}{%else%}{%Yii::app()->user->name%}{%/if%}" class="input" placeholder="xiaodu01,xiaodu02"/></td>
              </tr>               
              <tr>
                <td align="right"><p>预期提测时间：</p></td>
                <td align="left">
                       <input size="8" type="text" class="form_datetime" name="lift_date" value="{%$project->lift_date%}">
                </td>
              </tr>
              <tr>
                <td align="right"><p>预期上线时间：</p></td>
                <td align="left">
                       <input size="8" type="text" class="form_datetime" name="online_date" value="{%$project->online_date%}">
                </td> 
              </tr>
              <tr>
                <td width="20%" align="right">升级内容：</td>
                <td width="80%"  align="left">
                    <input type="text" name="content" value="{%$project->content|escape:html%}" class="input width-md2" placeholder="策略特征服务化" maxlength="256" />
                </td>
              </tr>
              <tr>    
                <td align="right">预期线上影响：</td>
                <td align="left"><textarea type="text" name="influence" id="textfield2" class="input" width="200"/>{%$project->influence|escape:html%}</textarea>
              </tr>  
              <tr>
                <td align="right">&nbsp;</td>
                <td align="left"><a class="btn btn-primary btn-large submit">提交</a> <a class="btn  btn-large" href="?r=site/index&topic={%$topic%}">取消</a></td>
              </tr>
            </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<link rel="stylesheet" href="static/css/jquery-ui.css" type="text/css" charset="utf-8"/>  
<script language="javascript" src="static/js/jquery-ui.js"></script> 
<script>
    (function(){
        var topic = {%$topic%};
        $(".form_datetime").datepicker({ dateFormat: "yy-mm-dd", minDate: -20, maxDate: "+1M +10D" });
        $(".submit").bind("click", function(){
            var data = $("#form_info").serialize();
            var url = "?r=site/edit&topic=" + topic;
            var id = $("#prj_id").html();
            if(id){
                url += "&id=" + id;
            }

            $.post(url, data, function(ajaxObj){
                var obj = $.parseJSON(ajaxObj);

                if(obj.status == 1){
                    alert("提交成功！");
                    window.location.href = "?r=site/index&topic=" + topic;
                }else if(obj.status == -1){
                    alert("邮件发送失败！");
                }else{
                    alert("提交失败，请稍后重试！");
                }
            });
        
        });       
 
    })();
</script>
{%$this->endContent()%}
