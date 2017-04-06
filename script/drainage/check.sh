#!/bin/bash

function fill_content() {
	sed -i.nofill \
	-e 's/\$id/'$1'/' \
	-e 's/\$dtype/'$2'/' \
	-e 's/\$dest/'$3'/' \
	-e 's/\$port/'$4'/' \
	-e 's/\$start_t/'"$5"'/' \
	-e 's/\$fifo/'$6'/' mail_template.html
	mv mail_template.html mail.html
	mv mail_template.html.nofill mail_template.html
}

function set_db_var() {
	ID=$1
	PID=$2
	NAME=$3
	TYPE=$4
	DEST=$5
	PORT=$6
	START="$7 $8"
}

# crontab -e
# */15 * * * * cd $HOME/ec_test_service/script/drainage && sh -x check.sh >>check.log 2>&1
#while :
#do
	echo -e "\n[`date`]"
	for disp_name in `./op.sh get_active_disp`
	do
		fifos=`./op.sh get_fifo - $disp_name`
		for fifo in $fifos
		do
			if [ "$fifo" -gt 8000 ];then
				eval set -- `./op.sh get_info - $disp_name`
				fill_content $1 $4 $5 $6 "$7 $8" $fifo
#			subject=`echo "引流拥堵报警" | base64`
				subject=`python -c "import base64; print base64.b64encode('引流拥堵报警')"`
				cat mail.html | formail -I "MIME-Version:1.0" -I "Content-type:text/html;charset=utf8" -I "Subject:=?utf8?B?$subject?=" | /usr/sbin/sendmail -oi $3@baidu.com
				if [ "$fifo" -gt 8000 ];then
#				pid=`./op.sh get_pid - $disp_name`
#				kill $pid
					kill $2
					./op.sh set_end - $disp_name
				fi
			fi
		done
	done
#	sleep 900
#done
