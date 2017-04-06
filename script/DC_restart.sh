#!/bin/bash`

#MYSQL="/home/spider/.jumbo/bin/mysql"
MYSQL="mysql"
HOST="127.0.0.1"
PORT="3306"
USER="root"
PASSWORD="521aladdin"
DATABASE="project_ktv"
DC_DICT_TABLE="dictionary"

DC_DICT_MACHINE="spider@cq7210"
DC_DICT_SCRIPT="/home/spider/platform_dc/script"

TIME=`date +%Y%m%d`

fail_id=`echo -e "use ${DATABASE}; select id from ${DC_DICT_TABLE}  where status=2&&DATE_SUB(NOW(), INTERVAL 3 hour) >= date(time)&&DATE_SUB(NOW(), INTERVAL 1 day) <= date(time)" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} | awk  '{ if (NR>1) {print $1}}' | awk BEGIN{RS=EOF}'{gsub(/\n/," ");print}'`

string1=`tail -n1 ./waring_log/DC_restart_data | awk '{print $0}'`
string2=`tail -n2 ./waring_log/DC_restart_data | head -n1 | awk '{print $0}'`
string3=`tail -n3 ./waring_log/DC_restart_data | head -n1 | awk '{print $0}'`

for i in ${fail_id[@]}
do
	~/ci/lib/baselib/bin/go ${DC_DICT_MACHINE} "ps -ef | grep 'dc_dict.sh' | grep ${i} | kill -9 $2; cd /home/spider/platform_dc/script&&nohup sh -x dc_dict.sh -t ${i} &>/home/spider/platform_dc/script/../log/${i} &"
done


if [ "${fail_id}" != "${string1}" ] && [ -n "${fail_id}" ] 
then
	string=" 提醒：下列这些任务已进行重启\n".${fail_id}

	( echo -e "subject: DC_restart_warning \n"; echo "${string}" )| /usr/sbin/sendmail -f liuwenli@baidu.com -t liuwenli@baidu.com yangyanhong@baidu.com -u "DC_restart_warning"

	#python /home/work/ec_test_service/script/DC_phone.py ${fail_id} 
fi

#echo ${fail_id} ${string1} ${string2} ${string3}

if [ "${fail_id}" = "${string1}" ] && [ "${fail_id}" = "${string2}" ] && [ "${fail_id}" != "${string3}" ] && [ -n "${fail_id}" ]
then
	python /home/work/ec_test_service/script/DC_phone.py ${fail_id}
fi

if [ -n "${fail_id}" ]
then
	echo ${fail_id} >> ./waring_log/DC_restart_data
fi
