<?php
        $r['topic'] = "diff";
        $this->beginContent('/layouts/main',array('topic'=>$r));
?>
<div class="container">
<br/>




<div class="col-md-2" id="myScrollspy">
    <div class="list-group">
	    <B class="list-group-item " style="background-color:#F5F5F5">结果分析</B>
		<a href="#summery" class="list-group-item active"><?php $field=split("&&",$file_name); $item_name=split(",",$field[0]);echo $item_name[count($item_name) - 1]?>PV_DETAIL结果详情</a>
	</div>  
</div>


<div class="col-md-10">

<form id='form'>
<div class="head_line">
	<ul class="breadcrumb">
		<li><a href="index.php?r=ecTask/diffmission">结果分析任务列表</a></li>
		<li>结果分析详情</li> 
		<li class="active">pv_detail diff结果</li> 
	</ul>   
</div>
<?php
	$linevalues=explode("\n",$ec_diff_pvdetail_read);
	//$key_count=$linevalues[0];
?>
	<table width="100%">
       <tr>
			<td>
			<div class="panel panel-default">	
    		<div class="panel-heading"><b>PV_DETAIL差异 </b>
			</div>
            <table class="table table-bordered table-striped" width="100%">
				<thead>
					<tr>
						<th width="30%">
							<div align="left"><b>URL</b></div>
						</th>
						<th width="70%" colspan="2">
						<?php
							$url=$linevalues[0];
							echo "<div align=\"left\"><a href=\"http://".$url."\" target=\"_blank\">".$url."</a></div>\n";
						?>
						</th>
					</tr>
				</thead>
				<tbody id="item_data">
						<?php
							$keyvalue1=explode("\t",$linevalues[1]);
							$keyvalue2=explode("\t",$linevalues[2]);
							$kv_count=count($keyvalue1);
							$kv_count1 = count($keyvalue2);
							$dict=[];
							$dict1=[];
							for($ii=0;$ii<$kv_count;$ii++)
		    				{
								$words1=explode(":",$keyvalue1[$ii]);
								$dict[$words1[0]] = $words1[1];
							}
							for ($ii=0;$ii<$kv_count1;$ii++)
							{
								$words2=explode(":",$keyvalue2[$ii]);
								$dict1[$words2[0]] = $words2[1];
							}
							while(list($key,$val)= each($dict)) {
								if (array_key_exists($key,$dict1))
								{
									if ($val == $dict1[$key])
									{
										echo "<tr>\n<td><div align=\"left\"><b>".$key."</b></div></td>\n";
										echo "<td width=\"35%\"><div align=\"left\">".$dict[$key]."</div></td>\n";
										echo "<td width=\"35%\"><div align=\"left\">".$dict1[$key]."</div></td></tr>\n";
									}
									else
									{
										echo "<tr>\n<td><div align=\"left\"><font color=\"red\"><b>".$key."</b></font></div></td>\n";
										echo "<td width=\"35%\"><div align=\"left\"><font color=\"red\"><b>".$dict[$key]."</b></font></div></td>\n";
										echo "<td width=\"35%\"><div align=\"left\"><font color=\"red\"><b>".$dict1[$key]."</b></font></div></td></tr>\n";
									}
								}
								else
								{
										echo "<tr>\n<td><div align=\"left\"><font color=\"blue\"><b>".$key."</b></font></div></td>\n";
										echo "<td width=\"35%\"><div align=\"left\"><font color=\"blue\"><b>".$dict[$key]."</b></font></div></td>\n";
										echo "<td width=\"35%\"><div align=\"left\"><font color=\"blue\"><b>"."</b></font></div></td>\n";
								}
							}
							while (list($key,$val) = each($dict1)){
								if (!array_key_exists($key,$dict))
								{
										echo "<tr>\n<td><div align=\"left\"><font color=\"red\"><b>".$key."</b></font></div></td>\n";
										echo "<td width=\"35%\"><div align=\"left\"><font color=\"red\"><b>"."</b></font></div></td>\n";
										echo "<td width=\"35%\"><div align=\"left\"><font color=\"red\"><b>".$dict1[$key]."</b></font></div></td>\n";
								}
							
							}
								//echo "<td width=\"".$unit_width."%\"><div align=\"center\"><b>".$headwords[$ii]."</b></div></td>\n";

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
