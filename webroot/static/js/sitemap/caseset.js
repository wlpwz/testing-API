(function(){
	var StatTypeList = function(){
		this._init();
	}
	
	StatTypeList.prototype._init = function(){
		this.editor();
		this.search();
        this.remove();
	}
    StatTypeList.prototype.remove = function() {
        var _this = this;
        $('.remove').bind('click', function() {
            if (confirm("您确定要删除吗？")) {
                var id = $(this).attr('item_id');
                var url = "?r=requirement/removecaseset";
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
			var url = "?r=requirement/getcasesetitem";
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
			html += '<div class="title"><span class="title-desc">监控项需求编辑</span><a class="dialogue-cls"></a></div>';
			html += '<div class="detail" id="dial-box-detail">';
			html += '<form class="form-horizontal">';
			html += '<div style="display:none;" id="id">' + obj.id + '</div>';
			
            html += '<div class="control-group"><label class="control-label">case名称</label><div class="controls">';
			html += '<input name="case_name" id="case_name"  type="text" class="span2 inline" style="width:300px" value="'+ obj.case_name +'" maxlength="30" required/>';
			html += '</div></div>';
			
            html += '<div class="control-group"><label class="control-label">case描述</label><div class="controls">';
			html += '<textarea name="descript" id="descript" class="span2 inline" rows="5" style="width:300px" value="" placeholder="http://icafe.url">'+ obj.descript +'</textarea>';
			html += '</div></div>';
			
            html += '<div class="control-group"><label class="control-label">环路</label><div class="controls">';
            html += '<input name="circle" id="circle" type="text" class="span2 inline" style="width:300px" value="' + obj.circle + '" maxlength="30" required/>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">产品线</label><div class="controls">';
            html += '<select class="span2 mr10" name="product" id="product"><option value="badshare">badshare</option><option value="sitemap">sitemap</option><option value="sitemap_tool">sitemap_tool</option><option value="cse">cse</option></select>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">case级别</label><div class="controls">';
            html += '<input name="level" id="level" type="text" class="span2 inline" style="width:200px" value="' + obj.level +'" maxlength="30"/>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">报警配置</label><div class="controls">';
            html += '<input name="warnconfig_id" id="warnconfig_id" type="text" class="span2 inline" style="width:200px" value="' + obj.warnconfig_id +'" maxlength="30"/>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">crontab配置</label><div class="controls">';
            html += '<input name="crontab_conf" id="crontab_conf" type="text" class="span2 inline" style="width:200px" value="' + obj.crontab_conf +'" maxlength="30"/>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">当前状态</label><div class="controls">';
            html += '<select class="span2 mr10" name="status" id="status" disabled="disabled"><option value="normal">normal</option><option value="risk">risk</option><option value="danger">danger</option></select>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">对应模块</label><div class="controls">';
            html += '<input name="module" id="module" type="text" class="span2 inline" style="width:200px" value="' + obj.module +'" maxlength="30"/>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">对应机器</label><div class="controls">';
            html += '<input name="machine" id="machine" type="text" class="span2 inline" style="width:200px" value="' + obj.machine +'" maxlength="30"/>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">展现URL</label><div class="controls">';
            html += '<input name="url" id="url" type="text" class="span2 inline" style="width:400px" value="' + obj.url +'" maxlength="256"/>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">检查周期</label><div class="controls">';
            html += '<select class="span2 mr10" name="time_level" id="time_level"><option value="5min">5min</option><option value="1hour">1hour</option><option value="1day">1day</option><option value="1week">1week</option><option value="1month">1month</option><option value="1year">1year</option></select>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">创建时间</label><div class="controls">';
            html += '<input name="create_time" id="create_time" type="text" class="span2 inline" style="width:200px" value="' + obj.create_time +'" maxlength="30" disabled="disabled"/>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">数据源选取条件</label><div class="controls">';
            html += '<textarea name="data_source" id="data_source" class="span2 inline" rows="5" style="width:300px" value="">'+ obj.data_source +'</textarea>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">状态判断条件</label><div class="controls">';
            html += '<textarea name="status_condition" id="status_condition" class="span2 inline" rows="5" style="width:300px" value="">'+ obj.status_condition +'</textarea>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">报警条件</label><div class="controls">';
            html += '<input name="warn_condition" id="warn_condition" type="text" class="span2 inline" style="width:200px" value="' + obj.warn_condition +'" maxlength="30"/>';
            html += '</div></div>';
           
            html += '<div class="control-group"><label class="control-label">上次检查时间</label><div class="controls">';
            html += '<input name="last_check_time" id="last_check_time" type="text" class="span2 inline" style="width:200px" value="' + obj.last_check_time +'" maxlength="30" disabled="disabled"/>';
            html += '</div></div>';

            html += '<div class="control-group"><label class="control-label">环境</label><div class="controls">';
            html += '<select class="span2 mr10" name="env" id="env"><option value="online">online</option><option value="sandbox">sandbox</option></select>';
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
            $('#product').val(obj.product);
            $('#status').val(obj.status);
            $('#time_level').val(obj.time_level);
            $('#env').val(obj.env);
		} else {
			$('#id').html(obj.id);
			$('#case_name').val(obj.case_name);
            $('#descript').val(obj.descript);
			$('#circle').val(obj.circle);
			$('#product').val(obj.product);
			$('#level').val(obj.level);
			$('#warnconfig_id').val(obj.warnconfig_id);
            $('#crontab_conf').val(obj.crontab_conf);
            $('#status').val(obj.status);
            $('#module').val(obj.module);
            $('#machine').val(obj.machine);
            $('#url').val(obj.url);
            $('#time_level').val(obj.time_level);
            $('#create_time').val(obj.create_time);
            $('#data_source').val(obj.data_source);
            $('#status_condition').val(obj.status_condition);
            $('#warn_condition').val(obj.warn_condition);
			$('#last_check_time').val(obj.last_check_time);
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
			var case_name = $('#case_name').val();
            var descript = $('#descript').val();
			var product = $('#product').val();
			var circle = $('#circle').val();
            var level = $('#level').val();
            var warnconfig_id = $('#warnconfig_id').val();
            var crontab_conf = $('#crontab_conf').val();
            var module = $('#module').val();
            var machine = $('#machine').val();
            var time_level = $('#time_level').val();
            var data_source = $('#data_source').val();
            var status_condition = $('#status_condition').val();
            var warn_condition = $('#warn_condition').val();
            var env = $('#env').val();
            var url = $('#url').val();
			var saveurl = '?r=requirement/savecasesetitem';
            var param = {id:id,case_name:case_name,descript:descript,product:product,circle:circle,level:level,warnconfig_id:warnconfig_id,crontab_conf:crontab_conf,module:module,machine:machine,time_level:time_level,data_source:data_source,status_condition:status_condition,warn_condition:warn_condition,url:url,env:env};
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
