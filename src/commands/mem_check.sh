#!/bin/bash





hostname=$1
password=$2
pid=$3
task_id=$4
ec_type=$5

mkdir -p /home/work/LibPP/EC_MONITOR/$task_id;
#>/home/work/LibPP/EC_MONITOR/$task_id/$ec_type.txt
sleep 5
while [ 1 ]
do
   result=` curl  "http://cq01-testing-ps7161.cq01.baidu.com:8911/?r=ecTask/memoryMonitorAPI&hostname=$hostname&password=$password&pid=$pid&task_id=$task_id" `
   if [ x$result = x"" ]
   then
		break;
   fi
   echo $result >> /home/work/LibPP/EC_MONITOR/$task_id/$ec_type.txt
   sleep 30
done
