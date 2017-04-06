(function(){
	var StatTypeList = function(){
		this._init();
	}
	
	StatTypeList.prototype._init = function(){
		this.editor();
        this.remove();
	}
    StatTypeList.prototype.remove = function() {
        var _this = this;
        $('.remove').bind('click', function() {
            if (confirm("您确定要删除吗？")) {
                var id = $(this).attr('item_id');
                var url = "?r=requirement/removewarnconfigset";
                var param = {id:id};
                $.ajax({
                    type : "POST",
                    url  : url,
                    data : param,
                    async: false,
                    success : function(ajaxObj) {
                        var obj = $.parseJSON(ajaxObj);
                        if (obj.status == 0) {
                            window.location.reload();
                        }
                        else {
                            alert("删除失败！");
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown){
                        alert("发生错误，请联系QA反馈您的问题！");
                    },
                });
            }
        });
    }
	StatTypeList.prototype.editor = function(){
		var _this = this;
		$('.editor').bind('click', function(){
			var id= $(this).attr('item_id');
			var url = "?r=requirement/getwarnconfigsetitem";
			var param = {id:id};
			$.ajax({
				type: "POST",
				url: url,
				data: param,
				async: false,
				success: function(ajaxObj){
					var obj = $.parseJSON(ajaxObj);
					_this.renderDialBox(obj);
					_this.renderBCanvas();
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
				console.log(errorThrown);
					alert("请联系QA反馈您的问题！");
				}
			});
		});
	}

	StatTypeList.prototype.renderDialBox = function(obj){
		if($('.dialogue').length == 0) {
			var pane = document.createElement('div');
			pane.className = 'dialogue';
			pane.id='dial-box';
			var html = '';
			html += '<div class="title"><span class="title-desc">报警配置编辑</span><a class="dialogue-cls"></a></div>';
			html += '<div class="detail" id="dial-box-detail">';
			html += '<form class="form-horizontal">';
			html += '<div style="display:none;" id="id">' + obj.id + '</div>';
			
            html += '<div class="control-group"><label class="control-label">配置名称</label><div class="controls">';
			html += '<input name="monitor_case" id="monitor_case"  type="text" class="span2 inline" style="width:300px" value="'+ obj.monitor_case +'"  required/>';
			html += '</div></div>';
			
            html += '<div class="control-group"><label class="control-label">监控项描述</label><div class="controls">';
			html += '<textarea name="descript" id="descript" class="span2 inline" rows="5" style="width:300px" value="" placeholder="http://icafe.url">'+ obj.descript +'</textarea>';
			html += '</div></div>';
			
            html += '<div class="control-group"><label class="control-label">报警级别</label><div class="controls">';
            html += '<select class="span2 mr10" name="warn_level" id="warn_level"><option value="fatal">fatal</option><option value="warn">warn</option><option value="stat">stat</option></select>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">邮件报警接收人</label><div class="controls">';
            html += '<input name="msg_list" id="msg_list" type="text" class="span2 inline" style="width:200px" value="' + obj.msg_list +'"/>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">短信报警接收人</label><div class="controls">';
            html += '<input name="gmsg_list" id="gmsg_list" type="text" class="span2 inline" style="width:200px" value="' + obj.gmsg_list +'" />';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">报警汇总</label><div class="controls">';
            html += '<input name="warn_merge" id="warn_merge" type="text" class="span2 inline" style="width:200px" value="' + obj.warn_merge +'" maxlength="30"/>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">报警汇总退出</label><div class="controls">';
            html += '<input name="warn_merge_quit" id="warn_merge_quit" type="text" class="span2 inline" style="width:200px" value="' + obj.warn_merge_quit +'" maxlength="30"/>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">报警频率</label><div class="controls">';
            html += '<input name="warn_times" id="warn_times" type="text" class="span2 inline" style="width:200px" value="' + obj.warn_times +'" maxlength="30"/>';
            html += '</div></div>';
            
            html += '<div class="control-group"><label class="control-label">短信报警汇总</label><div class="controls">';
            html += '<input name="gwarn_merge" id="gwarn_merge" type="text" class="span2 inline" style="width:200px" value="' + obj.gwarn_merge +'" maxlength="30"/>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">短信报警汇总退出</label><div class="controls">';
            html += '<input name="gwarn_merge_quit" id="gwarn_merge_quit" type="text" class="span2 inline" style="width:200px" value="' + obj.gwarn_merge_quit +'" maxlength="30"/>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">短信报警频率</label><div class="controls">';
            html += '<input name="gwarn_times" id="gwarn_times" type="text" class="span2 inline" style="width:400px" value="' + obj.gwarn_times +'" maxlength="30"/>';
            html += '</div></div>';

            html += '<div class="control-group">';
            html += '<div class="controls">';
            html += '<button class="btn btn-mini btn-primary reset_btn" id="save_btn" type="button">保存</button>';
            html += '<button class="btn btn-mini reset_btn_gray" type="button" id="cancel">取消</button>';
            html += '</div></div>';

            html += '</form>';
			html +='</div>';
			pane.innerHTML = html;
			document.body.appendChild(pane);
			this._initDialog();
			this.saveChange();
            $('#warn_level').val(obj.warn_level);
		} else {
			$('#id').html(obj.id);
			$('#monitor_case').val(obj.monitor_case);
            $('#descript').val(obj.descript);
            $('#warn_level').val(obj.warn_level);
			$('#msg_list').val(obj.msg_list);
			$('#gmsg_list').val(obj.gmsg_list);
			$('#warn_merge').val(obj.warn_merge);
            $('#warn_merge_quit').val(obj.warn_merge_quit);
            $('#warn_times').val(obj.warn_times);
            $('#gwarn_merge').val(obj.gwarn_merge);
            $('#gwarn_merge_quit').val(obj.gwarn_merge_quit);
            $('#gwarn_times').val(obj.gwarn_times);
            $('.dialogue').show();
			$('.b-canvas').show();
		}
	}
	
	StatTypeList.prototype.renderBCanvas = function(){
		var _this = this;
		var pane = document.createElement('div');
		pane.className = 'b-canvas';
        pane.innerHTML = '';
		if($('.b-canvas').length == 0) {
			document.body.appendChild(pane);
			_this._initBCanvas();
		}
	}
	
	StatTypeList.prototype.saveChange = function(){
		$('#save_btn').bind('click', function(){
			var id = $('#id').html();
			var monitor_case = $('#monitor_case').val();
            var descript = $('#descript').val();
			var warn_level = $('#warn_level').val();
			var msg_list = $('#msg_list').val();
            var gmsg_list = $('#gmsg_list').val();
            var warn_merge = $('#warn_merge').val();
            var warn_merge_quit = $('#warn_merge_quit').val();
            var warn_times = $('#warn_times').val();
            var gwarn_merge = $('#gwarn_merge').val();
            var gwarn_merge_quit = $('#gwarn_merge_quit').val();
            var gwarn_times = $('#gwarn_times').val();
			var saveurl = '?r=requirement/savewarnconfigsetitem';
            var param = {id:id,monitor_case:monitor_case,descript:descript,warn_level:warn_level,msg_list:msg_list,gmsg_list:gmsg_list,warn_merge:warn_merge,warn_merge_quit:warn_merge_quit,warn_times:warn_times,gwarn_merge:gwarn_merge,gwarn_merge_quit:gwarn_merge_quit,gwarn_times:gwarn_times};
			$.ajax({
				type: "POST",
				url: saveurl,
				data: param,
				success: function(ajaxObj){
					var obj = $.parseJSON(ajaxObj);
					if(obj.status==1){
						alert('保存成功！');
					}else{
						alert('数据更新失败，请稍候重试！');
					}
					window.location.reload();
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					alert("发生错误，请联系QA反馈您的问题！");
				}
			});
		});
	}
	
	StatTypeList.prototype._initDialog = function() {
		var _this = this;
		this.setLocation();
		$(window).bind('resize', function(e){
			_this.setLocation();
			_this._initBCanvas();
		});
		$('#cancel').bind('click', function(){
			$('.dialogue').hide();
			$('.b-canvas').hide();
		});
		$('.dialogue-cls').bind('click', function(){
			$('.dialogue').hide();
			$('.b-canvas').hide();
		});
	}

	StatTypeList.prototype.setLocation = function() {
		var left = ($(window).width()-$('.dialogue').width())/2;
		var height = ($(window).height()-$('.dialogue').height())/2;
		$('.dialogue').css('left', left + 'px');
		$('.dialogue').css('top', height + 'px');
        $('.dialogue').css('height', '420px');
        $('.dialogue').css('width', '560px');
        $('.dialogue').css('overflow','scroll');
	}
	
	StatTypeList.prototype._initBCanvas = function(){
		var width = $(window).width();
		var height = $(document).height(); 
		$('.b-canvas').css('width', width + 'px');
		$('.b-canvas').css('height', height + 'px');
		$('.b-canvas').css('left', 0);
		$('.b-canvas').css('top', 0);
        $('.b-canvas').css('overflow','scroll');
	}
	
	
	StatTypeList.prototype.search = function(){
		$('#search_btn').bind('click', function(){
			window.location.href = "?r=requirement/search&keyword=" + $('#keyword').val();	
		});
	}
	
	new StatTypeList();

})();
