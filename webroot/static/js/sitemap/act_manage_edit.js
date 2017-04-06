(function(){
	var monItem = function(){
		this.init();
	}
	
	//jquery delegate方法被重写，直接使用delegate不生效
	monItem.prototype._fakeDelegate = function(p,e,t,n,r){
		return p.on(t,e,n,r);
	}
	
	monItem.prototype.init = function(){
		var _this = this;
			_this.add();
			_this.del();
			
		//取消按钮
		$('#cancel').bind('click', function(){
			window.location.href="?r=actManage/index";
		});
	}					

	monItem.prototype.add = function(){
		var _this = this;
			_this._fakeDelegate($('#mon-items'),'.add-item', 'click', function(){
				var pane = document.createElement('div');
					pane.className = "items-class";
					
				var html = '';
					html += '<table><tr><td class="i-lab">中文名称</td>';
					html += '<td><input class="span3 inline" name="item-name[]" size="50" type="text" maxlength="50"></td>';
					html += '<td><a href="javascript:;" class="add-item" title="增加"><i class="icon-plus"></i></a>|';
					html += '<a href="javascript:;" class="del-item" title="删除"><i class="icon-minus"></i></a></td></tr>';
					html += '<tr><td class="i-lab">目标值</td>';
					html += '<td><input class="span2 inline" name="item-target[]" size="50" type="text" maxlength="50"></td>';
					html += '<td></td></tr>';
					html += '<tr><td class="i-lab">监控项ID</td>';
					html += '<td><input class="span2 inline" name="item-id[]" size="50" type="text" maxlength="50" placeholder="对应count_type中id"></td>';
					html += '<tr><td class="i-lab">数据源</td>';
					html += '<td><select name="data_source[]"><option value="db-sitemap2">数据库(sitemap2)</option>';
					//html += '<option value="log-foundation">日志(站长平台)</option></select></td>';
					html += '</select></td>';
					html += '<td></td></tr>';
					html += '<tr><td class="i-lab">计算方式</td><td><input class="span3 inline" name="cal_method[]" size="50" type="text" value=""></td>';
				  html += '<td></td></tr></table>';

					pane.innerHTML = html;
					$('#mon-items').append(pane);
			});
	}

	monItem.prototype.del = function(){
		var _this = this;
			_this._fakeDelegate($('#mon-items'), '.del-item', 'click', function(){
			$(this).parent().parent().parent().parent().parent().remove();
		});
	}
	
	//$(document).ready(function(){
		new monItem();
	//});
	


})();
