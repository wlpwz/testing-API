#!/bin/bash

CMD_CTL="/home/work/ci/lib/ps/spider/signserver/shell/signserver_simple_deploy/signserver_rebuild_tools/bin"

break_str=`echo -e "list"| ${CMD_CTL}/cmd_ctl cq01-testing-ps7219.cq01:9000 | awk '{if($5==0) print $1}' | awk BEGIN{RS=EOF}'{gsub(/\n/," ");print}' | sed 's/dispatcher_out/eccsf2ec/g' | sed 's/ecc_urgent_out/ec2dc_urgent/g' | sed 's/ecc_nourgent_out/ec2dc_nourgent/g' | sed 's/dc_timedc_out/dc2tf_urgent/g' | sed 's/dc_ddc_out/dc2tf_nourgent/g' | sed 's/dc_tmpdc_out/dc2tf_tmp/g' | sed 's/tf_lbdc_out/tf2lbdc/g' | sed 's/tf_lc_out/tf2lcdc/g' | sed 's/dc_timedc_ccdb/dc2ccdb_urgent/g' | sed 's/dc_time_wdn/dc2wdn_urgent/g' | sed 's/dc_ddc_ccdb/dc2ccdb_nourgent/g' | sed 's/dc_ddc_wdn/dc2wdn_nourgent/g' | sed 's/dc_tmpdc_ccdb/dc2ccdb_tmp/g' | sed 's/dc_tmpdc_wdn/dc2wdn_tmp/g' | sed 's/lbdc_rev_out/lbdc2receiver/g' | sed 's/lcdc_out/lcdc2linkcache/g' | sed 's/dc_case_out/dc2case/g' | sed 's/ec_case_out/ec2case/g' | sed 's/entry_out/entry2dc/g' | sed 's/dispatcher2sf_out/dispatcher2eccsf/g'`

#echo ${break_str} >> ./waring_log/Drainage_break_warning.log

comp_str=`tail -n1 ./waring_log/Drainage_break_data | awk '{print $0}'`

if [ "${break_str}" != "${comp_str}" ]
then
	if [ -n "${break_str}" ] 
	then
		string=" warning 下列引流任务中断，请进尽快进行处理：".${break_str}
		( echo -e "subject: Drainage_break_warning \n"; echo "${string}" )| /usr/sbin/sendmail -f liuwenli@baidu.com -t liuwenli@baidu.com yangyanhong@baidu.com -u "Drainage_break_warning"
	fi
fi

if [ -n "${break_str}" ]
then
	echo ${break_str} >> ./waring_log/Drainage_break_data
fi
