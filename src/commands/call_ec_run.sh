#!/bin/bash

source ~/.bash_profile

source /home/work/ec_test_service/config/ec_test.config


while getopts n:N:o:O:L:l:i: OPTION
do
	case $OPTION in
		n)new_ec_bin=$OPTARG;;
		N)new_ec_conf=$OPTARG;;
		o)old_ec_bin=$OPTARG;;
		O)old_ec_conf=$OPTARG;;
		l)lang=$OPTARG;;
		t)run_type=$OPTARG;;
		i)task_id=$OPTARG;;
		*)exit -1;;
	esac
done


nohup go spider@cq01-testing-ps7161.cq01.baidu.com "cd /home/spider/ci/lib/ps/spider/libpp/ECSysTest;&& sh -x call_ecdistrib_new.sh -n \"$new_ec_bin\" -N \"$new_ec_conf\" -o \"$old_ec_bin\" -O \"$old_ec_conf\" -l \"$lang\" -t \"$run_type\" -i \"$task_id\" " &
