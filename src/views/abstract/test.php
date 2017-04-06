<link rel="stylesheet" href="/static/js/mock/service-graph.css" />
<div style="margin-top:20px;">
			<h2 style="margin-left:20px">版本列表</h2>
            <div class="col-md-2">
                <div class="list-group">
                    <a href="#" class="list-group-item active">中文</a>
                    <a href="#" class="list-group-item ">国际化</a>
                </div>
            </div>
			<div class="col-md-10">
			<!--	<canvas id="myCanvas" width="400" height="200">
				</canvas>-->
				<div id="pics">
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" charset="utf8" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/mock/d3.js"></script>  
<script type="text/javascript" src="/static/js/mock/dagre-d3.js"></script>    
<script type="text/javascript" src="/static/js/mock/serviceGraph.js"></script>    
<script type="text/javascript" src="/static/js/mock/mock.js"></script>
<script type="text/javascript">
						//弹出框
						var serviceGraph = new ServiceGraph(document.getElementById('pics'));
						serviceGraph.tooltip = function (moduleName){
							return "<h5>" + moduleName + "的tooltip";
						};
						
						//	下面的都是模拟数据
						//初始化10个模块
						for (var i = 0; i < 10; i++) {
							var len = Math.floor(Math.random() * 5) + 3;
							len = 4;
							for (var j = 0; j < len; j++) {
								var module = mockModule(i);
								serviceGraph.addModule(module.name, module.health, 'http://www.baidu.com');
							}
						}
						for (var i = 0; i < modules.length - 2; i++) {
							for (var j = 0; j < modules[i].length; j++) {
								var module = modules[i][j];
								var link = mockLink(module);
								serviceGraph.addLink(link.source, link.target, link.health, 'http://www.baidu.com');
							}
						}
						serviceGraph.refresh();

						

					</script>

