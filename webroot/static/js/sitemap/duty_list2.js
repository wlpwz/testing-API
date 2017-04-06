(function(){
	var StatTypeList = function(){
		this._init();
	}
	
	StatTypeList.prototype._init = function(){
    this.add();
	}
	
	StatTypeList.prototype.add = function(){
		var _this = this;
		$('.add').bind('click', function(){
			var url = "?r=statitem/getitem";
			$.ajax({
				type: "POST",
				url: url,
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
			html += '<div class="title"><span class="title-desc">值周编辑</span><a class="dialogue-cls"></a></div>';
			html += '<div class="detail" id="dial-box-detail">';
			html += '<form class="form-horizontal">';
			html += '<div style="display:none;" id="type_id"></div>';
			html += '<div class="control-group">';
			html += '<label class="control-label">时间</label>';
			html += '<div class="controls"><input id="type_time" class="span2 inline" size="50" type="text"" />';
			html += '</div></div>';
			html += '<div class="control-group">';
			html += '<label class="control-label">姓名</label>';
			html += '<div class="controls"><input id="type_name" class="span2 inline" name="name" size="50" maxlength="100" type="text" placeholder="" required>';
			html += '</div>';
			html += '</div>';
			html += '<div class="control-group">';
			html += '<label class="control-label">Hi</label>';
			html += '<div class="controls"><input id="type_hi" class="span2 inline" name="hi" size="50" maxlength="100" type="text" placeholder="" required>';
			html += '</div>';
			html += '</div>';
      html += '<div class="control-group">';
      html += '<label class="control-label">邮箱</label>';
      html += '<div class="controls"><input id="type_email" class="span2 inline" name="email" size="50" maxlength="100" type="text" placeholder="" required>';
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
			$('#type_time').val(obj.create_time);
			$('#type_name').val(obj.name);
			$('#type_hi').val(obj.hi);
      $('#type_email').val(obj.email);
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
			var create_time = $('#type_time').val();
			var name = $('#type_name').val();
			var hi = $('#type_hi').val();
            var email = $('#type_email').val();
			var url = '?r=statitem/additem';
			var param = {id:id,create_time:create_time,name:name,hi:hi,email:email};
			
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
	
	new StatTypeList();

})();
