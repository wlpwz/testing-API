(function(){
	var StatTypeList = function(){
		this._init();
	}
	
	StatTypeList.prototype._init = function(){
		this.editor();
		this.search();
	}
	
	StatTypeList.prototype.editor = function(){
		var _this = this;
		$('.editor').bind('click', function(){
			var id= $(this).attr('item_id');
			var url = "?r=c2c/getitem";
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
			html += '<div class="title"><span class="title-desc">监控项编辑</span><a class="dialogue-cls"></a></div>';
			html += '<div class="detail" id="dial-box-detail">';
			html += '<form class="form-horizontal">';
			html += '<div style="display:none;" id="type_id">' + obj.id + '</div>';
			html += '<div class="control-group">';
			html += '<label class="control-label">监控项名称</label>';
			html += '<div class="controls"><input id="type_name" class="span2 inline" size="50" type="text" value="' + obj.name+ '" />';
			html += '</div></div>';
			html += '<div class="control-group">';
			html += '<label class="control-label">数据文件</label>';
			html += '<div class="controls"><input id="type_file" class="span2 inline" name="file" size="50" maxlength="100" type="text" placeholder="" value="' + obj.file + '" required>';
			html += '</div>';
			html += '</div>';
			html += '<div class="control-group">';
			html += '<label class="control-label">扫描周期</label>';
			html += '<div class="controls"><input id="type_period" class="span2 inline" name="period" size="50" maxlength="100" type="text" placeholder="" value="' + obj.period + '" required>';
			html += '</div>';
			html += '</div>';
      html += '<div class="control-group">';
      html += '<label class="control-label">报警阀值</label>';
      html += '<div class="controls"><input id="type_warning" class="span2 inline" name="warning" size="50" maxlength="100" type="text" placeholder="" value="' + obj.warning + '" required>';
      html += '</div>';
      html += '</div>';
			html += '<div class="control-group">';
			html += '<label class="control-label">用户名称</label>';
			html += '<div class="controls"><input id="type_user" class="span2 inline" name="user" size="50" maxlength="100" type="text" placeholder="" value="' + obj.user + '" required>';
			html += '</div>';
			html += '</div>';
			html += '<div class="control-group">';
			html += '<label class="control-label">action</label>';
			html += '<div class="controls"><input id="type_action" class="span2 inline" name="action" size="50" maxlength="100" type="text" placeholder="" value="' + obj.action + '" required>';
			html += '</div>';
			html += '</div>';
			html += '<div class="control-group">';
			html += '<div class="control-group">';
			html += '<label class="control-label" for="note">描述</label>';
			html += '<div class="controls"><textarea id="type_desc" name="desc" rows="5" size="1022" style="width:300px;resize: none;">';
			html += obj.desc;
			html += '</textarea>';
			html += '</div>';
			html += '</div>';
			html += '<div class="control-group">';
			html += '<div class="controls">';
			html += '<button class="btn btn-mini btn-primary reset_btn" id="save_btn" type="button">保存</button>';
			html += '<button class="btn btn-mini reset_btn_gray" type="button" id="cancel">取消</button>';
			html += '</div>';
			html += '</div>'; 
			html += '</form>';
			html +='</div>';
			pane.innerHTML = html;
			document.body.appendChild(pane);
			this._initDialog();
			this.saveChange();
		} else {
			$('#type_id').html(obj.id);
			$('#type_name').val(obj.name);
			$('#type_file').val(obj.file);
			$('#type_period').val(obj.period);
      $('#type_warning').val(obj.warning);
			$('#type_user').val(obj.user);
			$('#type_action').val(obj.action);
			$('#type_desc').val(obj.desc);
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
			var id = $('#type_id').html();
			var name = $('#type_name').val();
			var file = $('#type_file').val();
			var period = $('#type_period').val();
      var warning = $('#type_warning').val();
			var user = $('#type_user').val();
			var action = $('#type_action').val();
			var desc = $('#type_desc').val();
			var url = '?r=c2c/saveitem';
			var param = {id:id,name:name,file:file,period:period,warning:warning,user:user,action:action,desc:desc};
			
			$.ajax({
				type: "POST",
				url: url,
				data: param,
				success: function(ajaxObj){
					var obj = $.parseJSON(ajaxObj);
					if(obj.status==1){
						alert('保存成功！');
					}else{
						alert('保存失败，请稍候重试！');
					}
					window.location.reload();
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					alert("请联系QA反馈您的问题！");
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
		$('.dialogue').css('height', '460px');
	}
	
	StatTypeList.prototype._initBCanvas = function(){
		var width = $(window).width();
		var height = $(document).height(); 
		$('.b-canvas').css('width', width + 'px');
		$('.b-canvas').css('height', height + 'px');
		$('.b-canvas').css('left', 0);
		$('.b-canvas').css('top', 0);
	}
	
	
	StatTypeList.prototype.search = function(){
		$('#search_btn').bind('click', function(){
			window.location.href = "?r=c2c/search&keyword=" + $('#keyword').val();	
		});
	}
	
	new StatTypeList();

})();
