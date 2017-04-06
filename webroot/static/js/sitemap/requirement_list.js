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
			var url = "?r=requirement/getitem";
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
					alert("请联系QA-yangyanhong反馈您的问题！");
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
			html += '<div class="title"><span class="title-desc">需求编辑</span><a class="dialogue-cls"></a></div>';
			html += '<div class="detail" id="dial-box-detail">';
			html += '<form class="form-horizontal">';
			html += '<div style="display:none;" id="id">' + obj.id + '</div>';
			html += '<div class="control-group">';
			html += '<label class="control-label">需求名称</label><div class="controls">';
			html += '<input name="name" id="name"  type="text" class="span2 inline" style="width:300px" value="'+ obj.name +'" placeholder="完善全部联系方式用户数" maxlength="30"/>';
			//html += '<div class="controls"><textarea id="name" class="span2 inline" name="name" rows="5" style="width:300px">'+ obj.name +'</textarea>';
			html += '</div></div>';
			html += '<div class="control-group">';
			html += '<label class="control-label">详情/MRD</label><div class="controls">';
			html += '<textarea name="file" id="file" class="span2 inline" rows="5" style="width:300px" value="" placeholder="http://icafe.url">'+ obj.file +'</textarea>';
			//html += '<div class="controls"><input id="file" class="span2 inline" name="file" style="width:300px" maxlength="100" type="text" placeholder="" value="' + obj.file + '" required>';
			html += '</div>';
			html += '</div>';
			html += '<div class="control-group">';
			html += '<label class="control-label">需求分类</label>';
			html += '<div class="controls"><select class="span2 mr10" name="category" id="category">';
			html += '<option value="1">平台展现</option><option value="2">校验策略</option><option value="3">统一回灌</option><option value="4">其他</option></select>';
			html += '</div>';
			html += '</div>';
			html += '<div class="control-group">';
			html += '<label class="control-label">申请人</label>';
			html += '<div class="controls"><input id="proposer" class="span2 inline" name="proposer" size="50" maxlength="100" type="text" placeholder="" value="' + obj.proposer + '" required>';
			html += '</div>';
			html += '</div>';
			html += '<div class="control-group">';
			html += '<label class="control-label">需求状态</label>';
			html += '<div class="controls"><select class="span2 mr10" name="state" id="state">';
			html += '<option value="1">新建</option><option value="2">开发中</option><option value="3">已完成</option><option value="4">延迟处理</option></select>';
			html += '</div>';
			html += '</div>';
			html += '<div class="control-group">';
			html += '<label class="control-label">发布地址</label><div class="controls">';
			html += '<input name="online_url" id="online_url" type="text" class="span2 inline" style="width:300px" value="'+ obj.online_url +'" placeholder="http://pat.baidu.com/index.php?r=requirement/list" maxlength="255"/>';
			//html += '<div class="controls"><textarea id="name" class="span2 inline" name="name" rows="5" style="width:300px">'+ obj.name +'</textarea>';
			html += '</div></div>';
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
			$('#state').val(obj.state);
			$('#category').val(obj.category);
		} else {
			$('#id').html(obj.id);
			$('#name').val(obj.name);
			$('#file').val(obj.file);
			$('#proposer').val(obj.proposer);
			$('#state').val(obj.state);
			$('#category').val(obj.category);
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
			var name = $('#name').val();
			var file = $('#file').val();
			var proposer = $('#proposer').val();
			var state = $('#state').val();
			var category = $('#category').val();
			var url = '?r=requirement/saveitem';
			var online_url = $("#online_url").val();
			var param = {id:id,name:name,file:file,proposer:proposer,state:state,category:category,online_url:online_url};
			
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
					alert("请联系QA-yangyanhong反馈您的问题！");
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
			window.location.href = "?r=requirement/search&keyword=" + $('#keyword').val();	
		});
	}
	
	new StatTypeList();

})();
