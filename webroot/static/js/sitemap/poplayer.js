(function(){
	var PopLayer = function(config){
		var _this = this;
		_this.title = config.title || '示例';
		_this.width = config.width || '600px';
		_this.height = config.height || '455px';
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
			$('.dialogue').hide();
			$('.b-canvas').hide();
		});
		$('.dialogue-cls').bind('click', function(){
			$('.dialogue').hide();
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
      $('.dialogue').hide();
      $('.b-canvas').hide();
  }
	
	PopLayer.prototype.setLayerTitle = function(title){
		this.title = title;
	}
	
	PopLayer.prototype.setLayerWidth = function(width){
		if(this.width!=width){
			$('.dialogue').css('height', width);
		}
	}
	
	PopLayer.prototype.setLayerHeight = function(height){
		if(this.height!=height){
			$('.dialogue').css('height', height);
		}
	}
	
	PopLayer.prototype.setLocation = function() {
		var left = ($(window).width()-$('.dialogue').width())/2;
		var height = ($(window).height()-$('.dialogue').height())/2;
		$('.dialogue').css('left', left + 'px');
		$('.dialogue').css('top', height + 'px');
	};
	
	PopLayer.prototype.setWidthAndHeight = function() {
		var _this = this;
		$('.dialogue').css('width', _this.width);
		$('.dialogue').css('height', _this.height);
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

		if($('.dialogue').length == 0) {
			var pane = document.createElement('div');
			pane.className = 'dialogue';
			pane.id='dial-box';
			
			var html = '';
			html += '<div class="title">';
			html += '<span class="title-desc">'+ _this.title +'</span>';
			html += '<a class="dialogue-cls"></a>';
			html += '</div>';    
			html += '<div class="detail" id="dial-box-detail">';
			html += content;
			html +='</div>';
			
			pane.innerHTML = html;
			document.body.appendChild(pane);
			this._initDailogue();
		} else {
			$('#dial-box-detail').html(content);
			$('.dialogue').show();
			$('.b-canvas').show();
		}
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
