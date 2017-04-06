#!/bin/bash

source ~/.bashrc
source ~/.bash_profile

MYSQL="mysql"
HOST="10.94.50.19"
PORT="3306"
USER="root"
PASSWORD="521aladdin"

LOCAL_BASE_PATH="/home/spider/remote_ecplatform/"
START_EC_AND_SEND_PACK="$LOCAL_BASE_PATH/script/start_ec_and_send_pack.sh"
PARSER="$LOCAL_BASE_PATH/parser"
GET_CODE_FROM_PRODUCT_VERSION="$LOCAL_BASE_PATH/script/get_code_from_product_version.sh"
SET_ENV="$LOCAL_BASE_PATH/script/set_env.sh"
RESULT_ANALYSIS="$LOCAL_BASE_PATH/script/result_analysis.sh"

TIME=`date +%Y%m%d`

PLATFORM_MACHINE="work@cp01-testing-ps6076.cp01.baidu.com"
password="ps-testing!!!"

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
		update_mysql 1
		echo -e "\nupdate mysql success\n"
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
		update_mysql 1
		echo -e "\nupdate mysql success\n"
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
		update_mysql 1
		echo -e "\nupdate mysql success\n"
        exit 1
    fi
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN: $1 => file name
function assert_local_file_exist() {
	if [ ! -f $1 ];then
        echo "[FATAL] local file "$1" does not exist!"
		update_mysql 1
		echo -e "\nupdate mysql success\n"
        exit 1
    fi
}



