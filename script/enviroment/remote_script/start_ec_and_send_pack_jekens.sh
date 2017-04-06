#!ybin/bash

source ~/.bashrc
source ~/.bash_profile

MEMORY_RECORD="/home/spider/remote_ecplatform/script/memory_record.sh"
MEMOEY_STATIC="/home/spider/remote_ecplatform/script/memorystatic.sh"
PROCESS_NAME_KILL="[f]ile_itlg_parse"
PROCESS_NAME_MEMORY="file_itlg_parse"
SPEED_PACK_NUM="20000"

PLATFORM_MACHINE="work@cp01-testing-ps6076.cp01.baidu.com"
password="ps-testing!!!"

MYSQL="mysql"
HOST="10.94.50.19"
PORT="3306"
USER="root"
PASSWORD="521aladdin"

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
		exit 1
	fi
}

##! @AUTHOR:
##! @VERSION: 1.0
function valgrind_start() {
	local module_name=$5
	echo -e "\n"
	echo "[START] valgrind calculate $module_name"
    local start_file_path=$1
    local input_data_path=$2
    local output_data_path=$3
    local mem_file=$4
    
    cd ${start_file_path}
    source env.sh
		
    ps -ef | grep valgrind | awk '{print $2}' | xargs kill -9 >/dev/null 2>&1 
#local valgrind_status="init"
#    nohup  valgrind --tool=memcheck --leak-check=full --show-reachable=yes --log-file=$mem_file ./file_itlg_parser < ${input_data_path} >${output_data_path} &
#   while [ ${valgrind_status}"x" != "x" ]
#    do
#       valgrind_status=`ps -ef | grep [v]algr | awk '{print $2}'|awk '{if (NR==1){a=$1} else {a=a"_"$1} }'END'{print a}'`
#   done 
	valgrind --tool=memcheck --leak-check=full --show-reachable=yes --log-file=$mem_file ./file_itlg_parser < ${input_data_path} >${output_data_path} 
	if [ $? -ne 0 ];then
	  echo "[END] valgrind calculate $module_name failed"
	  exit 1
	else 
	  echo "[END] valgrind calculate $module_name success"
	fi
}

##! @AUTHOR:
##! @VERSION: 1.0
function speed_start() {
	local module_name=$5
	echo -e "\n"
	echo "[START] speed calculate $module_name"
    local start_file_path=$1
    local input_data_path=$2
    local output_data_path=$3
    local speed_file=$4
    
    cd ${start_file_path}
    source env.sh
    
    local start_time=`date +%s`
    ./file_itlg_parser < ${input_data_path} >${output_data_path} 
	if [ $? -ne 0 ];then
	  echo "[END] speed calculate $module_name failed"
	  exit 1
	else 
	  echo "[END] speed calculate $module_name success"
	fi
    local end_time=`date +%s`
	local speed=$(( $SPEED_PACK_NUM/($end_time - $start_time) ))
    echo  $speed > $speed_file
}

