<?php
    $DIFF_RESULT_PATH="/home/work/LibPP/DIFF_RESULT";
    $diff_id=22;
    //public static $DIFF_SHELL_PATH="/home/work/ec_test_service/src/commands";
    //grep links
	$key="t\.jsnk\.com\.cn/dcxyc/";
    $cmd_grep = "grep "."'\[url=".$key."\]' ".$DIFF_RESULT_PATH."/".$diff_id."/test";
	$grep_result = shell_exec($cmd_grep);
	$array1=explode("\n",$grep_result);
	$array1_num = count($array1);
    for($i=0;$i<$array1_num-1;$i++)
		{
			$attr[$i] = explode("][",$array1[$i]);
            //delete the last "]"
			$attr[$i][count($attr[$i])-1]=substr($attr[$i][count($attr[$i])-1],0,strlen($attr[$i][count($attr[$i])-1])-1);
		  	for($j=0;$j<count($attr[$i]);$j++)
				echo $attr[$i][$j].";";
            echo "\n";
		}
 ?>
