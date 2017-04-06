(function(){
	var BdshareSitePv = function(){
		this.editor();
	}
	
	BdshareSitePv.prototype.editor = function(){
		var _this = this;

		$('.tags').bind('click', function(){
			var clk_this = this;
			var site = $(clk_this).attr('site');
			var tags = $(clk_this).parent().parent().find('td').eq(2).html();
			var obj = {site:site, tags:tags};
				_this.renderDialBox(obj, clk_this);
		});
	}

	BdshareSitePv.prototype.renderDialBox = function(obj, clk_this){
		var _this = this;
		var conf = {title:'编辑分类', width:'500px', height:'185px', auto:false};
		var poplayer = new window.poplayer(conf);
		var html = _this.tableHtml(obj);
		poplayer.renderPopLayer(html);
		_this.cancelTags(poplayer);
		_this.saveTags();
	}
	
	BdshareSitePv.prototype.tableHtml = function(obj){
		var html = '';
			html += '<form class="form-horizontal">';
			html += '<div class="control-group">';
			html += '<label class="control-label">站点</label>';
			html += '<div class="controls"><input id="site_item" name="site" class="span3 inline" size="50" type="text" value="' + obj.site + '" disabled/>';
			html += '</div></div>';
			html += '<div class="control-group">';
			html += '<label class="control-label">分类</label>';
			if(obj.tags){
				html += '<div class="controls"><input id="tag_item" class="span3 inline" name="tags" size="50" maxlength="100" type="text" placeholder="" value="' + obj.tags
 + '" required placeholder="多个分类请以逗号\",\"分隔">';
			}else{
				html += '<div class="controls"><input id="tag_item" class="span3 inline" name="tags" size="50" maxlength="100" type="text" required placeholder="多个分类请以逗号,分隔">';
			}
			html += '</div></div>';
			html += '<div class="control-group">';                                                                                                          
			html += '<div class="controls">';                                                                                                               
			html += '<button class="btn btn-mini btn-primary reset_btn" id="save_tag" type="button">保存</button>';                                         
			html += '<button class="btn btn-mini reset_btn_gray" type="button" id="cancel_tag">取消</button>';                                                  
			html += '</div>';                                                                                                                               
			html += '</div>'; 
			html += '</form>';
		return html;
	}

	BdshareSitePv.prototype.cancelTags = function(poplayer){
		$('#cancel_tag').bind('click', function(){
			poplayer.hideDialogue();
		});
	}
	
	BdshareSitePv.prototype.saveTags = function(){
		$('#save_tag').bind('click', function(){
            var site = $("#site_item").val();  
			var tags = $("#tag_item").val();
            var url = "?r=bdshare/saveTags";                                                                                                                          
                  
            var sendData = {                                                                                                                                                       
                'site': site,                                                                                                                                           
                'tags': tags,                                                                                                                                      
            };                                                                                                                                                          
                                                                                                                              
              $.post(url, sendData, function(data) {                                                                                                                     
                eval("var data = " + data);                                                                                                           
                if(data.status==1){                                                                                                                   
                    alert('操作成功！');                                                                                                              
                    window.location.reload();                                                                                                         
                }else{                                                                                                                                
                    alert('操作失败，请稍候重试！');                                                                                                  
                }                                                                                                                                                                                                                                                                                  
               });                                                                                                                                    
		});
	}
	
	
	new BdshareSitePv();
})();
