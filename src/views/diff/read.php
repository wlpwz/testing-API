<?php
        $r['topic'] = "diff";
        $this->beginContent('/layouts/main',array('topic'=>$r));
?>
<div class="container">
<br/>


<!--<table width="100%">
<tr>
<td width="50%">
<ul class="nav nav-pills">
  <li><a href="?r=diff/index">EC产出地址提交</a></li>
  <li><a href="?r=diff/resultanalysis&diffid=<?php echo $diff_id; ?>">结果分析</a></li>
  <li class="active"><a href="#">查看详情</a></li>
</ul>
</td>
<td width="50%" align="right">
        echo "<h3 style=\"font-family:'微软雅黑'\"><b>您的结果分析任务号为：<font color=\"red\">".$diff_id."</font></b></h3>";
?>
</td>
</tr>
</table>
-->
<div class="col-md-2" id="myScrollspy">
    <div class="list-group">
		<B class="list-group-item " style="background-color:#F5F5F5">结果分析</B>
		<a href="#summery" class="list-group-item active"><?php $field=split("&&",$file_name); $item_name=split(",",$field[0]);echo $item_name[count($item_name) - 1]?>结果详情</a>
	</div>  
</div>


<div class="col-md-10">
<form id='form'>
   		<!--	<div class="page-header"> -->
	<table width="100%">
	<tr>
		<td width="40%">
		<ul class="breadcrumb">
		    <li><a href="index.php?r=diff/resultanalysis&diffid=<?php echo $diff_id;?>"><?php echo $diff_id;?>结果首页</a></li>
			<li class="active"><?php $field=split("&&",$file_name); $item_name=split(",",$field[0]);echo $item_name[count($item_name) - 1];?>结果详情</li>
			<br>value1:old;value2:new</br>
		</ul>  
		</td>
    	<td width="60%">
			<div align="right">
			<ul class="pagination">
<?php
	$ec_diff_field_data = split("&&",$ec_diff_read);
	$page_now = split("&&",$page_num);
	$page_before = $page_now[0]-1;
	$page_after = $page_now[0]+1;
	$document_name = split("&&",$doc_name);
	$field_name = split("&&",$file_name);
	$linevalues=explode("\n",$ec_diff_field_data[0]);
	$line_num=count($linevalues);
	$page_count=$linevalues[0];
	
	if($page_count>=2)
	{
		echo "<li><a href=\"?r=diff/read&diffid=".$diff_id."&docname=".$document_name[0]."&filename=".$field_name[0]."&pagenum=1\">首页</a><li>\n";
		if($page_before>=1)
		{
			echo "<li><a href=\"?r=diff/read&diffid=".$diff_id."&docname=".$document_name[0]."&filename=".$field_name[0]."&pagenum=".$page_before."\">«</a><li>\n";
		}
		if($page_now[0]>=5)
		{
			$page_start=$page_now[0]-4;
		}
		else
		{
			$page_start=1;
		}
		if($page_now[0]<=$page_count-5)
		{
			$page_end=$page_now[0]+5;
		}
		else
		{
			$page_end=$page_count;
		}
		for($kk=$page_start;$kk<=$page_end;$kk++)
		{
			if($kk==$page_now[0])
			{
				echo "<li class=\"active\"><a href=\"?r=diff/read&diffid=".$diff_id."&docname=".$document_name[0]."&filename=".$field_name[0]."&pagenum=".$kk."\">".$kk."<span class=\"sr-only\">(current)</span></a><li>\n";
			}
			else
			{
				echo "<li><a href=\"?r=diff/read&diffid=".$diff_id."&docname=".$document_name[0]."&filename=".$field_name[0]."&pagenum=".$kk."\">".$kk."</a><li>\n";
			}
		}
		if($page_after<=$page_count)
		{
			echo "<li><a href=\"?r=diff/read&diffid=".$diff_id."&docname=".$document_name[0]."&filename=".$field_name[0]."&pagenum=".$page_after."\">»</a><li>\n";
		}
		echo "<li><a href=\"?r=diff/read&diffid=".$diff_id."&docname=".$document_name[0]."&filename=".$field_name[0]."&pagenum=".$page_count."\">末页</a><li>\n";
	} 	
