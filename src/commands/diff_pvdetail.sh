#!/bin/bash

source ~/.bash_profile

source /home/work/ec_test_service/config/ec_test.config

pack_1=$1
pack_2=$2
result_path=$3
lang=$4

cd $result_path;

mkdir pvdetail;

cat $result_path/diffpacket_result/diff_field/trespassing_field,spider,pv_detail | awk '{if(NR > 1){printf("%s\n",$1)}}'  > pvdetail/url.list


cpacktool -F -k target_url -u pvdetail/url.list pack_1 > pvdetail/pvdetail_1.pack

cpacktool -F -k target_url -u pvdetail/url.list pack_2 > pvdetail/pvdetail_2.pack

if [ x$lang = x"chinenseec" ]
then
	cp -r $PV_CONF_CH/conf ./
	$COMMON_TOOL/mcread2s -d conf -f pagevalue.config -i "pvdetail/pvdetail_1.pack" > pvdetail/pvdetail_1.txt
	$COMMON_TOOL/mcread2s -d conf -f pagevalue.config -i "pvdetail/pvdetail_2.pack" > pvdetail/pvdetail_2.txt
else
	cp -r $PV_CONF_INT/conf ./
	$COMMON_TOOL/mcread2s -d conf -f pagevalue.config -i "pvdetail/pvdetail_1.pack" > pvdetail/pvdetail_1.txt
	$COMMON_TOOL/mcread2s -d conf -f pagevalue.config -i "pvdetail/pvdetail_2.pack" > pvdetail/pvdetail_2.txt
fi


cd pvdetail

sh -x $COMMON_TOOL/diffpvdetailfast.sh pvdetail_1.txt pvdetail_2.txt
 
#### clean

rm pvdetail_1.pack
rm pvdetail_2.pack

