(function(){
	var SchemaDataCount = function(){
		this._stat = [];
		this._stat['1'] = '等待';
		this._stat['2'] = '正常';
		this._stat['3'] = '错误';
		this._init();
	}
	
	SchemaDataCount.prototype._init = function(){
		this.editor();
		this.pages();
		this.search();
	}

	SchemaDataCount.prototype.search = function(){
		$('#search_btn').bind('click', function(){
			var keyword = $('#keyword').val();
			var resource_type = $('#resource_type').html();
			window.location.href = '?r=tools/getsiteDetails' + '&resource_type=' + resource_type + '&keyword='+ keyword;
		});
	}

	SchemaDataCount.prototype.pages = function(){
		var keyword = $('#keyword').html();
		var pagesize = $('#pagesize').html();
		var resource_type = $('#resource_type').html();

		var url = '?r=tools/getsiteDetails' + '&resource_type=' + resource_type + '&keyword='+ $('#keyword').val() +'&pagesize='+ pagesize;
		var obj = {count:$('#count').html(), page:$('#pagenum').html(), pagesize:pagesize,url:url};
		new window.page(obj);
  
	}
	
	SchemaDataCount.prototype.editor = function(){
		var _this = this;
		
		$('.xml_details').bind('click', function(){
			var clk_this = this;
			$(clk_this).html('加载中...');
			var url = "?r=tools/getXmlUrl";
			var resource_type = $(this).attr('schemaID');
			var site = $(this).attr('site') || '';
			var param = {'resource_type':resource_type, 'site':site};  
			$.ajax({
				type: "POST",
				url: url,
				data: param,
				async: true,
				success: function(ajaxObj){
					var obj = $.parseJSON(ajaxObj);
					_this.renderDialBox(obj, clk_this);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
				console.log(errorThrown);
					alert("请联系QA反馈您的问题！");
				}
			});
			// $(this).html('查看');
		});
	}

	SchemaDataCount.prototype.renderDialBox = function(obj, clk_this){
		console.log(clk_this);
		var _this = this;
		var conf = {title:'查看xml片段', width:'600px', height:'408px', auto:false};
		var poplayer = new window.poplayer(conf);
		var html = _this.xmlTableHtml(obj);
		poplayer.renderPopLayer(html);
		$(clk_this).html('XML片段');
	}
	
	SchemaDataCount.prototype.xmlTableHtml = function(obj){
		var stat = '未知';
		var len = obj.length;
		var html = '';
			html += '<table id="xmltable" class="table table-bordered" style="width:540px;margin:auto;margin-top:5px;">';
			html += '<thead>';
			html += '<th width="85%">xml</th>';
			html += '<th width="15%">抓取状态</th>';
			html += '</thead><tbody>';
			for(var i=0; i<len; i++){
				(this._stat[obj[i].stat])&&(stat = this._stat[obj[i].stat]);
				html += '<tr>';
				html += '<td><a href="http://' + obj[i].url + '" target="_blank">' + obj[i].url + '</a></td>';
				html += '<td>' + stat + '</td>';
				html += '</tr>';
			}
			html += '</tbody></table>';
		return html;
	}

	new SchemaDataCount();


})();
