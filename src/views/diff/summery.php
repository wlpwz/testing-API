<?php
        $r['topic'] = "diff";
        $this->beginContent('/layouts/main',array('topic'=>$r));
?>
<div class="container">
<br/>


<table width="100%">
<tr>
<td width="50%">
<ul class="nav nav-pills">
  <li><a href="?r=diff/index">EC产出地址提交</a></li>
  <li><a href="?r=diff/resultanalysis&diffid=<?php echo $diff_id; ?>">结果分析</a></li>
  <li class="active"><a href="#">统计信息</a></li>
</ul>
</td>
<td width="50%" align="right">
<?php
    if($diff_id!="")
        echo "<h3 style=\"font-family:'微软雅黑'\"><b>您的结果分析任务号为：<font color=\"red\">".$diff_id."</font></b></h3>";
?>
</td>
</tr> 
</table>      

<form>
	<?php
		 $document_name = split("&&",$doc_name);
    	 $field_name = split("&&",$file_name);
		 $lines=explode("\n",$line);
		 $lines_num=count($lines);
		 /*
		 for($i=0;$i<$lines_num;$i++)
			{ echo $i;	echo $lines[$i]."<br/>";}*/
	?>

	<table width="100%">

       <tr>

            <td>
            <div class="panel panel-info">
				<div class="panel-heading">
					<?php

						echo "<b>summery</b>";
						echo "<b>[ ".$field_name[0]." ]</b>";
					?>
				</div>
				<table class="panel-body table" width="100%">
					<thead>
						<tr>
					 		<td width="50%"><div align="center"><b>new</b></div></td>
                       		<td width="50%"><div align="center"><b>old</b></div></td>
						</tr>
					</thead>
					<tbody>
						<?php
						
					
							for($ii=4;;$ii+=2)
							{	echo "<tr>\n";
								if( strpos($lines[$ii],"--")!==false)
                                    break;
								$words=explode("\t\t",$lines[$ii]);
								
								$words_num=count($words);
								//echo $words_num;
								for($jj=0;$jj<$words_num;$jj++)
									echo "<td><div align=\"center\">".$words[$jj]."</div></td>\n";
								
								echo "</tr>\n";
							}
						//	echo "</tr>\n";
						?>
					</tbody>
				</table>
			</div>
			</td>
		</tr>
	</table>
	<table width="100%">

       <tr>

            <td>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <?php

                        echo "<b>diff</b>";
                        echo "<b>[ ".$field_name[0]." ]</b>";
                    ?>
                </div>
                <table class="panel-body table" width="100%">
                    <thead>
                        <tr>
                            <td width="50%"><div align="center"><b>add</b></div></td>
                            <td width="50%"><div align="center"><b>delete</b></div></td>
                        </tr>
                    </thead>
					 <tbody>
                        <?php

                            
                            for($ii=$ii+4;;$ii+=2)
                            {   echo "<tr>\n";
                                if( strpos($lines[$ii],"--")!==false)
                                    break;
                                $words=explode("\t\t",$lines[$ii]);

                                $words_num=count($words);
                                //echo $words_num;
                                for($jj=0;$jj<$words_num;$jj++)
                                    echo "<td><div align=\"center\">".$words[$jj]."</div></td>\n";

                                echo "</tr>\n";
                            }
                        //  echo "</tr>\n";
                        ?>
                    </tbody>
                </table>
            </div>
            </td>
        </tr>
    </table>
	

</form>





</div>





<?php $this->endContent(); ?>      
