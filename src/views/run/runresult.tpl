{%$this->beginContent('/layouts/main', ['current'=>'ecTask'])%}
<div class="container">
    <div class="row">
		<div style="margin-top:20px;margin-left:-50px">
			<!--LEFT CONTENT-->
            <div class="col-md-2">
                <div class="list-group">
					<B class="list-group-item " style="background-color:#F5F5F5;">在线运行任务{%$taskid%}详情：</B>
                    <a href="#" class="list-group-item active">结果概况</a>
                </div>
            </div>
			<!--END LEFT CONTENT-->
			<!--RIGHT CONTENT-->
			<div class="col-md-10">
				<div class="head_line">
   					<ul class="breadcrumb">
						<li><a href="index.php?r=ecTask/runmission">在线运行任务列表</a></li>
      					<li>在线任务详情</li> 
     		 			<li class="active">结果概况</li> 
   					</ul>   
				</div> 
				<div class="panel panel-default">
					{%if $run_type=="consistentdiff\n"%}
						<!-- <div class="panel-heading"><strong>结果概要：</strong><font color="black">比较新版EC DIFF测试</font></div> -->
					{%/if%}
					{%if $run_type=="newolddiff\n"%}
                        <!-- <div class="panel-heading"><strong>当前DIFF类型为：</strong><font color="black">比较新旧EC DIFF测试</font></div>-->
                    {%/if%}
					{%if $run_type=="newolddiff\n"%}
                        <!-- <div class="panel-heading"><strong>当前DIFF类型为：</strong><font color="black">比较新版EC DIFF测试和新旧EC DIFF测试</font></div>-->
                    {%/if%}
					<div class="panel-heading">结果概要</div>
					<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:15px;">
                            <tr>
                                <th style="text-align:center;">版本</th>
                                <th style="text-align:center;">EC1使用内存</th>
                                <th style="text-align:center;">EC2使用内存</th>
								<th style="text-align:center;">EC1包处理速度</th>
								<th style="text-align:center;">EC2包处理速度</th>	
                    			<th style="text-align:center;">EC1出core数量</th>
								<th style="text-align:center;">EC2出core数量</th>
								<th style="text-align:center;">输出包数量</th>
                            </tr>
							
								{%if $run_type=="consistentdiff\n"%}
								<tr>
								<td>新EC1</td>
								<td>{%$ec1_new_memory_first%}</td>
								<td>{%$ec2_new_memory_first%}</td>
								<td>{%$ec1_new_speed_first%}</td>
								<td>{%$ec2_new_speed_first%}</td>
								<td>{%$ec1_core_num_first%}</td>
								<td>{%$ec2_core_num_first%}</td>
								<td>{%$new_output_pack_num_first%}</td>
								</tr>
								<tr>
                                <td>新EC2</td>
                                <td>{%$ec1_new_memory_second%}</td>
                                <td>{%$ec2_new_memory_second%}</td>
                                <td>{%$ec1_new_speed_second%}</td>
                                <td>{%$ec2_new_speed_second%}</td>
                                <td>{%$ec1_core_num_second%}</td>
                                <td>{%$ec2_core_num_second%}</td>
								<td>{%$new_output_pack_num_second%}</td>
                                </tr>
								{%/if%}

								{%if $run_type=="newolddiff\n"%}
                                <tr>
                                <td>旧EC</td>
                                <td>{%$ec1_old_memory_first%}</td>
                                <td>{%$ec2_old_memory_first%}</td>
                                <td>{%$ec1_old_speed_first%}</td>
                                <td>{%$ec2_old_speed_first%}</td>
                                <td>{%$ec1_old_core_num_first%}</td>
                                <td>{%$ec2_old_core_num_first%}</td>
                                <td>{%$old_output_pack_num_first%}</td>
                                </tr>
                                <tr>
                                <td>新EC</td>
                                <td>{%$ec1_new_memory_first%}</td>
                                <td>{%$ec2_new_memory_first%}</td>
                                <td>{%$ec1_new_speed_first%}</td>
                                <td>{%$ec2_new_speed_first%}</td>
                                <td>{%$ec1_new_core_num_first%}</td>
                                <td>{%$ec2_new_core_num_first%}</td>
                                <td>{%$new_output_pack_num_first%}</td>
                                </tr>
                                {%/if%}
								{%if $run_type=="both\n"%}
                                <tr>
                                <td>旧EC</td>
                                <td>{%$ec1_old_memory_first%}</td>
                                <td>{%$ec2_old_memory_first%}</td>
                                <td>{%$ec1_old_speed_first%}</td>
                                <td>{%$ec2_old_speed_first%}</td>
                                <td>{%$ec1_old_core_num_first%}</td>
                                <td>{%$ec2_old_core_num_first%}</td>
                                <td>{%$old_output_pack_num_first%}</td>
                                </tr>
                                <tr>
                                <td>新EC1</td>
                                <td>{%$ec1_new_memory_first%}</td>
                                <td>{%$ec2_new_memory_first%}</td>
                                <td>{%$ec1_new_speed_first%}</td>
                                <td>{%$ec2_new_speed_first%}</td>
                                <td>{%$ec1_new_core_num_first%}</td>
                                <td>{%$ec2_new_core_num_first%}</td>
                                <td>{%$new_output_pack_num_first%}</td>
                                </tr>
								<tr>
                                <td>新EC2</td>
                                <td>{%$ec1_new_memory_second%}</td>
                                <td>{%$ec2_new_memory_second%}</td>
                                <td>{%$ec1_new_speed_second%}</td>
                                <td>{%$ec2_new_speed_second%}</td>
                                <td>{%$ec1_new_core_num_second%}</td>
                                <td>{%$ec2_new_core_num_second%}</td>
                                <td>{%$new_output_pack_num_second%}</td>
                                </tr>
                                {%/if%}
                        </table>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
					{%if $run_type=="consistentdiff\n"%}
						新版EC1内存图
					{%/if%} 
					{%if $run_type=="newolddiff\n"%}
						新旧EC1内存图
					{%/if%} 
					{%if $run_type=="both\n"%}
						新旧EC1内存图
					{%/if%} 

					</div>
					<div class="panel-body">
						<iframe src="{%$mem1%}" frameborder=0 width="100%" height=400></iframe>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
					{%if $run_type=="consistentdiff\n"%}
						新版EC2内存图
					{%/if%} 
					{%if $run_type=="newolddiff\n"%}
						新旧EC2内存图
					{%/if%} 
					{%if $run_type=="both\n"%}
						新旧EC2内存图
					{%/if%} 
					</div>
					<div class="panel-body">
						<iframe src="{%$mem2%}" width="100%" height=400 frameborder=0></iframe>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						结果分析
					</div>
					<table width="100%" class="table table-bordered table-striped">
						<tr>
							<th>Diff类型</th>
							<th>Diff Id</th>
							<th>详情</th>
					{%if $run_type=="consistentdiff\n"%}
						<tr>
							<td>一致性diff</td><td>{%$consistent_diff_id%}</td><td><a href="index.php?r=diff/resultanalysis&diffid={%$consistent_diff_id%}">查看详情</a></td>
						</tr>
					{%/if%}	
					{%if $run_type=="newolddiff\n"%}
						<tr>
							<td>新旧版本diff</td><td>{%$newold_diff_id%}</td><td><a href="index.php?r=diff/resultanalysis&diffid={%$newold_diff_id%}">查看详情</a></td>
						</tr>
					{%/if%}
					{%if $run_type=="both\n"%}
						<tr>
							<td>新旧版本diff</td><td>{%$newold_diff_id%}</td><td><a href="index.php?r=diff/resultanalysis&diffid={%$newold_diff_id%}">查看详情</a></td>
						</tr>
						<tr>
							<td>一致性diff</td><td>{%$consistent_diff_id%}</td><td><a href="index.php?r=diff/resultanalysis&diffid={%$consistent_diff_id%}">查看详情</a></td>
						</tr>
					{%/if%}
					</table>
				</div>
				<div class="panel panel-success">
					<div class="panel-heading">其他信息</div>
					<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:15px;">
						{%if $run_type=="consistentdiff\n"%}
							<tr>
								<td><b>输入包数量</b></td>
								<td>{%$input_pack_num%}</td>
							</tr>
							<tr>
                                <td><b>主机名称</b></td>
                                <td>{%$host_name%}</td>
                            </tr>
							<tr>
                                <td><b>运行路径</b></td>
                                <td>{%$run_path%}</td>
                            </tr>
							<tr>
                                <td><b>新EC1输出包地址</b></td>
                                <td>{%$new_ec_output_first%}</td>
                            </tr>
                            <tr>    
                                <td><b>新EC2输出包地址</b></td>
                                <td>{%$new_ec_output_second%}</td>
                            </tr>   
						{%/if%}
						{%if $run_type=="newolddiff\n"%}
							<tr>
                                <td><b>输入包数量</b></td>
                                <td>{%$input_pack_num%}</td>
                            </tr>
							<tr>
								<td><b>DIFF 类型</b></td>
								<td>{%$run_type%}</td>
							</tr>
							<tr>
                                <td><b>主机名称</b></td>
                                <td>{%$host_name%}</td>
                            </tr>
                            <tr>
                                <td><b>运行路径</b></td>
                                <td>{%$run_path%}</td>
                            </tr>
                            <tr>
                                <td><b>旧EC输出包地址</b></td>
                                <td>{%$old_ec_output_first%}</td>
                            </tr>
                            <tr>
                                <td><b>新EC输出包地址</b></td>
                                <td>{%$new_ec_output_first%}</td>
                            </tr>
                     	 {%/if%}
                      	 {%if $run_type=="both\n"%}
							<tr>
                                <td><b>输入包数量</b></td>
                                <td>{%$input_pack_num%}</td>
                            </tr>
							<tr>
                                <td><b>主机名称</b></td>
                                <td>{%$host_name%}</td>
                            </tr>
                            <tr>
                                <td><b>运行路径</b></td>
                                <td>{%$run_path%}</td>
                            </tr>
                            <tr>
                                <td><b>旧EC输出包地址</b></td>
                                <td>{%$old_ec_output_first%}</td>
                            </tr>	
							<tr>
                                <td><b>新EC1输出包地址</b></td>
                                <td>{%$new_ec_output_first%}</td>
                            </tr>
                            <tr>
                                <td><b>新EC2输出包地址</b></td>
                                <td>{%$new_ec_output_second%}</td>
                            </tr>
						{%/if%}
					</table>
				</div>
			</div>
			<!--END RIGHT CONTENT-->
		</div>
	</div>
</div>
{%$this->endContent()%}
<script>
/*	var temp=$('#mem1').html();
	var str1=temp.replace("&lt;","\<");
	var str2=temp.replace("&gt;","\>");
	var str2=temp.replace("\n","<br>");	
	console.log(str2);
	mem1.innerhtml=str2;*/
</script>
