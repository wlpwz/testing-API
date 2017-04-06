<?php

		$cmd_result = "~/ci/lib/baselib/bin//go yuanbaolei@cq01-testing-zfqa33.cq01.baidu.com \"sh /home/users/yuanbaolei/LibPP/diff_shell/ec_diff_result.sh /home/users/yuanbaolei/LibPP/ECDiffResult/null/diffpacket_result/summary\"";
		$ec_diff_result=shell_exec($cmd_result);
		echo $ec_diff_result;
		echo $ec_diff_result;
?>
