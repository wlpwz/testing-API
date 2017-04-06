#!/bin/bash
cd /home/work/ec_test_service/script/dictrace
#get_hosts_by_path BAIDU_PS_spider_cir_ddc >server_list
while [ 1 ]
do
	get_hosts_by_path BAIDU_PS_spider_cir_ddc >server_list
	if [ $? -eq 0 ]
	then
		break
	fi
done
week=`date +%w -d '-1 hours'`
hour=`date +%H -d '-1 hours'`
a=$1
python pat.py "pat" "cat ../log/$week/${hour}.monitor | egrep '${a}'" "60" > viplist.txt
