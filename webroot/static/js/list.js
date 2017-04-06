(function(){
	
	var List = function(){
        var _this = this;
            _this.search();
            _this.slidePage();
            _this.popDailogue();
            _this.delProject();
	}

    List.prototype.search = function(){
         $(".search").bind("click", function(){
            var state = $("select[name='state']").val();
            var keyword = $("input[name='keyword']").val();
            var topic = $("select[name='topic']").val();

            window.location.href = "?r=site/index&state=" + state + "&keyword=" + keyword + "&topic=" + topic;
        });
    }

    List.prototype.delProject = function(){
       $(".del_item").bind("click", function(){
            var data = {id: $(this).attr("pid")};
            var url = "?r=site/del";

            if(confirm("删除后无法恢复，请确认是否继续？")){
                $.post(url, data, function(ajaxObj){
                    var obj = $.parseJSON(ajaxObj);
            
                    if(obj.status == 1){
                        alert("删除成功！");
                    }else{
                        alert("删除失败，请稍候重试！");
                    }
                    window.location.reload();
                });
            }
        });
    }

    List.prototype.popDailogue = function(){
        var _this = this;
         //弹窗  
        $(".man_item").bind("click", function(){
            var id = $(this).attr("pid"); 
            var name = $(this).attr("name");
            var cnf = {title: "测试项目管理"}; 
            var poplayer = new window.poplayer(cnf);        
            var tdObj = $(this).parent().parent().find("td");
            var topic = $(this).attr("topic");     
            var qa_reviewer = $(tdObj).eq(4).html();
            var qa_master = $(tdObj).eq(5).html();
            var qa_time = $(tdObj).eq(10).html();
            var act_lift_time = $(tdObj).eq(7).attr("act_lift_time");
            var influence = $(this).attr("influence");
            var report_time = $(this).attr("report_time");
            var state = $(tdObj).eq(9).attr("state");
            var info = {id: id, name: name, topic: topic, act_lift_time: act_lift_time,
                        qa_reviewer: qa_reviewer, qa_master: qa_master, report_time: report_time,
                        qa_time:qa_time, influence: influence, state: state};
            poplayer.renderPopLayer(_this.getManageContent(info));

            _this.bindSaveBtn(poplayer.getSaveBtn());
        });
        //$(".form_datetime").datepicker({ dateFormat: "yy-mm-dd", minDate: -20, maxDate: "+1M +10D" });
    }

    List.prototype.bindSaveBtn = function(btn){
        btn.bind('click', function(){
            var url = "?r=site/manage";
            var sendData = $("#man_form").serialize();
           
            $.post(url, sendData, function(ajaxObj){
                var obj = $.parseJSON(ajaxObj);
                if(obj.status==1){
                    alert('保存成功！');
                }else{
                    alert('保存失败，请稍候重试!');
                }
                window.location.reload();
            }); 
        });
    }


    List.prototype.slidePage = function(){
         //分页
        var url =  "?r=site/index";
            url += "&state=" + $("select[name='state']").val();
            url += "&keyword=" + $("input[name='keyword']").val();
            url += "&topic=" + $("select[name='topic']").val();
        var config = {count: $("#count").html(), page: $("#pagenum").html(), pagesize: $("#pagesize").html(), url: url};
        new window.page(config);

    }

    List.prototype.getManageContent = function(info){
        var _this = this;
        var html = '<div class="form pd10"><form id="man_form">';
            html += '<input type="hidden" name="id" value="' + info.id + '"/>';
            html += '<table border="0" cellspacing="0" cellpadding="0" width="100%">';
            html += '<tr><td align="right">业务：</td>'; 
            html += '<td align="left"><select name="topic" class="select" >';
            html += _this.getOptions("topicListJson", info.topic);
            html += '</select></td></tr>'; 
            html += '<tr><td width="30%" align="right">项目名称：</td>'; 
            html += '<td width="70%"  align="left">' + info.name + '</td></tr>';
            html += '<tr><td align="right">预期线上影响：</td>'; 
            html += '<td align="left">' + _this.subString(info.influence) + '</td></tr>';
            html += '<tr><td align="right">项目状态：</td>'; 
            html += '<td align="left"><select name="state" class="select" >';
            html += _this.getOptions("statListJson", info.state);
            html += '</select></td></tr>';
            html += '<tr><td align="right"><p>QA负责人：</p></td>';
            html += '<td align="left"><input type="text" name="qa_master" value="' + info.qa_master +'" class="input" placeholder="xiaodu01,xiaodu02"/></td></tr>';
            html += '<tr><td align="right"><p>QA评审人：</p></td>';
            html += '<td align="left"><input type="text" name="qa_reviewer" value="' + info.qa_reviewer + '" class="input" placeholder="xiaodu01,xiaodu02"/></td></tr>';
            html += '<tr><td align="right"><p>实际提测时间：</p></td>';
            html += '<td align="left"><input size="8" type="text" class="form_datetime" name="act_lift_time" value="'+ info.act_lift_time +'"></td></tr>';
            html += '<tr><td align="right"><p>发测试报告时间：</p></td>';
            html += '<td align="left"><input size="8" type="text" class="form_datetime" name="report_time" value="' + info.report_time +'"></tr>'; 
            html += '</table></form></div>'; 
        
            return html;
    }
  

    List.prototype.getOptions = function(id, select){
        var op = '';
        var obj = $.parseJSON($("#"+id).html());
    
        for(var i in obj){
            if(i == select){
                op += '<option value="' + i + '" selected>' + obj[i] + '</option>';
            }else{
                op += '<option value="' + i + '">' + obj[i] + '</option>';
            }
        }
        return op;
    }

    List.prototype.subString = function(str){
        var sub = str;
        if(sub.length>50){
            sub = str.substr(0,50) + '...';
        }
        return sub;
    }

    new List();
})();
