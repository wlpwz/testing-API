(function(){
	var AlarmManage = function() {
		this._init();
	}

	AlarmManage.prototype._init = function() {
		this.change();
	}

	AlarmManage.prototype.change = function() {
		/*	
		*考虑几种情况：
		*1.当前按钮是消息按钮，消息按钮是OFF，邮件按钮也是OFF，提示不能这么处理。
		*2.当前按钮是邮件按钮，消息按钮是ON，邮件按钮是ON，提示不能这么处理。
		*/
	    $('.has-switch').bind('switch-change',function(e,data){
            var id = $(this).attr("id");
            var splid = id.split("_");
            var another;
            if ( splid[0] == 'msg' )
                another = "email_alarm_"+splid[2];
            else
                another = "msg_alarm_"+splid[2];
            var value_one = data.value;
            var value_two = $($('#'+another).children().children()[0]).attr("checked"); 
            var url = "?r=requirement/alarmdeal";
            var msg_op,email_op;
            if ( splid[0] == 'msg')
            {
                msg_op = value_one?1:0;
                email_op = value_two?1:0;
            }
            else
            {
                msg_op = value_two?1:0;
                email_op = value_one?1:0;
            }
            if (msg_op==1 && email_op==0)
            {
                if (splid[0] == "msg")
                {
                    alert("亲~ 不能只开短信通知不开邮件~ 为了安全我们还是把短信通知关了吧~");
                    msg_op = 0;
                }
                else
                {
                    alert("亲~ 不能只开短信通知不开邮件~ 为了安全我们还是把邮件通知开了吧~");
                    email_op = 1;
                }
            }
            var param = {id:splid[2],msg_op:msg_op,email_op:email_op};
            /*console.log(param);*/
            $.ajax({
                type: "POST",
                url:  url,
                data: param,
                success: function(ajaxObj) { 
                    var obj = $.parseJSON(ajaxObj);
                    if (obj.status == 0)
                        ;
                    else if (obj.status == 1)
                        alert("短信通知修改成功");
                    else if (obj.status == 2)
                        alert("邮件通知修改成功");
                    else if (obj.status == 3)
                        ;
                    else if (obj.status == 4)
                        alert("报警脚本参数传递错误，请联系曹雪卉caoxuehui@baidu.com、汤素文tangsuwen@baidu.com");
                    else
                        alert("未知错误，联系曹雪卉caoxuehui@baidu.com、汤素文tangsuwen@baidu.com");
                    window.location.reload();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("请联系雪卉反馈您的问题！");
                }
            });
        });
    }
	new AlarmManage();
})();
