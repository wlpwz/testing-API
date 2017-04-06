<script type="text/javascript" charset="utf8" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/mock/d3.js"></script>  
<script type="text/javascript" src="/static/js/mock/dagre-d3.js"></script>    
<script type="text/javascript" src="/static/js/mock/serviceGraph.js"></script>			
<link rel="stylesheet" href="/static/js/mock/service-graph.css" />
            <div class="col-md-2">
                <div class="list-group">
                    <a href="#" class="list-group-item active">中文</a>
                    <a href="#" class="list-group-item ">国际化</a>
                </div>
            </div>
			<div class="col-md-10">
				<div style="display:none;">
    				<p id="result"><?php echo $result;?></p>
				</div>
				<div id="pics">
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
		//弹出框
		var serviceGraph = new ServiceGraph(document.getElementById('pics'));
		serviceGraph.tooltip = function (moduleName){
			return "<h5>" + moduleName + "的tooltip";
		};
		
		var temp=$('#result').html();
		console.log(temp);
        var	data = $.parseJSON(temp);
		//增加模块
		for(var i = 0 ; i < data.length-2 ; i++)
		{
			serviceGraph.addModule(data[i]['name'], data[i]['health'], data[i]['url']);
			//alert(data[i]['name']);
			var str = data[i]['linkname'];		
		//	var link[i] = str.split(',');  
		//	console.log(link[i]);
		}
		for(var i = 0 ; i < data.length-2 ; i++)
		{
			if(data[i]['linknode']!="\n")
			{
				var str = data[i]['linknode'].substr(0,data[i]['linknode'].length-1);
				console.log(str);
				if(str.indexOf(",")<0)
				{	serviceGraph.addLink(data[i]['name'],str, data[i]['health'],data[i]['url']);}			
				else
				{
					var links=str.split(",");
					for(var j=0;j<links.length;j++)
					  serviceGraph.addLink(data[i]['name'],links[j], data[i]['health'],data[i]['url']);
				}
			}
		}

						
		serviceGraph.refresh();
</script>

