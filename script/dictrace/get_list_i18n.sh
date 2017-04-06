#!/bin/bash
cd /home/work/ec_test_service/script/dictrace 
week=`date +%w -d '-1 hours'`
hour=`date +%H -d '-1 hours'`
a=$1
python pat_i18n.py "pat" "cat ../log/$week/${hour}.monitor | egrep '${a}'" "600" > viplist_i18n.txt 
