(function(){
	var StatTypeList = function(){
		this._init();
	}

	StatTypeList.prototype._init = function(){
		this.search();
		this.editor();
		this.remove();
	}
	
	StatTypeList.prototype.search = function(){
		$('#search_btn').bind('click',function(){
			window.location.href = "?r=system/search&keyword=" + $('#fc_keyword').val();
		});
	}
	
	StatTypeList.prototype.remove = function(){
		var _this = this;
		$('.del').bind('click',function(){
			var id=$(this).attr('item_id');
			if (confirm("同学，你确定要删除 "+id+" 吗？"))
			{
				window.location.href = "?r=system/removefilecheck&name="+id;
			}
		});
	}

	StatTypeList.prototype.editor = function() {
		var _this = this;
		$('.editor').bind('click',function() {
			var fid = $(this).attr('item_id');
			var url = "?r=system/getItem";
			var param = {fid:fid};
			$.ajax({
				type: "POST",
				url: url,
				data: param,
				async:false,
				success: function(ajaxObj) {
					var obj = $.parseJSON(ajaxObj);
					console.log("test:"+obj.type);
					_this.renderDialBox(obj);
					_this.renderBCanvas();
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					console.log(errorThrown);
					alert("请联系QA反馈您的问题！");
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
			html += '<div class="title"><span class="title-desc">文件监控项编辑</span><a class="dialogue-cls"></a></div>';
			html += '<div class="detail" id="dial-box-detail">';
			html += '<form class="form-horizontal">';
			html += '<div style="display:none;" id="fid">' + obj.fid + '</div>';
			
			//file type: ftp or hdfs.
			html += '<div class="control-group">';
			html += '<label class="control-label">文件类型</label>';
			html += '<div class="controls">';
			html += '<select class="span2 mr10" name="type" id="ftype">';
			html += '<option value="1"';if (obj.type==1) html+= 'selected="selected">';else html+='>';html+='ftp</option><option value="2"';if (obj.type==2) html+= 'selected="selected">';else html+='>';html+='hdfs</option></select>';
			html += '</div></div>';
			
			html += '<div class="control-group">';
			html += '<label class="control-label">文件路径</label>';
			html += '<div class="controls">';
			html += '<input name="name" id="name" type="text" class="span2 inline" style="width:330px" value="'+obj.name+'" maxlength="767"/>';
			html += '</div></div>';
			
			html += '<div class="control-group">';
			html += '<label class="control-label">文件更新周期</label>';
			html += '<div class="controls">';
			html += '<input name="crontab_time" id="crontab_time" type="text" class="span2 inline" style="width:180px" value="'+obj.crontab_time+'" maxlength="30"/>';
			html +='</div></div>';

			html += '<div class="control-group">';
			html += '<label class="control-label">预期大小</label>';
			html += '<div class="controls">';
			html += '<input name="size_limit" id="size_limit" type="text" class="span2 inline" style="width:180px" value="'+obj.size_limit+'" maxlength="230px"/>';
			html += '</div></div>';

			html += '<div class="control-group">';
			html += '<label class="control-label">延迟时间</label>';
			html += '<div class="controls">';
			html += '<input name="delay_time" id="delay_time" type="text" class="span2 inline" style="width:180px" vlaue="'+obj.delay_time+'" maxlength="230px"/>';
			html += '</div></div>';

			html += '<div class="control-group">';
			html += '<label class="control-label">报警接收人</label>';
			html += '<div class="controls">';
			html += '<input name="user" id="user" type="text" class="span2 inline" style="width:256px" value="'+obj.user+'" maxlength="256"/>';
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
			$('#ftype').val(obj.type);
			$('#name').val(obj.name);
			$('#crontab_time').val(obj.crontab_time);
			$('#size_limit').val(obj.size_limit);
			$('#user').val(obj.user);
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
			var fid = $('#fid').html();
			var type = $('#ftype').val();
			var name = $('#name').val();
			var crontab_time = $('#crontab_time').val();
			var size_limit = $('#size_limit').val();
			var user = $('#user').val();
			var url = '?r=system/saveitem';
			var param = {fid:fid,type:type,name:name,crontab_time:crontab_time,size_limit:size_limit,user:user};

			$.ajax({
				type: "POST",
				url: url,
				data: param,
				success: function(ajaxObj) {
					var obj = $.parseJSON(ajaxObj);
					if(obj.status == 1) {
						alert('保存成功!');
					}
					else
					{
						alert('保存失败，请稍后重试！');
					}
					window.location.reload();
				},
				error:function(XMLHttpRequest,textStatus,errorThrown){
					alert("请联系QA反馈您的问题！");
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
		$('.dialogue').css('height', '350px');
	}

	StatTypeList.prototype._initBCanvas = function() {
		var width = $(window).width();
		var height = $(document).height();
		$('.b-canvas').css('width', width + 'px');
		$('.b-canvas').css('height', height + 'px');
		$('.b-canvas').css('left',0);
		$('.b-canvas').css('top',0);
	}

	new StatTypeList();
})();



