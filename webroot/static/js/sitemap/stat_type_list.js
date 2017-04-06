(function(){
	var StatTypeList = function(){
		this._init();
	}
	
	StatTypeList.prototype._init = function(){
		this.editor();
		this.slidePage();
		this.search();
	}
	
	StatTypeList.prototype.editor = function(){
		var _this = this;
		$('.editor').bind('click', function(){
			var id = $(this).attr('item_id');
			var url = "?r=statitem/gettype";
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
			html += '<label class="control-label">监控项</label>';
			html += '<div class="controls"><input id="type_name" class="span2 inline" size="50" type="text" value="' + obj.type + '" disabled/>';
			html += '</div></div>';
			html += '<div class="control-group">';
			html += '<label class="control-label">中文名称</label>';
			html += '<div class="controls"><input id="type_cname" class="span2 inline" name="module" size="50" maxlength="100" type="text" placeholder="" value="' + obj.cname + '" required>';
			html += '</div>';
			html += '</div>';
			html += '<div class="control-group">';
			html += '<label class="control-label" for="note">描述</label>';
			html += '<div class="controls"><textarea id="type_note" name="note" rows="5" size="1022" style="width:300px;resize: none;">';
			html += obj.note;
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
			$('#type_name').val(obj.type);
			$('#type_cname').val(obj.cname);
			$('#type_note').val(obj.note);
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
			var type = $('#type_name').val();
			var cname = $('#type_cname').val();
			var note = $('#type_note').val();
			var url = '?r=statitem/savetype';
			var param = {id:id,type:type,cname:cname,note:note};
			
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
	
	StatTypeList.prototype.slidePage = function(){
		var pagesize = $('#pagesize').html();
		var url = '?r=statitem/items&mid=' + $('#module_id').html() + '&keyword='+ $('#keyword').val() +'&pagesize='+ pagesize;
		var obj = {count:$('#count').html(), page:$('#pagenum').html(), pagesize:pagesize,url:url};
		new window.page(obj);
	
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
	};
	StatTypeList.prototype.setLocation = function() {
		var left = ($(window).width()-$('.dialogue').width())/2;
		var height = ($(window).height()-$('.dialogue').height())/2;
		$('.dialogue').css('left', left + 'px');
		$('.dialogue').css('top', height + 'px');
	};
	
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
			window.location.href = "?r=statitem/items&mid=" + $('#module_id').html() + "&keyword=" + $('#keyword').val();	
		});
	}
	
	
	new StatTypeList();


})();
