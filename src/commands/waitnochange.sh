#!/bin/bash
NOAH_PATH="/home/work/platform_dc/noah"
STATUS_FILE="noah"
TASK_ID=$1
STATUS_FILE="noah_${TASK_ID}"
INSTANCEID=`less ${NOAH_PATH}/noah_${TASK_ID}.txt |awk '{split($0,a,"instanceId:");print a[2]}' |awk '{print $1}'`
if [ $? == 0 ]
then
    curl "http://noah.baidu.com/datadist/Api/GetInstanceDetail?instanceId=${INSTANCEID}" >${NOAH_PATH}/${STATUS_FILE}
	STATUS=`less ${NOAH_PATH}/${STATUS_FILE} | awk -F ':' '{print $2}' |awk -F ',' '{print $1}'`
	if [ ${STATUS}"x" == "truex" ]
	then
	    echo "0"
	else
	    echo "1"
	fi
fi
	
