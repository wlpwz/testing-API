<!--RIGHT CONTENT-->
	{%if $memory==1%}				
		{%if $ec_type == 0%}		
			<div id="memory">
				<div class="panel panel-default">
                    <div class="panel-heading">内存测试结果  新版DC内存图</div>
					<div class="panel-body">
						<iframe frameborder=0 src="{%$memoryftp1%}" width="100%" height=400></iframe>
                    </div>
				</div>
				<div class="panel panel-default">
                    <div class="panel-heading">内存测试结果 旧版DC内存图</div>
					<div class="panel-body">
					        <iframe frameborder=0  src="{%$memoryftp3%}" width="100%" height=400></iframe>
					</div> 
				</div>
			</div>
		{%/if%}
		{%if $ec_type==1%}
			<div id="memory">
                <div class="panel panel-default">
                    <div class="panel-heading">内存测试结果  新版DC内存图</div>
                    <div class="panel-body">
                        <iframe frameborder=0 src="{%$memoryftp1%}" width="100%" height=400></iframe>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">内存测试结果  旧版DC内存图</div>  
                    <div class="panel-body">
                            <iframe frameborder=0  src="{%$memoryftp3%}" width="100%" height=400></iframe>
                    </div>  
                </div>  
			</div>
		{%/if%}
	{%/if%}
	{%if $speed==1 %}
		{%if $ec_type==0%}
			<div id="speed">
				<div class="panel panel-success">
					<div class="panel-heading">包处理速度统计</div>
						<table width="100%" class="table table-bordered table-striped" style="text-align:center;font-size:15px;">
							<tr>
                            	<td>版本</td>
								<td width="33.33%">新版DC</td>
								<td width="33.3">旧版DC</td>
                        	</tr>
							<tr>
                                <td>速度</td>
                                <td width="33.33%">{%$speed1%}包/秒</td>
								<td width="33.33%">{%$speed3%}包/秒</td>
                            </tr>	

						</table>
					</div>
				</div>
		{%/if%}
		{%if $ec_type==1%}
			<div id="speed">
                <div class="panel panel-success">
                    <div class="panel-heading">包处理速度统计</div>
                        <table width="100%" class="table table-bordered table-striped" style="text-align:center;font-size:
15px;">
                            <tr>
                                <td>新版DC</td>
                                <td width="83.33%">{%$speed1%}包/秒</td>
                            </tr>
                            <tr>
                                <td>旧版DC</td>
                                <td width="83.33%">{%$speed3%}包/秒</td>
                            </tr>
                        </table>
                    </div>
                </div>
		{%/if%}
	{%/if%}
			<!--END RIGHT CONTENT-->
