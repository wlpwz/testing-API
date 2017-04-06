#!/bin/bash
cd /home/work/ec_test_service/script/dictrace
get_hosts_by_path BAIDU_PS_spider_cir_ddc >server_list
url=$1
starttime=$2
endtime=$3
#yyyy-mm-dd hh:mm
python pat.py "pat" "sh query_range.sh '$1' '$2' '$3'" "120" > urllist_lzc.txt
