#!/bin/bash

source ~/.bashrc

MYSQL="mysql"
HOST="10.94.50.19"
PORT="3306"
USER="root"
PASSWORD="521aladdin"

LOCAL_SCRIPT="/home/work/ec_test_service/script"
#MACHINE_LIST="${LOCAL_SCRIPT}/enviroment/machine.list"
MACHINE_LIST="/home/work/local_ecplatform/remote_dis_machine_script/enviroment/machine.list"

REMOTE_BASE_PATH="/home/spider/remote_ecplatform/"
REMOTE_RUN_MACHINE_DEFAULT_CODE_PRODUCT_DATA_DEFAULT="${REMOTE_BASE_PATH}/script/remote_run_machine_default_code_product_data_default.sh"

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN: $1 => error msg
function exit_if_error() {
    local pipestatus="${PIPESTATUS[*]}"
	local error_pipe=`echo "${pipestatus}" | awk '{
		if (NF > 1) {
			for (i = 1; i <= NF; ++i) {
				if ($i != 0) {
					print i;
					exit 0;
				}
			}
		}
		else if (NF == 1) {
			if ($NF != 0) {
				print "1";
				exit 0;
			}
		}
		print "0";
	}'`
	local error_msg="$1"

	if [ ${error_pipe} -ne 0 ];then
        echo "[FATAL] ${error_msg} [PIPESTATUS=${pipestatus}]"
        #if [ ! -z ${EMAIL} ];then
		#	echo "[FATAL] ${error_msg} [PIPESTATUS=${pipestatus}]" | mail -s "[FATAL] `basename $0` failed!" ${EMAIL}
        #fi
		exit 1
	fi
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN: $1 => input string
function assert_string_is_not_empty() {
	local string=$1
	if [[ ${string}"x" == "x" ]];then
        echo "[FATAL] string is empty"
        exit 1
    fi
}


##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => path
function clear_path_content(){
    local path=$1
    if [ -d ${path} ];then
         rm -rf ${path}/*
         exit_if_error "rm -rf ${path}/* failed"
     else
         mkdir -p  ${path}
         exit_if_error "mkdir -p  ${path} failed"
     fi
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN: $1 => dir name
function assert_local_dir_or_file_exist() {
	if [ -d $1  -o -f $1 ];then
#        echo "local dir or file exist"
		continue
    else
        echo "[FATAL] local dir or file "$1"  should exist!"
        exit 1
    fi
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN: $1 => file name
function assert_local_file_exist() {
	if [ ! -f $1 ];then
        echo "[FATAL] local file "$1" does not exist!"
        exit 1
    fi
}


##! @AUTHOR:
##! @VERSION: 1.0
function find_free_machine() {
    machine=""
    while [ ${machine}"x" == "x" ]
    do
        sleep 27
        machine=`cat ${MACHINE_LIST} | awk -v yes="yes" '{ if ($2==yes) {print $1} }' | awk '{ if(NR==1){print $1} }'`
    done
 
    cat ${MACHINE_LIST} |awk -v machine_tmp=${machine} '{ if(machine_tmp==$1){print $1" ""no"" "$3} else {print $1" "$2" "$3} }'>${MACHINE_LIST}.tmp
    cat ${MACHINE_LIST}.tmp > ${MACHINE_LIST}
    
    password=""
    password=`cat ${MACHINE_LIST} |awk -v machine_tmp=${machine} '{ if(machine_tmp==$1){print $3} }'`
    assert_string_is_not_empty ${password}
}

##! @AUTHOR:
##! @VERSION: 1.0
function run() { 
    expect -c "
    set timeout -1;

    spawn ssh ${machine} sh  ${REMOTE_RUN_MACHINE_DEFAULT_CODE_PRODUCT_DATA_DEFAULT} -n $new_code_version -o $old_code_version -t $platform_data_type -d $platform_data_num -i $task_id -p ${ec_type} -A ${newolddiff} -B ${newdiff} -C ${olddiff} -D ${memory} -E ${speed} -F ${valgrind}
    expect {
    \"*yes/no*\" {send \"yes\r\"; exp_continue}
    \"*password*\" {send \"${password}\r\";}
    }
    expect eof;"
}


##! @AUTHOR:
##! @VERSION: 1.0
function free_machine() {
    cat ${MACHINE_LIST} |awk -v machine_tmp=${machine} '{ if(machine_tmp==$1){print $1" ""yes"" "$3} else {print $1" "$2" "$3} }' >${MACHINE_LIST}.tmp
    cat ${MACHINE_LIST}.tmp > ${MACHINE_LIST}
}

##! @AUTHOR:
##! @VERSION: 1.0
function start_process() {
	echo -e "***------------***"	
	echo "[START] find_free_machine"
    find_free_machine
	if [ $? -ne 0 ];then
	  echo "[END] find_free_machine failed"
	  exit 1
	else 
	  echo "[END] find_free_machine success"
	fi
# exit_if_error "find_free_machine failed"
	
	echo -e "***------------***\n"	
	echo -e "***------------***"	
	echo "[START] run"
    run 
	if [ $? -ne 0 ];then
	  echo -e "\n[END] run failed"
	  exit 1
	else 
	  echo -e "\n[END] run success"
	fi
#    exit_if_error " run failed"

	echo -e "***------------***\n"	
	echo -e "***------------***"	
	echo "[START] free_machine"
    free_machine
#    exit_if_error "free_machine failed"
	if [ $? -ne 0 ];then
	  echo "[END] free_machine failed"
	  exit 1
	else 
	  echo "[END] free_machine success"
	fi
	echo -e "***------------***"	
}


##! @AUTHOR:
##! @VERSION: 1.0
function update_mysql() { 
    HOSTNAME=${machine##*@}
    local result=$1
    if [ $result -eq 0 ];then
        echo -e "use project_ktv; update LocalRun set STATUS='done',RUN_RESULT='ftp://$HOSTNAME:${REMOTE_BASE_PATH}/workspace/platform_common/${task_id}/result.tar.gz' where TASK_ID=${task_id}" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} 
        exit_if_error "use project_ktv; update LocalRun set STATUS='done',RUN_RESULT='ftp://$HOSTNAME:${REMOTE_BASE_PATH}/workspace/platform_common/${task_id}/result.tar.gz' where TASK_ID=${task_id} failed" 
    elif [ $result -eq 1 ];then
        echo -e "use project_ktv; update LocalRun set STATUS='fail' where TASK_ID=${task_id}" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} 
        exit_if_error "use project_ktv; update LocalRun set STATUS='fail' where TASK_ID=${task_id} failed" 
    fi
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => script name
function Usage() {
    local name=$1
    echo "Usage: $name  -n <new_code_version> -o <old_code_version> -t <platform_data_type> -d <platform_data_num> -i <task_id> -p <ec_type> -A <newolddiff> -B <newdiff> -C <olddiff> -D <memory> -E <speed> -F <valgrind>   [-h]"
    echo "Ex: $name -n 3.0.1.1 -o 3.0.2.0 -t 1 -d 10w  -i 30 -p 1 -A 1 -B 1 -C 1 -D 1 -E 1 -F 1"
}

#----------------main----------------------#
while getopts "hn:o:t:d:i:p:A:B:C:D:E:F:" opt
do
    case $opt in
        n) 
            new_code_version=$OPTARG
            ;;
        o)  
            old_code_version=$OPTARG
            ;; 
        t)  
            platform_data_type=$OPTARG
            ;; 
        d) 
            platform_data_num=$OPTARG
            ;;
        i) 
            task_id=$OPTARG
            ;;
        p) 
            ec_type=$OPTARG
            ;;
        A) 
            newolddiff=$OPTARG
            ;;
        B) 
            newdiff=$OPTARG
            ;;
        C) 
            olddiff=$OPTARG
            ;;
        D) 
            memory=$OPTARG
            ;;
        E) 
            speed=$OPTARG
            ;;
        F) 
            valgrind=$OPTARG
            ;;
        h)
            Usage $0
            exit 0
            ;;
        *)
            echo "[FATAL] do not support such parameter"
            Usage $0
            exit 1
            ;;
    esac
done

if [ ${new_code_version}"x" == "x" -o ${old_code_version}"x" == "x" -o ${platform_data_type}"x" == "x" -o ${platform_data_num}"x" == "x" -o ${task_id}"x" == "x" -o ${ec_type}"x" == "x" -o ${newolddiff}"x" == "x" -o ${newdiff}"x" == "x" -o ${olddiff}"x" == "x" -o ${memory}"x" == "x" -o ${speed}"x" == "x" -o ${valgrind}"x" == "x" ];then
    Usage $0
    exit 1
fi

start_time=`date +%Y:%m:%d-%H:%M:%S`
start_process
#result=$?
#update_mysql $result
end_time=`date +%Y:%m:%d-%H:%M:%S`
echo $start_time 
echo $end_time

exit 0
