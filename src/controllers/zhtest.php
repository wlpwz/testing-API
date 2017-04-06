<?php

		$cmd_result = "~/ci/lib/baselib/bin//go yuanbaolei@cq01-testing-zfqa33.cq01.baidu.com \"sh /home/users/yuanbaolei/LibPP/diff_shell/ec_diff_result.sh /home/users/yuanbaolei/LibPP/ECDiffResult/15/diffpacket_result/summary\"";
		$ec_diff_result=shell_exec($cmd_result);
		//echo $ec_diff_result;
		$line_count=0;
		$linevalues=explode("\n",$ec_diff_result);
		$New_flag='NEW_ITEMS';
		$Miss_flag='MISS_ITEMS';
		$Diff_flag='DIFF_ITEMS';
		$flag_result=0;
		foreach($linevalues as $line){
			$New_flag_result=strpos($line,$New_flag);
			$Miss_flag_result=strpos($line,$Miss_flag);
			$Diff_flag_result=strpos($line,$Diff_flag);
			if ($New_flag_result!==false){
				$flag_result=1;
				echo "<!-- New_Items -->\n";
				continue;
			};
			if ($Miss_flag_result!==false){
				$flag_result=2;
				echo "<!-- Miss_Items -->\n";
				continue;
			};
			if ($Diff_flag_result!==false){
				$flag_result=3;
				echo "<!-- Diff_Items -->\n";
				continue;
			};
			//No data clear
			if($line==""){}
			//first line disposal
			elseif($line_count==0){
				++$line_count;
				echo "<!-- First Line -->\n";
				echo "<tr>\n";
				$diffkeyvalue=explode(" ",$line);
				foreach($diffkeyvalue as $keyvalue){
					list($diffkey,$diffvalue)=split('[=]',$keyvalue);
					//echo "<td width=\"12.5%\"><div align=\"center\">".$diffvalue."</div></td>\n";
					echo "<td><div align=\"center\">".$diffvalue."</div></td>\n";
				}
				echo "</tr>\n";
			}
			else{
				++$line_count;
				
				echo "<tr>\n";
				$diffkeyvalue=explode("\t",$line);
                foreach($diffkeyvalue as $keyvalue){
                    if($keyvalue==""){}
					else{
					//echo "<p cc='".$flag_result."'>". $line_count." ".$line."</p>\n";
					echo "<td cc='".$flag_result."'>".$keyvalue."</td>\n";
					}
                }
				echo "</tr>\n";
			}
		}
?>