##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => product file
##! @IN $2 => product deploy path
function unzip_module_to_target_path() {

    local product_file=$1
    local deploy_path=$2
    local TMP_UNZIP_DIR=$3

    clear_path_content ${TMP_UNZIP_DIR}
    assert_local_file_exist "${product_file}"
    clear_path_content ${deploy_path}

    tar -zxvf ${product_file} -C ${TMP_UNZIP_DIR} >/dev/null 2>&1
    exit_if_error "tar -zxvf ${product_file} -C ${TMP_UNZIP_DIR} failed"

    local product_name=`ls $TMP_UNZIP_DIR`
    assert_string_is_not_empty "$product_name"

    mv ${TMP_UNZIP_DIR}/${product_name}/* ${deploy_path}
    exit_if_error "mv ${TMP_UNZIP_DIR}/${product_name}/* ${deploy_path} failed"
}


##! @AUTHOR:
##! @VERSION: 1.0
function wget_ftp() {
    local ftp_file=$1
    local out_path=$2
    local out_file_name=$3

    assert_string_is_not_empty $ftp_file
    assert_string_is_not_empty $out_path
    assert_string_is_not_empty $out_file_name
    
    assert_local_dir_or_file_exist $out_path

    wget $ftp_file -O $out_path/$out_file_name >/dev/null 2>&1
    exit_if_error "wget $ftp_file -O $out_path/$out_file_name failed" 
}

##! @AUTHOR:
##! @VERSION: 1.0
function get_code_and_data_to_local() {
   ONE_TASK_BASE_PATH=$LOCAL_BASE_PATH/workspace/${TIME}/platform_common/${task_id}

   ONE_TASK_CODE_PATH=$ONE_TASK_BASE_PATH/code
   ONE_TASK_PRODUCT_NEW=$ONE_TASK_CODE_PATH/product_new
   ONE_TASK_PRODUCT_OLD=$ONE_TASK_CODE_PATH/product_old

   ONE_TASK_DATA_PATH=$ONE_TASK_BASE_PATH/data
   ONE_TASK_COMMON_DATA_PATH=$ONE_TASK_DATA_PATH/common

   ONE_TASK_TMP_PATH=$ONE_TASK_BASE_PATH/tmp

   clear_path_content ${ONE_TASK_BASE_PATH}
   clear_path_content $ONE_TASK_PRODUCT_NEW
   clear_path_content $ONE_TASK_PRODUCT_OLD
   clear_path_content $ONE_TASK_COMMON_DATA_PATH
   clear_path_content ${ONE_TASK_TMP_PATH}
   
   sh  $GET_CODE_FROM_PRODUCT_VERSION -v $new_code_version -o $ONE_TASK_PRODUCT_NEW
   exit_if_error "sh -x $GET_CODE_FROM_PRODUCT_VERSION -v $new_code_version -o $ONE_TASK_PRODUCT_NEW failed"
   echo "get new_code from product success"
   
   sh  $GET_CODE_FROM_PRODUCT_VERSION -v $old_code_version -o $ONE_TASK_PRODUCT_OLD
   exit_if_error "sh -x $GET_CODE_FROM_PRODUCT_VERSION -v $old_code_version -o $ONE_TASK_PRODUCT_OLD failed"
   echo "get old_code from product success"
   
   sh  ${SET_ENV} -p $ONE_TASK_PRODUCT_NEW/env-build-sh
   exit_if_error "sh -x ${SET_ENV} -p $ONE_TASK_PRODUCT_NEW/env-build-sh failed"
   echo "set new_code env success"
   
   sh  ${SET_ENV} -p $ONE_TASK_PRODUCT_OLD/env-build-sh
   exit_if_error " sh -x ${SET_ENV} -p $ONE_TASK_PRODUCT_OLD/env-build-sh failed" 
   echo "set old_code env success"
   
   assert_local_dir_or_file_exist ${LOCAL_BASE_PATH}/data/$platform_data_type/$platform_data_num
   cp ${LOCAL_BASE_PATH}/data/$platform_data_type/$platform_data_num $ONE_TASK_COMMON_DATA_PATH/common_input
   exit_if_error "cp ${LOCAL_BASE_PATH}/data/$platform_data_type/$platform_data_num $ONE_TASK_COMMON_DATA_PATH/common_input failed"
   echo "prepare common_input success"
   
   if [[ $valgrind -eq 1  ]];then
       ONE_TASK_VALGRIND_DATA_PATH=$ONE_TASK_DATA_PATH/valgrind
       clear_path_content $ONE_TASK_VALGRIND_DATA_PATH
       cp ${LOCAL_BASE_PATH}/data/${ec_type}/valgrind/valgrind_input $ONE_TASK_VALGRIND_DATA_PATH/valgrind_input
	   exit_if_error "cp ${LOCAL_BASE_PATH}/data/${ec_type}/valgrind/valgrind_input $ONE_TASK_VALGRIND_DATA_PATH/valgrind_input failed"
	   echo "prepare valgrind_input success"
	fi

   if [[ $speed -eq 1  ]];then
       ONE_TASK_SPEED_DATA_PATH=$ONE_TASK_DATA_PATH/speed
       clear_path_content $ONE_TASK_SPEED_DATA_PATH
       cp ${LOCAL_BASE_PATH}/data/${ec_type}/speed/speed_input $ONE_TASK_SPEED_DATA_PATH/speed_input
	   exit_if_error "cp ${LOCAL_BASE_PATH}/data/${ec_type}/speed/speed_input $ONE_TASK_SPEED_DATA_PATH/speed_input failed"
	   echo "prepare speed_input success" 
   fi

   if [[ $memory -eq 1  ]];then
       ONE_TASK_MEMORY_DATA_PATH=$ONE_TASK_DATA_PATH/memory
       clear_path_content $ONE_TASK_MEMORY_DATA_PATH
       cp ${LOCAL_BASE_PATH}/data/${ec_type}/memory/memory_input  $ONE_TASK_MEMORY_DATA_PATH/memory_input
	   exit_if_error "cp ${LOCAL_BASE_PATH}/data/${ec_type}/memory/memory_input  $ONE_TASK_MEMORY_DATA_PATH/memory_input failed"
	   echo "prepare memory_input success"
	fi
}

##! @AUTHOR:
##! @VERSION: 1.0
function start_ec_and_send_pack() {
    new_start_file_path=$ONE_TASK_PRODUCT_NEW
    old_start_file_path=$ONE_TASK_PRODUCT_OLD
    input_data_path=$ONE_TASK_COMMON_DATA_PATH/common_input
    new_output_data_path=$ONE_TASK_COMMON_DATA_PATH/common_output_new  
    old_output_data_path=$ONE_TASK_COMMON_DATA_PATH/common_output_old
        
    sh  ${START_EC_AND_SEND_PACK} -n ${new_start_file_path} -o ${old_start_file_path} -i ${input_data_path} -e ${new_output_data_path} -l ${old_output_data_path} -p ${ec_type} -A ${newolddiff} -B ${newdiff} -C ${olddiff} -D ${memory} -E ${speed} -F ${valgrind} 
	exit_if_error "sh  ${START_EC_AND_SEND_PACK} -n ${new_start_file_path} -o ${old_start_file_path} -i ${input_data_path} -e ${new_output_data_path} -l ${old_output_data_path} -p ${ec_type} -A ${newolddiff} -B ${newdiff} -C ${olddiff} -D ${memory} -E ${speed} -F ${valgrind} failed"
}

##! @AUTHOR:
##! @VERSION: 1.0
function result_analysis() {
    local base_path="ftp://`hostname`:$ONE_TASK_COMMON_DATA_PATH"
    sh  ${RESULT_ANALYSIS} -b $base_path -p ${ec_type} -A ${newolddiff} -B $newdiff -C $olddiff
	exit_if_error "sh  ${RESULT_ANALYSIS} -b $base_path -p ${ec_type} -A ${newolddiff} -B $newdiff -C $olddiff failed"
	
    #cd $ONE_TASK_BASE_PATH
    #tar -zcvf result.tar.gz data >/dev/null 2>&1
	#exit_if_error "tar -zcvf result.tar.gz data >/dev/null 2>&1 failed"
}

##! @AUTHOR:
##! @VERSION: 1.0
function scp_result_to_local() {
   REMOTE_RESULT_PATH="$ONE_TASK_BASE_PATH/result_bak"
   REMOTE_RESULT_PATH_DIFF="$REMOTE_RESULT_PATH/diff"
   REMOTE_RESULT_PATH_VALGRIND="$REMOTE_RESULT_PATH/valgrind"
   REMOTE_RESULT_PATH_SPEED="$REMOTE_RESULT_PATH/speed"

   clear_path_content $REMOTE_RESULT_PATH
   clear_path_content $REMOTE_RESULT_PATH_DIFF
   if [[ $newolddiff -eq 1  ]];then
        cp $ONE_TASK_COMMON_DATA_PATH/diff_id.newold $REMOTE_RESULT_PATH_DIFF
        exit_if_error "cp $ONE_TASK_COMMON_DATA_PATH/diff_id.newold $REMOTE_RESULT_PATH_DIFF failed"
   fi

   if [[ $newdiff -eq 1  ]];then
        cp $ONE_TASK_COMMON_DATA_PATH/diff_id.new $REMOTE_RESULT_PATH_DIFF
        exit_if_error "cp $ONE_TASK_COMMON_DATA_PATH/diff_id.new $REMOTE_RESULT_PATH_DIFF  failed"
   fi
     
   if [[ $olddiff -eq 1  ]];then
        cp $ONE_TASK_COMMON_DATA_PATH/diff_id.old $REMOTE_RESULT_PATH_DIFF
        exit_if_error "cp $ONE_TASK_COMMON_DATA_PATH/diff_id.old $REMOTE_RESULT_PATH_DIFF failed"
   fi
      
   if [[ $valgrind -eq 1  ]];then
        clear_path_content $REMOTE_RESULT_PATH_VALGRIND
        cp $ONE_TASK_VALGRIND_DATA_PATH/valgrind.log.* $REMOTE_RESULT_PATH_VALGRIND
        exit_if_error "cp $ONE_TASK_VALGRIND_DATA_PATH/valgrind.log.* $REMOTE_RESULT_PATH_VALGRIND failed"
   fi

   if [[ $speed -eq 1  ]];then
        clear_path_content $REMOTE_RESULT_PATH_SPEED
        cp $ONE_TASK_SPEED_DATA_PATH/speed.log.* $REMOTE_RESULT_PATH_SPEED
        exit_if_error "cp $ONE_TASK_SPEED_DATA_PATH/speed.log.* $REMOTE_RESULT_PATH_SPEED  failed"
   fi
   #---memory scp is in start_ec_and_send_pack.sh---#

   cd $ONE_TASK_BASE_PATH
   tar -zcvf result_bak.tar.gz result_bak >/dev/null 2>&1
   exit_if_error "tar -zcvf $REMOTE_RESULT_PATH.tar.gz $REMOTE_RESULT_PATH failed" 
   echo "tar scp result success"

   LOCAL_RESULT_PATH="/home/work/local_ecplatform/platform_common/result/$task_id/"
   
   expect -c "
   set timeout -1;

   spawn ssh $PLATFORM_MACHINE  mkdir -p $LOCAL_RESULT_PATH
   expect {
    \"*yes/no*\" {send \"yes\r\"; exp_continue}
    \"*password*\" {send \"${password}\r\";}
   }
   expect eof;">/dev/null 2>&1

   expect -c "
   set timeout -1;

   spawn scp  $REMOTE_RESULT_PATH.tar.gz $PLATFORM_MACHINE:$LOCAL_RESULT_PATH
   expect {
    \"*yes/no*\" {send \"yes\r\"; exp_continue}
    \"*password*\" {send \"${password}\r\";}
   }
   expect eof;">/dev/null 2>&1
   
   expect -c "
   set timeout -1;

   spawn ssh $PLATFORM_MACHINE  tar -zxvf $LOCAL_RESULT_PATH/result_bak.tar.gz -C $LOCAL_RESULT_PATH 
   expect {
    \"*yes/no*\" {send \"yes\r\"; exp_continue}
    \"*password*\" {send \"${password}\r\";}
   }
   expect eof;">/dev/null 2>&1
}

##! @AUTHOR:
##! @VERSION: 1.0
function update_mysql() { 
    local result=$1
    if [ $result -eq 0 ];then
        echo -e "use project_ktv; update LocalRun set STATUS='done',RUN_RESULT='ftp://`hostname`:${LOCAL_BASE_PATH}/workspace/${TIME}/platform_common/${task_id}/data' where TASK_ID=${task_id}" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} 
    elif [ $result -eq 1 ];then
        echo -e "use project_ktv; update LocalRun set STATUS='fail',RUN_RESULT='ftp://`hostname`:${LOCAL_BASE_PATH}/workspace/${TIME}/platform_common/${task_id}/data' where TASK_ID=${task_id}" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} 
    fi
}
##! @AUTHOR:
##! @VERSION: 1.0
function start_process() {
	echo -e "\n"	
	echo "[START] get_code_and_data_to_local"
    get_code_and_data_to_local
	echo "[END] get_code_and_data_to_local success"
	
	echo -e "\n"	
	echo "[START] start_ec_and_send_pack"
    start_ec_and_send_pack
	echo "[END] start_ec_and_send_pack success"

	echo -e "\n"	
    echo "[START] result_analysis"
    result_analysis
	echo "[END] result_analysis success"
    
    echo -e "\n"
    echo "[START] scp_result_to_local"
    scp_result_to_local
    echo "[END] scp_result_to_local success"
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

update_mysql 0
echo -e "\nupdate mysql success\n"

end_time=`date +%Y:%m:%d-%H:%M:%S`
echo $start_time
echo $end_time

exit 0