##! @AUTHOR:
##! @VERSION: 1.0
function memory_start() {
	local memory_analysis=$5
	echo -e "\n"
	echo "[START] memory calculate $memory_analysis"
    local start_file_path=$1
    local input_data_path=$2
    local output_data_path=$3
    local memory_file=$4
    
    cd ${start_file_path}
    source env.sh

    ps -ef | grep ${PROCESS_NAME_KILL} | awk '{print $2}' | xargs kill -9 >/dev/null 2>&1
    nohup sh ${MEMORY_RECORD} -p ${PROCESS_NAME_MEMORY} -o $memory_file & 
    ./file_itlg_parser < ${input_data_path} >${output_data_path} 
	if [ $? -ne 0 ];then
	  echo "[END] memory calculate $memory_analysis failed"
	  exit 1
	else 
	  echo "[END] memory calculate $memory_analysis success"
	fi
# exit_if_error "Memory Start Failed"
    ps -ef | grep ${PROCESS_NAME_KILL} | awk '{print $2}' | xargs kill -9 >/dev/null 2>&1

	cat $memory_file | awk '{if (NR!=1 && NR!=2 && NR!=3) {print $0} }' >$memory_file.del.front.tmp
	local maxrow=`cat $memory_file.del.front.tmp | awk 'END{print NR}'`
	cat $memory_file.del.front.tmp | awk -v maxrow_tmp=$maxrow '{if(NR!=maxrow_tmp) {print $0}}' >$memory_file
	rm $memory_file.del.front.tmp
	echo "filter memory record success"
	
	mkdir -p $data_path/memory/$memory_analysis
	exit_if_error "mkdir -p $data_path/memory/$memory_analysis failed"
	
	cd $data_path/memory/$memory_analysis
	exit_if_error "cd $data_path/memory/$memory_analysis failed"
    sh  ${MEMOEY_STATIC} -i "ftp://`hostname`:${memory_file}" 
	exit_if_error "sh ${MEMOEY_STATIC} -i "ftp://`hostname`:${memory_file}" failed"
	echo "memory static success"
	
    expect -c "
    set timeout -1;

    spawn scp -r $data_path/memory/$memory_analysis $PLATFORM_MACHINE:$TASK_PATH_MEMORY
    expect {
    \"*yes/no*\" {send \"yes\r\"; exp_continue}
    \"*password*\" {send \"${password}\r\";}
    }
    expect eof;" >/dev/null 2>&1 
	echo "scp memory analysis result to platform machine success"
}

