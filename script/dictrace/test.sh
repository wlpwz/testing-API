#!/bin/bash
while [ 1 ]
do
get_hosts_by_path BAIDU_PS_spider_cir_ddc >server_list_new
result=`echo $?`
echo $result
if [ ${result} -eq 0 ]
then
	break
fi
done
echo "sfadfasdfa"
