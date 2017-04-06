#!/bin/bash

mysqlr='mysql -uroot -p521aladdin -h cp01-qa-spider004.cp01.baidu.com -P 3306'
db_name="project_ktv"
mimor="$HOME/share/mimo/cmd_ctl"
mimo_port=9000
channel_name=$2
disp_name=$3
host=$4
sec=$5
drainage_conf=$(cd `dirname $0`;pwd)/../../config/drainage.ini

function get_mac_list() {
	echo "<?php
		\$macs = parse_ini_file('$drainage_conf', 'true')['machines'];
		foreach(\$macs['mimo_mac'] as \$mac) {
			echo \$mac.' ';
		}
	?>" | ~/env/php/bin/php
}

function add_disp() {
	suc_add_mac=""
	echo "add begin"
	for mac in `get_mac_list`
	do
		echo "login admin HELLO
		add dispatcher $channel_name $disp_name
		add sender $channel_name $disp_name $host" | $mimor $mac:$mimo_port
		ret=$?
		if [ $ret -eq 0 ]; then
			suc_add_mac="$suc_add_mac $mac"
		else
			echo "add disp to $mac failed!" >&2
			for mac in $suc_add_mac
			do
				echo "login admin HELLO
				remove dispatcher $channel_name $disp_name" | $mimor $mac:$mimo_port
			done
			return $ret
		fi
	done
	echo "add end"
}

function rm_disp() {
	echo "remove begin"
	for mac in `get_mac_list`
	do
		echo "login admin HELLO
		remove dispatcher $channel_name $disp_name" | $mimor $mac:$mimo_port
		if [ $? -ne 0 ]; then
			echo "rm disp from $mac failed!" >&2
		fi
	done
	echo "remove end"
}

function get_mimo_common() {
	if [ -z $1 ]; then
		exit 1;
	fi
	if [ "$channel_name" = "-" ]; then
		dtype=`echo "select dtype from $db_name.tb_drainage where disp_name = '$disp_name'" | $mysqlr | grep -v "dtype"`
		channel_name=`echo "<?php
		\\$type_chns = parse_ini_file('$drainage_conf');
		echo \\$type_chns['$dtype'];
		?>" | php`
	fi
	for mac in `get_mac_list`
	do
		echo "show channel $channel_name"|$mimor $mac:$mimo_port| awk -F'[ =]' '/'$disp_name'/{
			++matched;
			for(i=1; i<=NF; i++) {
				if($i == "'$1'") {
					print $(i+1);
					exit;
				}
			}
			print -1;
		}
	END{
		if(matched == 0)
			print -1;
	}'
	done
}

function get_fifo() {
	get_mimo_common "FIFO"
}

function get_sent() {
	get_mimo_common "Sent"
}

function get_active_disp() {
	echo "select disp_name from $db_name.tb_drainage where end_t > now()" | $mysqlr | grep -v "disp_name"
}

function get_info() {
	echo "select id,pid,applicant,dtype,destination,port,start_t from $db_name.tb_drainage where disp_name = '$disp_name'" | $mysqlr | tail -1
}

function set_end() {
	echo "update $db_name.tb_drainage set end_t = now() where disp_name = '$disp_name'" | $mysqlr
}

if [ "$1" = "normal" ];then
	add_disp
	if [ $? -ne 0 ]; then
		echo "add dispatcher $disp_name failed!" >&2
		exit 1
	fi
	sleep $sec &
	sleeppid=$!
	echo "sleep pid : $sleeppid"
	trap "rm_disp ; [[ $sleeppid ]] && kill $sleeppid;exit" INT TERM
	wait $sleeppid
	rm_disp
#	del_db_item
else
	$@
fi