##! @AUTHOR:
##! @VERSION: 1.0
function common_start() {
	local module_name=$4
	echo -e "\n"
	echo "[START] generate diff pack $module_name"
    local start_file_path=$1
    local input_data_path=$2
    local output_data_path=$3
    
    cd ${start_file_path}
    source env.sh
    
    ./file_itlg_parser < ${input_data_path} >${output_data_path} 
	if [ $? -ne 0 ];then
	  echo "[END] generate diff pack $module_name failed"
	  exit 1
	else 
	  echo "[END] generate diff pack $module_name success"
	fi
#exit_if_error "Common Start Failed"
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
##! @IN $1 => pattern
##! @IN $2 => file
function assert_pattern_is_in_file() {
    local pattern=$1
    local file=$2
    local matched_line=`grep "$pattern" $file | wc -l`
    if [ $matched_line -le 0 ];then
        echo "[FATAL] pattern <$pattern> can not be found in file <$file>"
        exit 1
    fi
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => original string
function convert_slash() {
    local original_string=$1
    local convert_string=`echo $original_string | awk -F '/' '{
        for (i = 1; i < NF; ++i) {
            printf("%s\\\/",$i);
        }
        printf("%s\n",$NF);
    }'`
    echo "$convert_string"
}

##! @AUTHOR:
##! @VERSION: 1.0
function convert_quatation() {
    local original_string=$1
    local convert_string=`echo $original_string | awk -F '"' '{
        for (i = 1; i < NF; ++i) {
            printf("%s\"",$i);
        }
        printf("%s\n",$NF);
    }'`
    echo "$convert_string"
}
##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => replaced file
##! @IN $2 => replaced pattern
##! @IN $3 => new string
function replace_string_in_file() {
    assert_string_is_not_empty "$TMP_FILE_DIR"
    local replaced_file=$1
    local replaced_pattern="`convert_slash "$2"`"
    local replaced_pattern="`convert_quatation "$replaced_pattern"`"
    assert_string_is_not_empty $replaced_file
    local new_string="`convert_slash "$3"`"
    local new_string="`convert_quatation "$new_string"`"

    assert_pattern_is_in_file "$replaced_pattern" "$replaced_file"
    cat $replaced_file | sed 's/'"$replaced_pattern"'/'"$new_string"'/g' > ${TMP_FILE_DIR}/tmp_file
    exit_if_error "replace string using sed failed"
    mv $TMP_FILE_DIR/tmp_file $replaced_file
    exit_if_error "mv $TMP_FILE_DIR/tmp_file $replaced_file failed"
}


##! @AUTHOR:
##! @VERSION: 1.0
function get_var_from_mysql() {
    thread_num=`echo -e "use project_ktv; select thread_num from JekensRun  where TASK_ID=${task_id}" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} | awk  '{ if (NR==2) {print $1}}'`
    echo "get_var_from_mysql success :thread_num=$thread_num"
}

##! @AUTHOR:
##! @VERSION: 1.0
function modify_conf() {
	TMP_FILE_DIR="$task_path/tmp"
	mkdir -p $TMP_FILE_DIR
	exit_if_error "mkdir -p $TMP_FILE_DIR failed"

	replace_string_in_file "${new_start_file_path}/itlg-ec1/conf/itlg.conf" "^WorkThreadNum.*" "WorkThreadNum : $thread_num"	
	replace_string_in_file "${new_start_file_path}/itlg-ec2/conf/itlg.conf" "^WorkThreadNum.*" "WorkThreadNum : $thread_num" 
	replace_string_in_file "${old_start_file_path}/itlg-ec1/conf/itlg.conf" "^WorkThreadNum.*" "WorkThreadNum : $thread_num" 
	replace_string_in_file "${old_start_file_path}/itlg-ec2/conf/itlg.conf" "^WorkThreadNum.*" "WorkThreadNum : $thread_num"
	echo "modify WorkThreadNum : $thread_num  success"
}
##! @AUTHOR:
##! @VERSION: 1.0
function start_ec_and_send_pack() {
    export  COVFILE=${data_path}/covfile/test.cov	
    if [[ ${valgrind} -eq 1 ]];then
        valgrind_start ${new_start_file_path}/itlg-ec1/bin ${data_path}/valgrind/valgrind_input ${data_path}/valgrind/valgrind_output_new.ec1toec2 ${data_path}/valgrind/valgrind.log.new.ec1
        valgrind_start ${new_start_file_path}/itlg-ec2/bin ${data_path}/valgrind/valgrind_output_new.ec1toec2 ${data_path}/valgrind/valgrind_output_new ${data_path}/valgrind/valgrind.log.new.ec2
        valgrind_start ${old_start_file_path}/itlg-ec1/bin ${data_path}/valgrind/valgrind_input ${data_path}/valgrind/valgrind_output_old.ec1toec2 ${data_path}/valgrind/valgrind.log.old.ec1
        valgrind_start ${old_start_file_path}/itlg-ec2/bin ${data_path}/valgrind/valgrind_output_old.ec1toec2 ${data_path}/valgrind/valgrind_output_old ${data_path}/valgrind/valgrind.log.old.ec2
    fi

    if [[ ${speed} -eq 1 ]];then
        speed_start ${new_start_file_path}/itlg-ec1/bin ${data_path}/speed/speed_input ${data_path}/speed/speed_output_new.ec1toec2  ${data_path}/speed/speed.log.new.ec1 new_ec1
        speed_start ${new_start_file_path}/itlg-ec2/bin ${data_path}/speed/speed_output_new.ec1toec2 ${data_path}/speed/speed_output_new  ${data_path}/speed/speed.log.new.ec2 new_ec2
        speed_start ${old_start_file_path}/itlg-ec1/bin ${data_path}/speed/speed_input ${data_path}/speed/speed_output_old.ec1toec2  ${data_path}/speed/speed.log.old.ec1 old_ec1
        speed_start ${old_start_file_path}/itlg-ec2/bin ${data_path}/speed/speed_output_old.ec1toec2 ${data_path}/speed/speed_output_old  ${data_path}/speed/speed.log.old.ec2 old_ec2
    fi

    if [[ ${memory} -eq 1 ]];then

		expect -c "
		set timeout -1;

		spawn ssh ${PLATFORM_MACHINE} mkdir -p $TASK_PATH_MEMORY
		expect {
		\"*yes/no*\" {send \"yes\r\"; exp_continue}
		\"*password*\" {send \"${password}\r\";}
		}
		expect eof;">/dev/null 2>&1

        memory_start ${new_start_file_path}/itlg-ec1/bin ${data_path}/memory/memory_input ${data_path}/memory/memory_output_new.ec1toec2  ${data_path}/memory/memory.log.new.ec1       new_ec1 
        memory_start ${new_start_file_path}/itlg-ec2/bin ${data_path}/memory/memory_output_new.ec1toec2 ${data_path}/memory/memory_output_new  ${data_path}/memory/memory.log.new.ec2  new_ec2
        memory_start ${old_start_file_path}/itlg-ec1/bin ${data_path}/memory/memory_input ${data_path}/memory/memory_output_old.ec1toec2  ${data_path}/memory/memory.log.old.ec1       old_ec1
        memory_start ${old_start_file_path}/itlg-ec2/bin ${data_path}/memory/memory_output_old.ec1toec2 ${data_path}/memory/memory_output_old  ${data_path}/memory/memory.log.old.ec2  old_ec2
    fi
    
    common_start ${new_start_file_path}/itlg-ec1/bin ${input_data_path} ${data_path}/common/common_output_new.ec1toec2 new_ec1
    common_start ${new_start_file_path}/itlg-ec2/bin ${data_path}/common/common_output_new.ec1toec2 ${new_output_data_path} new_ec2
    common_start ${old_start_file_path}/itlg-ec1/bin ${input_data_path} ${data_path}/common/common_output_old.ec1toec2 old_ec1
    common_start ${old_start_file_path}/itlg-ec2/bin ${data_path}/common/common_output_old.ec1toec2 ${old_output_data_path} old_ec2
    
    if [[ ${newdiff} -eq 1 ]];then
        common_start ${new_start_file_path}/itlg-ec1/bin ${input_data_path} ${data_path}/common/common_output_new_2.ec1toec2 new_2_ec1
        common_start ${new_start_file_path}/itlg-ec2/bin ${data_path}/common/common_output_new_2.ec1toec2 ${data_path}/common/common_output_new_2 new_2_ec2
    fi
    
    if [[ ${olddiff} -eq 1 ]];then
        common_start ${old_start_file_path}/itlg-ec1/bin ${input_data_path} ${data_path}/common/common_output_old_2.ec1toec2 old_2_ec1
        common_start ${old_start_file_path}/itlg-ec2/bin ${data_path}/common/common_output_old_2.ec1toec2 ${data_path}/common/common_output_old_2 old_2_ec2
    fi
}
##! @AUTHOR:
##! @VERSION: 1.0
function chmod_log() {
	cd $task_path/code/product_new/itlg-ec1
	chmod 755 log/

	cd $task_path/code/product_new/itlg-ec2
	chmod 755 log/

	cd $task_path/code/product_old/itlg-ec1
	chmod 755 log/

	cd $task_path/code/product_old/itlg-ec2
	chmod 755 log/
	
	echo -e "\nlog chmod success\n"
}

##! @AUTHOR:
##! @VERSION: 1.0
function modify_conf_guojihua() {
	TMP_FILE_DIR="$task_path/tmp"
	mkdir -p $TMP_FILE_DIR
	exit_if_error "mkdir -p $TMP_FILE_DIR failed"

	replace_string_in_file "${new_start_file_path}/conf/itlg.conf" "^WorkThreadNum.*" "WorkThreadNum : $thread_num"	
	replace_string_in_file "${old_start_file_path}/conf/itlg.conf" "^WorkThreadNum.*" "WorkThreadNum : $thread_num" 
	echo "modify WorkThreadNum : $thread_num  success"
}
##! @AUTHOR:
##! @VERSION: 1.0
function start_ec_and_send_pack_guojihua() {
    export  COVFILE=${data_path}/covfile/test.cov	
    if [[ ${valgrind} -eq 1 ]];then
        valgrind_start ${new_start_file_path}/bin ${data_path}/valgrind/valgrind_input ${data_path}/valgrind/valgrind_output_new ${data_path}/valgrind/valgrind.log.new
        valgrind_start ${old_start_file_path}/bin ${data_path}/valgrind/valgrind_input ${data_path}/valgrind/valgrind_output_old ${data_path}/valgrind/valgrind.log.old
    fi

    if [[ ${speed} -eq 1 ]];then
        speed_start ${new_start_file_path}/bin ${data_path}/speed/speed_input ${data_path}/speed/speed_output_new  ${data_path}/speed/speed.log.new new
        speed_start ${old_start_file_path}/bin ${data_path}/speed/speed_input ${data_path}/speed/speed_output_old  ${data_path}/speed/speed.log.old old
    fi

    if [[ ${memory} -eq 1 ]];then

		expect -c "
		set timeout -1;

		spawn ssh ${PLATFORM_MACHINE} mkdir -p $TASK_PATH_MEMORY
		expect {
		\"*yes/no*\" {send \"yes\r\"; exp_continue}
		\"*password*\" {send \"${password}\r\";}
		}
		expect eof;">/dev/null 2>&1

        memory_start ${new_start_file_path}/bin ${data_path}/memory/memory_input ${data_path}/memory/memory_output_new  ${data_path}/memory/memory.log.new new
        memory_start ${old_start_file_path}/bin ${data_path}/memory/memory_input ${data_path}/memory/memory_output_old  ${data_path}/memory/memory.log.old old
    fi
    
    common_start ${new_start_file_path}/bin ${input_data_path} ${data_path}/common/common_output_new new
    common_start ${old_start_file_path}/bin ${input_data_path} ${data_path}/common/common_output_old old
    
    if [[ ${newdiff} -eq 1 ]];then
        common_start ${new_start_file_path}/bin ${input_data_path} ${data_path}/common/common_output_new_2 new_2
    fi
    
    if [[ ${olddiff} -eq 1 ]];then
        common_start ${old_start_file_path}/bin ${input_data_path} ${data_path}/common/common_output_old_2 old_2
    fi
}
##! @AUTHOR:
##! @VERSION: 1.0
function chmod_log_guojihua() {
	cd $task_path/code/product_new/
	chmod 755 log/

	cd $task_path/code/product_old/
	chmod 755 log/
	
	echo -e "\nlog chmod success\n"
}


##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => script name
function Usage() {
    local name=$1
    echo "Usage: $name -n <new_start_file_path> -o <old_start_file_path> -i <input_data_path> -e <new_output_data_path> -l <old_output_data_path> -p <ec_type> -A <newolddiff> -B <newdiff> -C <olddiff> -D <memory> -E <speed> -F <valgrind> -c <covfile> [-h]"
    echo "Ex: $name  -n /home/spider/2/output/file -o /home/spider/2/output -i /home/spider/2/output -e  /home/spider/2/output  -l /home/spider/2/output -p 0 -A 1 -B 1 -C 1 -D 1 -E 1 -F 1 -c ftp://sdfsdf"
}

#----------------main----------------------#
while getopts "hn:o:i:e:l:p:A:B:C:D:E:F:c:" opt
do
    case $opt in
        n) 
            new_start_file_path=$OPTARG
            ;;
        o) 
            old_start_file_path=$OPTARG
            ;;
                
        i) 
            input_data_path=$OPTARG
            ;;
        e) 
            new_output_data_path=$OPTARG
            ;;
        l) 
            old_output_data_path=$OPTARG
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
        c)
            covfile=$OPTARG
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

if [ ${new_start_file_path}"x" == "x" -o ${old_start_file_path}"x" == "x"  -o ${input_data_path}"x" == "x" -o ${new_output_data_path}"x" == "x" -o ${old_output_data_path}"x" == "x" -o ${ec_type}"x" == "x" -o ${newolddiff}"x" == "x" -o ${newdiff}"x" == "x" -o ${olddiff}"x" == "x" -o ${memory}"x" == "x" -o ${speed}"x" == "x" -o ${valgrind}"x" == "x" -o ${covfile}"x" == "x" ];then
    Usage $0
    exit 1
fi

common_data_path=`dirname ${input_data_path}`
data_path=`dirname ${common_data_path}`
task_path=`dirname $data_path`
task_id=${task_path##*/}
TASK_PATH_MEMORY="/home/work/local_ecplatform/jekens/result/$task_id/memory"

get_var_from_mysql
if [[ ${ec_type} -eq 0 ]];then
    modify_conf
    start_ec_and_send_pack
    chmod_log
elif  [[ ${ec_type} -eq 1 ]];then
    modify_conf_guojihua
    start_ec_and_send_pack_guojihua
    chmod_log_guojihua
fi

exit 0
