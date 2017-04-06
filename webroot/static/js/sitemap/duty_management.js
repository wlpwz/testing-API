(function(){
	var StatTypeList = function() {
		this._init();
	}

	StatTypeList.prototype._init = function() {
		this.remove();
		this.add();
		this.duty();
	}

	StatTypeList.prototype.remove = function() {
		$('.del').live('click',function(){
			var id=$(this).attr('item_id');
			if (confirm("确定要删除吗？"))
			{
				window.location.href = "?r=statitem/dutyremove&id="+id;
			}
		});
		return;
	}

	StatTypeList.prototype.add = function() {
		var _this = this;
		$('#addbtn').bind('click',function(){
			_this.renderDialBox();
			_this.renderBCanvas();
		});
	}

	StatTypeList.prototype.renderDialBox = function() {
		var pane = document.createElement('div');
		pane.className = 'dialogue';
		pane.id = 'dial-box';
		var html = '';

		html += '<div class="title"><span class="title-desc">增加值班人员</span><a class="dialogue-cls"></a></div>';
		html += '<div class="detail" id="dial-box-detail">';
		html += '<form class="form-horizontal">';
		html += '<div style="display:none;" id="id"></div>';

		html += '<div class="control-group">';
		html += '<label class="control-label">姓名</label>';
		html += '<div class="controls">';
		html += '<input name="username" id="userid" type="text" class="span2 inline" style="width:200px"/>';
		html += '</div></div>';

		html += '<div class="control-group">';
		html += '<label class="control-label">Hi</label>';
		html += '<div class="controls">';
		html += '<input name="hiname" id="hiid" type="text" class="span2 inline" style="width:200px"/>';
		html += '</div></div>';

		html += '<div class="control-group">';
		html += '<label class="control-label">Email</label>';
		html += '<div class="controls">';
		html += '<input name="emailname" id="emailid" type="text" class="span2 inline" style="width:200px"/>';
		html += '</div></div>';

		html += '<div class="control-group">';
		html += '<div class="controls">';
		html += '<button class="btn btn-mini btn-primary reset_btn" id="save_btn" type="button">保存</button>';
		html += '<button class="btn btn-mini reset_btn_gray" type="button" id="cancel">取消</button>';
		html += '</div></div>';
		html += '</form>';
		html += '</div>';
		pane.innerHTML = html;
		document.body.appendChild(pane);
		this._initDialog();
		this.saveChange();
	}

	StatTypeList.prototype.renderBCanvas = function() {
		var _this = this;
		var pane = document.createElement('div');
		pane.className = 'b-canvas';
		pane.innerHTML = '';
		if ($('.b-canvas').length == 0) {
			document.body.appendChild(pane);
			_this._initBCanvas();
		}
	}
	
	StatTypeList.prototype.saveChange = function() {
		$('#save_btn').live('click',function() {
			var username = $('#userid').val();
			var hiname = $('#hiid').val();
			var emailname = $('#emailid').val();
			var url = "?r=statitem/saveduty";
			var param = {username:username,hiname:hiname,emailname:emailname};
			$.ajax({
				type: "POST",
				url: url,
				data: param,
				success: function(ajaxObj) {
					ajaxObj = eval("("+ajaxObj+")");
					if (ajaxObj.status == 1) {
						alert("保存成功！");
					}
					else
					{
						alert("保存失败，请稍后重试！");
					}
					window.location.reload();
				},
				error: function(XMLHttpRequest,textStatus,errorThrown) {
					alert("请联系雪卉解决您的问题！");
				}
			});
		});
	}

	StatTypeList.prototype._initDialog = function() {
		var _this = this;
		this.setLocation();
		$(window).bind('resize',function(e) {
			_this.setLocation();
			_this._initBCanvas();
		});
		$('#cancel').bind('click',function() {
			$('.dialogue').hide();
			$('.b-canvas').hide();
		});
		$('.dialogue-cls').bind('click',function() {
			$('.dialogue').hide();
			$('.b-canvas').hide();
		});
	}
	
	StatTypeList.prototype.setLocation = function() {
		var left = ($(window).width()-$('.dialogue').width()) / 2;
		var height = ($(window).height() - $('.dialogue').height()) / 2;
		$('.dialogue').css('left',left+ 'px');
		$('.dialogue').css('top',height + 'px');
		$('.dialogue').css('height', '250px');
	}

	StatTypeList.prototype._initBCanvas = function() {
		var width = $(window).width();
		var height = $(document).height();
		$('.b-canvas').css('width', width + 'px');
		$('.b-canvas').css('height', height + 'px');
		$('.b-canvas').css('left',0);
		$('.b-canvas').css('top',0);
	}

	StatTypeList.prototype.duty = function() {
		$('.duty').live('click', function() {
			var id = $(this).attr('item_id');
			var url = "?r=statitem/setduty";
			var param = {id:id};
			$.ajax({
				type: "POST",
				url: url,
				data: param,
				success: function(ajaxObj) {
					ajaxObj = eval("("+ajaxObj+")");
					if (ajaxObj["status"] == "1") {
						alert("设置成功！");
					}
					else if (ajaxObj["status"] == "2") {
						alert("该用户已经是值周人员！");
					}
					else if (ajaxObj.status == 0){
						alert("设置失败！");
					}
					window.location.reload();
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert("请联系雪卉反馈您的问题!");
				}
			});
		});
	}
	new StatTypeList();
})();
