<div class="container">
	<div class="row">
			<div class="col-md-10">
				<div class="head_line">
                    <ul class="breadcrumb">
                        <!--li><i class="fa fa-home" style="font-size:18px"></i> &nbsp;<a href="/">首页</a></li-->
                        <li>词典测试</li> 
                        <li class="active">词典测试结果页面</li> 
                    </ul> 
					<div class="box box-info">
						<li>联系我们：<a target="_blank"  href="baidu://message/?id=杨彦红_eileen">杨彦红</a> &nbsp;&nbsp;&nbsp;&nbsp; <a target="_blank"  href="baidu://message/?id=huangwei16">黄伟</a></li>
						<li>部署效果：<a target="_blank" href="http://wiki.baidu.com/pages/viewpage.action?pageId=112542180">词典部署效果查看方法</a></li>
						<li>只显示近一个月的数据，其他数据请输入任务名称或者负责人名称进行查询</li>
					</div>    
                </div> 
				<form action="?r=dictionary/task" method="post">
					<input type="text" name="find_str">
					<input type="submit" value="查询">
				</form>
				<table id="local_task" class="table table-bordered table-striped table-hover" width="100%" style="text-align:left;font-size:12px;" > 
				<thead>
				<tr style="word-break:break-all;background-color:#d9edf7">
					<th width="5%">ID</th>
					<th width="5%">词典</th>
					<th width="10%">提交时间</th>
					<th width="10%">修改原因</th>
					<!--th>词典版本</th-->
					<th width="5%">负责人</th>
					<!--th width="15%">升级点</th-->
					<!--th width="15%">测试类型</th-->
					<th width="10%">提交方式</th>
					<th width="10%">测试进度</th>
					<th width="15%">执行结果</th>
					<th width="15%">日志</th>
					<th width="15%">部署效果</th>
				</tr>
				</thead>
				<tbody style="font-size:12px">
					<?php
						foreach ($result as $task)
                            {       
                                echo "<tr>"; 
								$id = $task['id'];
                                echo "<td id='task_id' value=$id>$id</td>";
                                echo "<tf>";
                                $dictionary_name=$task['dictionary_name'];
                                echo "<td id='task_dictionary' value=$dictionary_name>$dictionary_name</td>";
                                echo "<tf>";
						        
                                echo "<td>".$task['time']."</td>";
							//	$var=explode(":",$task['source']);
                              //  echo "<td>".$var[1]."</td>";
								echo "<td>".$task['reason']."</td>";
                                echo "<td>".$task['head']."</td>";
                             //   echo "<td>".$task['function_point']."</td>";
								/*
								if($task['method']==0)
									echo "<td>全量</td>";
								if($task['method']==1)
									echo "<td>增量</td>";
								*/
								echo "<td>";
								if($task['is_api']==1)
									echo "API";
								else if($task['is_api']==0)
									echo "Web";
								echo "</td>";
								if($task['status']==1)
									echo '<td>未开始</td>';
								if($task['status']==0)
									echo '<td>联系平台负责人</td>';
								if($task['status']==2)
									echo '<td>进行中</td>';
								if($task['status']==3)
								{
									if(strcmp(Yii::app()->user->name,"yangyanhong")==0 || strcmp(Yii::app()->user->name,"huangwei16")==0 || strcmp(Yii::app()->user->name,"shixi")==0 || strcmp(Yii::app()->user->name,"zhongxiande")==0)
										echo "<td><button class='s1' value=$id>发起上线</button> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <button class='s2' value=$id>仅作测试</button></td>";

									else
										echo '<td>发起上线 | 仅作测试</td>';
								}
								if($task['status']==4)
								{
									if(strcmp(Yii::app()->user->name,"yangyanhong")==0 || strcmp(Yii::app()->user->name,"huangwei16")==0 || strcmp(Yii::app()->user->name,"shixi")==0 || strcmp(Yii::app()->user->name,"zhongxiande")==0)
										echo "<td>1.大数据cover到策略修改</br>2.稳定性测试通过</br><button class='s3' value=$id>QA请确认</button></td>";
									else
										echo "<td>请等待QA请确认</td>";
								}
								if($task['status']==5)
								{
									if(strcmp(Yii::app()->user->name,"yangyanhong")==0 ||strcmp(Yii::app()->user->name,"yangxiaoyun")==0 ||strcmp(Yii::app()->user->name,"huangwei16")==0 || strcmp(Yii::app()->user->name,"shixi")==0 || strcmp(Yii::app()->user->name,"zhongxiande")==0)
										echo "<td>词典测试符合预期</br><button class='s4' value=$id>RD请确认</button></td>";
									else
										echo "<td>请等待RD请确认</td>";
					
								}
								if($task['status']==6)
								{
									if(strcmp(Yii::app()->user->name,"yangyanhong")==0 || strcmp(Yii::app()->user->name,"huangwei16")==0 || strcmp(Yii::app()->user->name,"shixi")==0 || strcmp(Yii::app()->user->name,"zhongxiande")==0)
										echo "<td><button class='s5' value=$id>请部署沙盒环境</button></td>";
									else
										echo "<td>请等待沙盒环境更新</td>";
								}
								if($task['status']==7)
							    {
									if(strcmp(Yii::app()->user->name,"yangyanhong")==0 || strcmp(Yii::app()->user->name,"huangwei16")==0 || strcmp(Yii::app()->user->name,"shixi")==0 || strcmp(Yii::app()->user->name,"zhongxiande")==0)
										echo "<td><button class='s6' value=$id>请部署线上环境</button></td>";
									else
										echo "<td>请等待线上环境更新</td>";
                                }
								if($task['status']==8)
									echo '<td>DC执行失败</td>';
								if($task['status']==9)
									echo '<td>QA确认不通过</td>';
								if($task['status']==10)
									echo '<td>RD确认不通过</td>';
								if($task['status']==11)
									echo '<td>完成测试</td>';
								if($task['status']==12)
									echo '<td>词典生效进行中</td>';
								if($task['status']==13)
									echo '<td>词典文件校验失败</td>';
								if($task['status']==14)
									echo '<td>推送noahdt失败</td>';
								if($task['status']==15)
									echo '<td>完成noah推送</td>';
								if($task['status']==16)
									echo '<td>词典部署成功</td>';
								if($task['status']==17)
									echo '<td>词典部署失败</td>';
								$result=$task['result']; 
								echo "<td><a href='/?r=dictionaryresult/result&taskid=$id' target='_blank'>查看</a></td>";
								echo "<td><a href='/?r=dictionaryresult/showlog&taskid=$id'target='_blank'>查看</a></td>";
								if($task['status']==7 || $task['status']>15)
								{
									$url="http://wiki.baidu.com/pages/viewpage.action?pageId=112542180";
									echo "<td><a href='$url' target='_blank' data-toggle='tooltip' data-placement='top' title='noah结果保留3周'>查看</a></td>";
								}
                                else   
                                    echo "<td>等待环境部署</td>";
								echo "</tr>";
							}
					?>

				</tbody>
				</table>
			</div>
	</div>
</div>
<script type="text/javascript" charset="utf8" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="/static/plugins/dataTable/js/jquery.dataTables.js"></script>
<script type="text/javascript" SRC="static/js/dictionarylist.js"></script>
<script type="text/javascript" charset="utf8" src="/static/plugins/dataTable/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
(function(){
$('#local_task').DataTable({"iDisplayLength": 20,
                            "lengthChange": false,
                            "aaSorting": [[ 0, "desc"]],
                            "bScrollCollapse": true,
                            "bSort": true,
                            "bJQueryUI": true,
                            //"bPaginate": true,
                            "aoColumnDefs": [
								{
 									sDefaultContent: '',
 									aTargets: [ '_all' ]
  								}
							],                                 
                        });
})();
</script>

