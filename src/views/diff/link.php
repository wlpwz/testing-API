<?php
	$r['topic'] = "diff";
    $this->beginContent('/layouts/main',array('topic'=>$r));
?>
<div class="container">
<br><br>
<div class="col-md-2" id="myScrollspy">
    <div class="list-group">
	    <B class="list-group-item " style="background-color:#F5F5F5">结果分析</B>
		<a href="#summery" class="list-group-item active"><?php $field=split("&&",$file_name); $item_name=split(",",$field[0]);echo $item_name[count($item_name) - 1]?>结果详情</a>
	</div>  
</div>
<div class="col-md-10">
	<form>
		<?php
        	$document_name = split("&&",$doc_name);
        	$field_name = split("&&",$file_name);
    	?>
					<div class="panel panel-default">
                		<div class="panel-heading">
                    		<?php
								if($document_name[0] == "new_field")
								{
									echo "<b>新增内链</b>";
                        			echo "<b>[ ".$field_name[0]." ]</b>";
								}
								else if($document_name[0] == "miss_field")
            					{
									 echo "<b>丢失内链</b>";
                                     echo "<b>[ ".$field_name[0]." ]</b>";
            					}
								else if($document_name[0] == "diff_field")
								{
                                	 echo "<b>不同内链</b>";
                                     echo "<b>[ ".$field_name[0]." ]</b>";
                                }
                    		?>
                		</div>
			
						<table class="table table-bordered table-striped" width="100%">
                    	<thead>
                        	<tr>
								<?php
									if($document_name[0] == "new_field")
									{
                                    	echo "<td width='50%'><div align='center'><b>new link</b></div></td>";
										echo '<td width="50%"><div align="center"><b>new attribute</b></div></td>';
									}
                                	else if($document_name[0] == "miss_field")
                                	{
										echo "<td width='50%'><div align='center'><b>miss link</b></div></td>"; 
                                    	echo '<td width="50%"><div align="center"><b>miss attribute</b></div></td>';
                            		}
									else if($document_name[0] == "diff_field")
                                	{
                                    	echo "<td width='50%'><div align='left'><b>diff link</b></div></td>";
                                        echo '<td width="25%"><div align="left"><b>new attribute</b></div></td>';
										echo '<td width="25%"><div align="left"><b>old attribute 2</b></div></td>';
                                	}
								?>
                        	</tr>
                    	</thead>
						<tbody>
							<?php
								if($document_name[0] == "new_field" || $document_name[0] == "miss_field")
                                {
            						//link[i]==array1[i]
									//	echo $grep_result;
            						$array1=explode("\n",$grep_result);
           							$array1_num = count($array1);
            						//explode out attributes
            						for($i=0;$i<$array1_num-1;$i++)
            						{       
                						$attr[$i] = explode("][",$array1[$i]);
                						//delete the last "]"
                						$attr[$i][count($attr[$i])-1]=substr($attr[$i][count($attr[$i])-1],0,strlen($attr[$i][count($attr[$i])-1])-1);
            						} 
									for($i=0;$i<$array1_num-1;$i++)
									{
										echo "<tr>\n";
                                        echo "<td><div align=\"left\">".$attr[$i][1]."</div></td>\n";
										echo "<td><div align=\"left\">";
										for($j=2;$j<count($attr[$i]);$j++)
										{
												echo $attr[$i][$j];
												echo "<br/>";	
										}
										echo "</div></td>\n";
                                        echo "</tr>\n";
									}                          	
                                }
								else if($document_name[0] == "diff_field")
								{
									$array1 = explode("\n",$grep_result);
									$array1_num = count($array1);
									for($i=0;$i<$array1_num-1;$i++)
									{
										$attr[$i] = explode ("~EOF!",$array1[$i]);
										$str1 = $attr[$i][0];
										$str1=substr($str1,0,strlen($str1)-1);
										$str2 = $attr[$i][1];
										$str2=substr($str2,0,strlen($str2)-1);
										$link1 = explode ("][",$str1);
										$link2 = explode ("][",$str2);
										echo "<tr>\n";
                                        echo "<td><div align=\"left\">".$link1[1]."</div></td>\n";
                                        echo "<td><div align=\"left\">";
                                        for($j=2;$j<count($link1);$j++)
                                        {
                                                if($link1[$j]!=$link2[$j])
													{echo "<font color=\"red\">".$link1[$j]."</font>";}
												else
													echo $link1[$j];
                                                echo "<br/>";
                                        }
                                        echo "</div></td>\n";
										echo "<td><div align=\"left\">";
                                        for($j=2;$j<count($link2);$j++)
                                        {
                                                if($link1[$j]!=$link2[$j])
                                                    {echo "<font color=\"red\">".$link2[$j]."</font>";}
                                                else    
                                                    echo $link2[$j];
                                                echo "<br/>";
                                        }
                                        echo "</div></td>\n";
                                        echo "</tr>\n";
										
									}
									$array2=explode("\n",$grep_result_delete);
									$array2_num=count($array2);
									for($i=0;$i<$array2_num-1;$i++)
									{
										$length=strlen($array2[$i]);
										if ($length < 2)
										  continue;
										$line=substr($array2[$i],1,$length-2);
										$attr1 = explode ("][",$line);
										if (count($attr1) < 2)
										{
											continue;
										}
										echo "<tr>\n";
										$items = explode ("=",$attr1[1]);
										echo "<td>".$items[1]."</td><td></td><td>";
										for ($j=2;$j<count($attr1);$j++)
										{
											echo "<div><font color=red>". iconv("gb18030","utf-8",$attr1[$j])."</font></div>";
										}
										echo "</td></tr>";
									}
									$array3=explode("\n",$grep_result_add);
									$array3_num=count($array3);
									for($i=0;$i<$array3_num-1;$i++)
									{
										$length=strlen($array3[$i]);
										if ($length < 2)
										  continue;
										$line=substr($array3[$i],1,$length-2);
										$attr1 = explode ("][",$line);
										if (count($attr1) < 2)
										{
											continue;
										}
										echo "<tr>\n";
										$items = explode ("=",$attr1[1]);
										echo "<td>".$items[1]."</td><td></td><td>";
										for ($j=2;$j<count($attr1);$j++)
										{
											echo "<div><font color=red>". iconv("gb18030","utf-8",$attr1[$j])."</font></div>";
										}
										echo "</td>";
									}
								}													
							?>
						</tbody>
					</div>
				</td>
			</tr>
		</table>
		
	</form>
	</div>

<?php $this->endContent(); ?>
