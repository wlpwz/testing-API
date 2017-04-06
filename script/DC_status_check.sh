#!/bin/bash

#MYSQL="/home/spider/.jumbo/bin/mysql"
MYSQL="mysql"
HOST="127.0.0.1"
PORT="3306"
USER="root"
PASSWORD="521aladdin"
DATABASE="project_ktv"
DC_DICT_TABLE="dictionary"

TIME=`date +%Y%m%d`

fail_id=`echo -e "use ${DATABASE}; select id from ${DC_DICT_TABLE}  where status=2&&DATE_SUB(NOW(), INTERVAL 1 hour) >= date(time) && DATE_SUB(NOW(), INTERVAL 2 day) <= date(time)" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} | awk  '{ if (NR>1) {print $1}}' | awk BEGIN{RS=EOF}'{gsub(/\n/," ");print}'` 

#fail_id=`echo -e "use ${DATABASE}; select id from ${DC_DICT_TABLE}  where DATE_SUB(NOW(), INTERVAL 1 hour) >= date(time) && DATE_SUB(NOW(), INTERVAL 2 day) <= date(time)" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} | awk  '{ if (NR>1) {print $1}}' | awk BEGIN{RS=EOF}'{gsub(/\n/," ");print}'` 

#echo ${fail_id}

string1=`tail -n1 ./waring_log/DC_waiting_data | awk '{print $0}'`
#string2=`tail -n2 ./waring_log/restart_data | head -n1 | awk '{print $0}'`

if [ "${fail_id}" != "${string1}" ] && [ -n "${fail_id}" ] 
then
	string=" warning 下列这些任务，提交中状态持续超过一个小时，请检查执行是否正确：".${fail_id}

#( echo -e "subject: DC_submit_warning \n"; echo "${string}" )| /usr/sbin/sendmail -f liuwenli@baidu.com -t liuwenli@baidu.com yangyanhong@baidu.com -u "DC_submit_warning"
	( echo -e "subject: DC_submit_warning \n"; echo "${string}" )| /usr/sbin/sendmail -f liuwenli@baidu.com -t liuwenli@baidu.com -u "DC_submit_warning"

fi

if [ -n "${fail_id}" ]
then
	echo ${fail_id} >> ./waring_log/DC_waiting_data
fi
