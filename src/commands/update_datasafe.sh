#!/bin/bash
MYSQLBIN="/home/work/mysql5/bin/mysql"
MYSQLUSER="zhangyi17"
MYSQLPASSWD="123qwe"
MYSQLHOST="st01-wdm-dataware0.st01.baidu.com"
MYSQLPORT=3306
MYSQLDB="data-safe-test"

now=`date "+%Y-%m-%d %H:%M:%S"`
sql="update safe_conf set conf_lasted_update_time=\"${now}\" where conf_id=5502;"
for((i=1;i<=3;i++))
do
    echo $sql | ${MYSQLBIN} -u${MYSQLUSER} -p${MYSQLPASSWD} -h${MYSQLHOST} -P${MYSQLPORT} ${MYSQLDB}

     if [ $? -eq 0 ]
        then
            exit 0;
        fi
    sleep 15;
done
