#!/bin/bash

if [ $# -lt 5 ];then
	echo "args less than 4!"
	exit 1
fi

logfile=op.log

channel_name=$1
disp_name=$2
dest=$3
port=$4
dur_sec=$5

#check arg

echo -e "\n[`date`]run op.sh normal $channel_name $disp_name $dest:$port $dur_sec, log to op.log" |tee -a $logfile
nohup ./op.sh normal $channel_name $disp_name "$dest:$port" $dur_sec >>$logfile 2>&1 &
pid=$!

#check the $pid to run
sleep 3
if [ `ps aux | grep -c "$pid.*op\.sh"` -ne 1 ]; then
	echo "Start dispatcher $disp_name failed!"
	exit 1
fi

echo $pid
