<!--RIGHT CONTENT-->
				
	{%if $memory==1%}
		{%if $ec_type == 0%}		
			<div id="memory">
				<div class="panel panel-default">
                    <div class="panel-heading">内存测试结果---新版EC1内存图</div>
					<div class="panel-body">
						<iframe frameborder=0 src="{%$memoryftp1%}" width="100%" height=400></iframe>
                    </div>
				</div>
				<div class="panel panel-default">
                    <div class="panel-heading">内存测试结果---旧版EC1内存图</div>
					<div class="panel-body">
					        <iframe frameborder=0  src="{%$memoryftp3%}" width="100%" height=400></iframe>
					</div> 
				</div>
				{%if ($newec1_strategy[0]==0)&&($oldec1_strategy[0]==0)%}
				<div class="panel panel-default">
                    <div class="panel-heading">内存测试结果---新版EC2内存图</div>
                    <div class="panel-body">
                        <iframe frameborder=0 src="{%$memoryftp2%}" width="100%" height=400></iframe>
                    </div>
				</div>
				<div class="panel panel-default"> 
					<div class="panel-heading">内存测试结果---旧版EC2内存图</div>  
                <div class="panel-body">
                        <iframe frameborder=0 src="{%$memoryftp4%}" width="100%" height=400></iframe>
                </div>    		
				{%/if%}
			</div>
		{%/if%}
		{%if $ec_type==1%}
			<div id="memory">
                <div class="panel panel-default">
                    <div class="panel-heading">内存测试结果---新版EC内存图</div>
                    <div class="panel-body">
                        <iframe frameborder=0 src="{%$memoryftp1%}" width="100%" height=400></iframe>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">内存测试结果---旧版EC内存图</div>  
                    <div class="panel-body">
                            <iframe frameborder=0  src="{%$memoryftp3%}" width="100%" height=400></iframe>
                    </div>  
                </div>  
			</div>
		{%/if%}
	{%/if%}
	{%if $speed==1%}
		{%if $ec_type==0%}
			<div id="speed">
				<div class="panel panel-success">
					<div class="panel-heading">包处理速度统计</div>
						<table width="100%" class="table table-bordered table-striped" style="text-align:center;font-size:15px;">
							<tr>
                            	<td>版本</td>
								<td width="33.33%">新版（包/秒）</td>
								<td width="33.3">旧版（包/秒）</td>
                        	</tr>
							<tr>
                                <td>EC1</td>
                                <td width="33.33%">{%$speed1%}包/秒</td>
								<td width="33.33%">{%$speed3%}包/秒</td>
                            </tr>	
							{%if ($newec1_strategy[0]==0)&&($oldec1_strategy[0]==0)%}
							<tr>
                                <td>EC2</td>
                                <td width="33.33%">{%$speed2%}包/秒</td>
								 <td width="33.33%">{%$speed4%}包/秒</td>
                            </tr>
							{%/if%}
						</table>
					</div>
			<!--		<iframe height=400 width=100% marginheight=0 frameborder=0  scrolling="no" src="http://tservice.baidu.com/chart/apibar?data=新版,{%$speed1%},{%$speed2%};旧版,{%$speed3%},{%$speed4%}&label_x=新旧EC1包处理速度比对,新旧EC2包处理速度比对&height=320&label_y_unit=包/秒"></iframe>
				--><!--	<table width="100%">
					<tr>
					<td><iframe height=400 width=100% marginheight=0 frameborder=0  scrolling="no" src="http://tservice.baidu.com/chart/apibar?data=新EC,{%$speed1%},{%$speed2%};旧EC,{%$speed3%},{%$speed4%};&label_x=新旧EC1包处理速度比对,新旧EC1包处理速度比对&height=320&label_y_unit=包/秒"></iframe>
					</td>
					<td>
					<iframe height=400 width=100% frameborder=0 marginWidth=0 marginHeight=0 border:0 none scrolling="no" src="http://tservice.baidu.com/chart/apibar?data=新EC2,{%$speed2%};旧EC2,{%$speed4%}&label_x=新旧EC2包处理速度比对&height=320&label_y_unit=包/秒"></iframe>
					</td>
					</tr>
					</table>-->
				</div>
		{%/if%}
		{%if $ec_type==1%}
			<div id="speed">
                <div class="panel panel-success">
                    <div class="panel-heading">包处理速度统计</div>
                        <table width="100%" class="table table-bordered table-striped" style="text-align:center;font-size:
15px;">
                            <tr>
                                <td>新版EC</td>
                                <td width="83.33%">{%$speed1%}包/秒</td>
                            </tr>
                            <tr>
                                <td>旧版EC</td>
                                <td width="83.33%">{%$speed3%}包/秒</td>
                            </tr>
                        </table>
                    </div>
            <!--        <iframe height=400 width=100% marginheight=0 frameborder=0  scrolling="no" src="http://tservice.ba
idu.com/chart/apibar?data=新版,{%$speed1%},{%$speed2%};旧版,{%$speed3%},{%$speed4%}&label_x=新旧EC1包处理速度比对,新旧EC2>
包处理速度比对&height=320&label_y_unit=包/秒"></iframe>
                --><!-- <table width="100%">
                    <tr>
						 <td><iframe height=400 width=100% marginheight=0 frameborder=0  scrolling="no" src="http://tservice.baidu.com/chart/apibar?data=新EC,{%$speed1%},{%$speed2%};旧EC,{%$speed3%},{%$speed4%};&label_x=新旧EC1包处理速度比对,新旧EC1包处理速度比对&height=320&label_y_unit=包/秒"></iframe>
                    </td>
                    </tr>
                    </table>-->
                </div>
		{%/if%}
	{%/if%}
			<!--END RIGHT CONTENT-->