?>
	</ul>
	    </div>
		</td>
	</tr>
	</table>
	<!--		</div>-->
	<table width="100%">

       <tr>

			<td>
			<div class="panel panel-default">	
    		<div class="panel-heading">
			<?php 
				if($document_name[0] == "new_field")
				{
					echo "<b>新增项 </b>";
				}
				elseif($document_name[0] == "miss_field")
				{
					echo "<b>丢失项 </b>";
				}
				elseif($document_name[0] == "diff_field")
				{
					echo "<b>不同项 </b>";
				}
				else
				{
					echo "<b>出现错误 </b>";
				}
				echo "<b>[ ".$field_name[0]." ]</b>";
			?>
			</div>
            <table class="table table-bordered table-striped" width="100%">
				<thead>
					<tr>
						<?php
							$headwords=explode("\t",$linevalues[1]);
							$headwords_num=count($headwords);
								$pv_detail_str="pv_detail";
								$pv_detail_flag=strpos($field_name[0],$pv_detail_str);;
		    				if ($pv_detail_flag===false)
							{
								$unit_width=round(20/($headwords_num-1));
								$unit_width_first=100-$unit_width*($headwords_num-1);
							}
							else
							{
								$unit_width=round(20/($headwords_num-1));
								$unit_width_first=92-$unit_width*($headwords_num-1);
							};
							echo "<td width=\"".$unit_width_first."%\"><div align=\"left\"><b>".$headwords[0]."</b></div></td>\n";
							for($ii=1;$ii<$headwords_num;$ii++)
							{
								echo "<td width=\"".$unit_width."%\"><div align=\"left\"><b>".$headwords[$ii]."</b></div></td>\n";
							}
		    				if ($pv_detail_flag!==false)
							{
								echo "<td width=\"8%\"><div align=\"left\"><b>详情</b></div></td>\n";
							}

						?>
					</tr>
				</thead>
				<tbody id="item_data">
						<?php
							for($jj=2;$jj<$line_num;$jj++)
							{
								if($linevalues[$jj]!="")
								{
									$headwords=explode("\t",$linevalues[$jj]);
									$headwords_num=count($headwords);
									
									echo "<tr>\n";
									for($ii=0;$ii<$headwords_num;$ii++)
									{
										if($ii==0)
										{
											echo "<td><div align=\"left\"><a href=\"http://".$headwords[$ii]."\">".$headwords[$ii]."</a></div></td>\n";
										}
										else
										{
                                            //deal with ptdef
											if(strpos($file_name,"ptdef"))
                                            {
												 $words[$ii]=explode(",",$headwords[$ii]);
												 $words_num[$ii]=count($words[$ii]);
											}
                                            //deal with links
											else if(strpos($file_name,"links") && $ii == $headwords_num-1)
                                            {
												$str=urlencode($headwords[0]); 
											    echo "<td>".$headwords[$ii].'</td><td><div align="left"><a href="/?r=diff/links&diffid=' . $diff_id . '&docname=' . $document_name[0] . '&filename=' .$field_name[0] . '&value=' . $str . '&target=_blank">links</a></div></td>'."\n";
											}	
                                            else 
											{
											  	echo "<td><div align=\"left\">".$headwords[$ii]."</div></td>\n";
											}
										}
					
									}
								    //change color
									$ii=1;
									if ($words_num[$ii] >0)
										echo "<td><div align=\"left\">";
									for($m=0;$m<$words_num[$ii];$m++)
									{
										$flag=0;
										for($n=0;$n<$words_num[$ii+1];$n++)
										{
										    											
											if(strcmp($words[$ii][$m],$words[$ii+1][$n])==0)
											{
												$flag=1;
												
												echo $words[$ii][$m];
												echo "<br/>";
												break;
											}
										}
										if($flag==0)
										{	echo "<font color=\"red\">".$words[$ii][$m]."</font>";   echo "<br/>";}
						
									}
								/*	for($x=0;$x<$words_num[$ii];$x++)
                                    {
                                               echo $words[$ii][$x];
                                               echo "<br/>";
                                    }*/
									 echo "</div></td>\n";
		   							//value2 change color
									 if ($words_num[$ii+1] > 0)
										echo "<td><div align=\"left\">";
                                    for($m=0;$m<$words_num[$ii+1];$m++)
                                    {
                                        $flag=0;
                                        for($n=0;$n<$words_num[$ii];$n++)
                                        {

                                            if(strcmp($words[$ii+1][$m],$words[$ii][$n])==0)
                                            {
                                                $flag=1;
                                                
                                                echo $words[$ii+1][$m];
                                                echo "<br/>";
                                                break;
                                            }
                                        }
                                        if($flag==0)
                                        {   
											echo "<font color=\"red\">".$words[$ii+1][$m]."</font>";   echo "<br/>";}
										}
                                
                                     echo "</div></td>\n";
		/*							for($x=0;$x<$words_num[$ii+1];$x++)
                                    {
                                              echo $words[$ii+1][$x];                                                 
                                              echo "<br/>";
                                    }	
									echo "</div></td>\n";*/
		    						if ($pv_detail_flag!==false)
									{
										$kk=$jj-1;
										$url = urlencode($headwords[0]);
										echo "<td><div align=\"left\"><a href=\"?r=diff/pvdetailread&diffid=".$diff_id."&url=".$url."\" target=\"_blank\">详情</a></div></td>\n";
									}
									echo "</tr>\n";
								}
							}
						?>
				</tbody>
			</table> 
			</div>
          </td>
        </tr>
	
       </table>
     </div>
        <br/>
    <hr/>

</form>
</div>
</div>
<script>

</script>

<?php $this->endContent(); ?>
