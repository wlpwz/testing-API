(function(){
	var StatTypeList = function() {
		this._init();
	}

	StatTypeList.prototype._init = function() {
		this.remove();
		this.editor();
		this.delrole();
		this.delpri();
	}

	StatTypeList.prototype.remove = function() {
		var _this = this;
		
		$('.del').bind('click',function(){
			var id=$(this).attr('item_id');
			if (confirm("皇上，您确定要逼臣妾将他/她除名吗？"))
			{
				window.location.href = "?r=permission/removeuser&id="+id;
			}
		});
	}

	StatTypeList.prototype.editor = function() {
		var _this = this;
		$('.editor').bind('click',function() {
			var id = $(this).attr('item_id');
			var url = "?r=permission/getItem";
			var param = {id:id};
			$.ajax({
				type: "POST",
				url: url,
				data: param,
				async: false,
				success: function(ajaxObj) {
					var obj = $.parseJSON(ajaxObj);
					_this.renderDialBox(obj);
					_this.renderBCanvas();
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					console.log(errorThrown);
					alert("请联系雪卉反馈您的问题！");
				}
			});
		});
	}
	
	StatTypeList.prototype.renderDialBox = function(obj) {
		if($('.dialogue').length == 0) {
			var pane = document.createElement('div');
			pane.className = 'dialogue';
			pane.id = 'dial-box';
			var html = '';
			
			html += '<div class="title"><span class="title-desc">用户管理</span><a class="dialogue-cls"></a></div>';
			html += '<div class="detail" id="dial-box-detail">';
			html += '<form class="form-horizontal">';
			html += '<div style="display:none;" id="id">'+obj.uinfo.id + '</div>';
			
			html += '<div class="control-group">';
			html += '<label class="control-label">用户</label>';
			html += '<div class="controls">';
			html += '<input name="user" id="user" type="text" class="span2 inline" readonly="true" style="width:200px" value="'+obj.uinfo.user+'"/>';
			html += '</div></div>';
			
			html += '<div class="control-group">';
			html += '<label class="control-label">用户组</label>';
			html += '<div class="controls">';
			html += '<select class="span2 mr10" name="type" id="role" style="width:210px" selected="'+obj.uinfo.level+'">';
			for (var i=0;i<obj.roles.length;i++)
			{
				if (obj.roles[i].level == obj.uinfo.level)
					html += '<option value='+i+' selected="selected">'+obj.roles[i].name+'</option>';
				else
					html += '<option value='+i+'>'+obj.roles[i].name+'</option>';
			}
			html += '</select>';
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
		else
		{
			$('#user').val(obj.uinfo.user);
			$('#role').val(obj.uinfo.level);
			$('.dialogue').show();
			$('.b-canvas').show();
		}
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
		$('#save_btn').bind('click',function() {
			var id = $('#id').html();
			var role = $('#role').val();
			var url = "?r=permission/saveuser";
			var param = {id:id,role:role};

			$.ajax({
				type: "POST",
				url: url,
				data: param,
				success: function(ajaxObj) {
					var obj = $.parseJSON(ajaxObj);
					if(obj.status == 1) {
						alert("保存成功！");
					}
					else
					{
						alert("保存失败，请稍后重试！");
					}
					window.location.reload();
				},
				error: function(XMLHttpRequest,textStatus,errorThrown) {
					alert("请联系管理员解决您的问题！");
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
		$('.dialogue').css('height', '220px');
	}

	StatTypeList.prototype._initBCanvas = function() {
		var width = $(window).width();
		var height = $(document).height();
		$('.b-canvas').css('width', width + 'px');
		$('.b-canvas').css('height', height + 'px');
		$('.b-canvas').css('left',0);
		$('.b-canvas').css('top',0);
	}
	
	StatTypeList.prototype.delrole = function() {
		var _this = this;
		$('.delrole').bind('click',function() {
			var id =$(this).attr('item_id');
			if (confirm("您这一删除可能导致许多用户没有权限，你确定要删除吗？"))
			{
				window.location.href = "?r=permission/removerole&id="+id;
			}
		});
	}

	StatTypeList.prototype.delpri = function() {
		$('.delpri').bind('click',function() {
			var id = $(this).attr('item_id');
			if (confirm("亲，您确定要删除么？"))
			{
				window.location.href = "?r=permission/removepri&id="+id;
			}
		});
	}

	new StatTypeList();
})();
