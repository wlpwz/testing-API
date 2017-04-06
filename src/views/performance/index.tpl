<!--script src="/static/js/jquery.min.js"></script-->
<!--script src="/static/js/bootstrap.min.js"></script-->
<div class="container">
	<div class="row">
			<div class="col-md-10">
                <div class="head_line">
                    <ul class="breadcrumb">
                        <li>性能平台</li> 
                        <li class="active">性能平台任务提交</li> 
                    </ul>   
                </div>
                <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
                    <h4>获取性能指标的方法</h4> 
                    <ol style="list-style:none">
                        <li><i class="fa fa-star"><strong>top 方法</strong></i>: 直接在shell下运行以下命令<br>
                        <ul class="highlight">
                        <span class="err">
                        top -b -d 10 | awk '$12=="程序名称"{sub(/[\r\n]+/, "");print strftime("%Y%m%d %H:%M:%S"), $1, $5, $6, $7, $9, $10, $12; fflush()} '>> ./程序名称.log
                        </span>
                        </ul>
                        </li>
						
						<li><i class="fa fa-star"><strong>ps 方法</strong></i>: 将下列代码制作成脚本，运行脚本，参数为程序的名称
						<p>
							<code>memcpu.sh</code>
						</p>
						<ul class="highlight">
						<span class="err">
						#!/bin/bash<br>
						module_name=$1<br>
						while true;do<br>
						ps aux |grep ${module_name} | awk '{if($NF~'${module_name}'".conf")print strftime("%Y%m%d %H:%M:%S",systime()),$3,$4,$5,$6}' >> ${module_name}.log<br>
						sleep 10<br>
						done 
						</span>
						</ul>
						</li>
						
						<li><i class="fa fa-star"><strong>pidstat使用方法</strong></i>: 直接在shell下运行以下命令<br>
						<ul class="highlight">
						<span class="err">
						pidstat -r -p 指定进程 -u 2 >> ./程序名称.log<br>
						参数说明：<br>
						-u:cpu使用情况统计;-r:内存使用情况统计;-p:针对特定进程统计;数字:指定采样周期.<br>
						注：加-I选项，获取的是每核cpu使用情况。
						
						</span>
						</ul>
						</li>
						
                        <li><i class="fa fa-star"><strong>qps性能获取方法</strong></i>: 直接在shell下运行以下命令<br>
                        <ul class="highlight">
                        <span class="err">
							qps性能文件格式为：第一列时间，第二列为性能值。文件没有空行且第一行就为时间和性能的数值。
						</span>
                        </ul>
                        </li>
                    </ol>
                </div> 
				<div class="panel panel-default">
					<div class="panel-heading">任务提交</div>
					<table class="table table-bordered" style="text-align:left;font-size:14px;">
						<tr>
							<td >任务名</td>
							<td width="90%">
							    <input type="text" id="task_name" name="task_name" style="width:360px" maxLength=100/>
							</td>
						</tr>
						<tr>
							<td>mem&cpu性能指标</td>
							<td width="90%">
							    <input type="text" id="data_path" name="data_path" style="width:500px" placeholder="这里填写mem&cpu性能指标的ftp地址"/>
							    <input type="radio" name="method" id="top_method" value="top_method" checked onchange="" onclick="">
							    <font>top 方法</font>
							    <input type="radio" name="method" id="ps_method" value="ps_method" checked onchange="" onclick=""> 
							    <font>ps -aux方法</font>
								<input type="radio" name="method" id="pidstat_method" value="pidstat_method" checked onchange="" onclick="">
								<font>pidstat方法</font>
							</td>
						</tr>
						<tr>
							<td>qps性能指标</td>
							<td width="90%">
								<input type="text" id="data_path_qps" name="data_path_qps" style="width:500px" placeholder="这里填写qps性能指标的ftp地址"/>
							</td>
						</tr>
						<tr>
							<td width="10%">数据负责人</td>
							<td>
							    <input type="text" id="data_user" name="data_user" style="width:360px" maxLength=30 />
							</td>
						</tr>
						<tr>
							<td>备注</td>
							<td>
							<input type="text"  id="comment" name="comment" style="width:500px;">
							</td>
						</tr>
					</table>
				</div>
				<h4 class="text-success"><button type="button" class="btn btn-primary" style="color: black;background-color: rgba(255, 255, 240, 0.05);margin-left: 400px;margin-top: 20px;" id="submit_task">提交任务</button></h4>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" SRC="static/js/performance.js"></script>
