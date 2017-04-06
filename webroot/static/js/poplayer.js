(function(){
	var PopLayer = function(config){
		var _this = this;
		_this.title = config.title || '示例';
		_this.width = config.width || '600px';
		_this.height = config.height || '496px';
		_this.auto = config.auto || false;
	}
	
	PopLayer.prototype._initDailogue = function(){
		var _this = this;
		_this.setWidthAndHeight();
		_this.setLocation();

		$(window).bind('resize', function(e){
			_this.setLocation();
			_this._initBCanvas();
		});
		$('#cancel').bind('click', function(){
			$('.popup').hide();
			$('.b-canvas').hide();
		});
		$('.pop-close').bind('click', function(){
			$('.popup').hide();
			$('.b-canvas').hide();
		});
	}
	
	PopLayer.prototype._initBCanvas = function(){
		var width = $(window).width();
		var height = $(document).height(); 
		$('.b-canvas').css('width', width + 'px');
		$('.b-canvas').css('height', height + 'px');
		$('.b-canvas').css('left', 0);
		$('.b-canvas').css('top', 0);
	}

	
  PopLayer.prototype.hideDialogue = function(){
      $('.popup').hide();
      $('.b-canvas').hide();
  }
	
	PopLayer.prototype.setLayerTitle = function(title){
		this.title = title;
	}
	
	PopLayer.prototype.setLayerWidth = function(width){
		if(this.width!=width){
			$('.popup').css('height', width);
		}
	}
	
	PopLayer.prototype.setLayerHeight = function(height){
		if(this.height!=height){
			$('.popup').css('height', height);
		}
	}
	
	PopLayer.prototype.setLocation = function() {
		var left = ($(window).width()-$('.popup').width())/2;
		var height = ($(window).height()-$('.popup').height())/2;
		$('.popup').css('left', left + 'px');
		$('.popup').css('top', height + 'px');
	};
	
	PopLayer.prototype.setWidthAndHeight = function() {
		var _this = this;
		$('.popup').css('width', _this.width);
		$('.popup').css('height', _this.height);
	};

	PopLayer.prototype.renderPopLayer = function(html){
		var _this = this;
		
		_this.renderDialogue(html);
		_this.renderBCanvas();

		if(_this.auto){
			var reheight = $('#dial-box-detail').height()+65;
			_this.setLayerHeight(reheight);
		}

	}

	PopLayer.prototype.renderDialogue = function(content){
		var _this = this;

		if($('.popup').length == 0) {
			var pane = document.createElement('div');
			pane.className = 'popup';
			pane.id='dial-box';
			
			var html = '';
			html += '<div class="popup-header">' + _this.title;
			html += '<a href="#" class="fr pop-close">';
			html += '<i class="icon14 icon14-close"></i>关闭</a>';
			html += '<div class="clear"></div></div>';    
			html += '<div class="popup-main" id="dial-box-detail">';
			html += content;
            html += '</div>';
            html += '<div class="popup-footer"><a href="javascript:void(0);" id="save" class="btn btn-primary">保存</a> <a href="javascript:void(0);" class="btn pop-close">取消</a></div>';
			
			pane.innerHTML = html;
			document.body.appendChild(pane);
			this._initDailogue();
		} else {
			$('#dial-box-detail').html(content);
			$('.popup').show();
			$('.b-canvas').show();
		}
	}

    PopLayer.prototype.getSaveBtn = function(){
        return $("#save");
    }
	
	PopLayer.prototype.renderBCanvas = function(){
		var _this = this;
		var pane = document.createElement('div');
		pane.className = 'b-canvas';
		pane.innerHTML = '';
		if($('.b-canvas').length == 0) {
			document.body.appendChild(pane);
			_this._initBCanvas();
		}
	}
	
	 window.poplayer = PopLayer;  
})();
