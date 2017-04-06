#!/bin/bash

source ~/.bashrc
source ~/.bash_profile

MYSQL="/home/spider/.jumbo/bin/mysql"
HOST="127.0.0.1"
PORT="3306"
USER="root"
PASSWORD="521aladdin"
DATABASE="project_ktv"
DC_DICT_TABLE="dictionary"

LOCAL_BASE_PATH="/home/spider/platform_dc/"
RESULT_PATH="$LOCAL_BASE_PATH/result"
get_online_code_modify_conf="$LOCAL_BASE_PATH/script/get_online_code_modify_conf.sh"
get_new_dc_dict="$LOCAL_BASE_PATH/script/get_new_dc_dict.sh"
generate_new_code="$LOCAL_BASE_PATH/script/generate_new_code.sh"
start_test="$LOCAL_BASE_PATH/script/start_test.sh"

DIFF_ANALYSIS="$LOCAL_BASE_PATH/script/diff_analysis.sh"
MEMORY_ANALYSIS="$LOCAL_BASE_PATH/script/memory_analysis.sh"
TIME=`date +%Y%m%d`

PLATFORM_MACHINE="work@cp01-qa-spider004.cp01.baidu.com"
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
		update_mysql  1
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
function check_last_job_whether_done() {
    local last_job_status="init"
    job_is_api=`echo -e "use ${DATABASE}; select is_api from ${DC_DICT_TABLE}  where id=${task_id}" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} | awk  '{ if (NR==2) {print $1}}'` 
    #while [[ ${last_job_status}"x" != "7x" &&  ${last_job_status}"x" != "8x" &&  ${last_job_status}"x" != "9x" &&  ${last_job_status}"x" != "10x" &&  ${last_job_status}"x" != "11x" && &&  ${last_job_status}"x" != "12x" ]]
    while [[ ${last_job_status} -lt 3 && ${last_job_status} -gt 0 ]]
    do
        sleep 30
        last_job_status=`echo -e "use ${DATABASE}; select status from ${DC_DICT_TABLE}  where id=$((${task_id}-1))" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} | awk  '{ if (NR==2) {print $1}}'` 
    done
    if [[ ${job_is_api} -eq 0 ]]
    then
        echo -e "\nlast job done"
        echo -e "use ${DATABASE}; update ${DC_DICT_TABLE} set status='2' where id=${task_id}" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} 
        echo -e "\nupdate job ${task_id} status : 2(doing) success"
    fi
    #API push
    local last_same_dict_status="init"
    dict=`echo -e "use ${DATABASE}; select dictionary_name from ${DC_DICT_TABLE}  where id=${task_id}" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} | awk  '{ if (NR==2) {print $1}}'` 
    last_same_dict_status=`echo -e "use ${DATABASE}; select status from ${DC_DICT_TABLE}  where dictionary_name='${dict}' and id<${task_id} order by id desc limit 1" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} | awk  '{ if (NR==2) {print $1}}'` 
    last_job_flag=0
    while [[ ${job_is_api} -eq 1 && ${last_job_flag} -eq 0 ]]
    do
	    if [ ${last_same_dict_status} -eq 8 ] || [ ${last_same_dict_status} -eq 9 ] || [ ${last_same_dict_status} -eq 10 ] || [ ${last_same_dict_status} -eq 11 ] || [ ${last_same_dict_status} -eq 16 ] || [ ${last_same_dict_status} -eq 17 ] || [ ${last_same_dict_status} -eq 13 ] || [ ${last_same_dict_status} -eq 14 ] || [ ${last_same_dict_status} -eq 0 ]
            then
                last_job_flag=1
                echo -e "\nlast job done"
                echo -e "use ${DATABASE}; update ${DC_DICT_TABLE} set status='2' where id=${task_id}" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} 
                echo -e "\nupdate job ${task_id} status : 2(doing) success"
            else
                sleep 30
                last_job_flag=0
                last_same_dict_status=`echo -e "use ${DATABASE}; select status from ${DC_DICT_TABLE}  where dictionary_name='${dict}' and id<${task_id} order by id desc limit 1" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} | awk  '{ if (NR==2) {print $1}}'`
            fi

    done
    #API push end
    echo "last log check done"
}

##! @AUTHOR:
##! @VERSION: 1.0
function get_online_code_modify_conf_as_old_version() {
    local outputpath=$1
    sh  ${get_online_code_modify_conf}  $outputpath
    exit_if_error "sh ${get_online_code_modify_conf}  $outputpath failed"
}

##! @AUTHOR:
##! @VERSION: 1.0
function get_new_dc_dict() {
    local outputpath=$1
    echo "sh ${get_new_dc_dict} -t $task_id -o $outputpath"
    sh ${get_new_dc_dict} -t $task_id -o $outputpath
    exit_if_error "sh ${get_new_dc_dict}  $outputpath failed"
}

##! @AUTHOR:
##! @VERSION: 1.0
function generate_new_code() {
    local dict_path=$1
    local old_code_path=$2
    local outputpath=$3
    dictionary_name=`echo -e "use ${DATABASE}; select dictionary_name from ${DC_DICT_TABLE}  where id=$((${task_id}-0))" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} | awk  '{ if (NR==2) {print $1}}'`
    sh ${generate_new_code}  -d $dict_path -p $old_code_path -o $outputpath -c $dictionary_name
    echo "sh ${generate_new_code}  -d $dict_path -p $old_code_path -o $outputpath -c $dictionary_name"
    exit_if_error "sh ${generate_new_code}  $dict_path $old_code_path $outputpath failed"
}

##! @AUTHOR:
##! @VERSION: 1.0
function get_code_to_local() {
    ONE_TASK_BASE_PATH=$LOCAL_BASE_PATH/workspace/${TIME}/platform_common/${task_id}
    ONE_TASK_CODE_PATH=$ONE_TASK_BASE_PATH/code
    ONE_TASK_PRODUCT_NEW=$ONE_TASK_CODE_PATH/product_new
    ONE_TASK_PRODUCT_OLD=$ONE_TASK_CODE_PATH/product_old
    ONE_TASK_DATA_PATH=$ONE_TASK_BASE_PATH/data
    ONE_TASK_TMP_PATH=$ONE_TASK_BASE_PATH/tmp

    clear_path_content $ONE_TASK_BASE_PATH
    clear_path_content $ONE_TASK_CODE_PATH
    clear_path_content $ONE_TASK_PRODUCT_NEW
    clear_path_content $ONE_TASK_PRODUCT_OLD
    clear_path_content $ONE_TASK_DATA_PATH
    clear_path_content $ONE_TASK_TMP_PATH
    clear_path_content "${ONE_TASK_TMP_PATH}/new_dc_dict"

    get_online_code_modify_conf_as_old_version $ONE_TASK_PRODUCT_OLD
    echo -e "\nget_online_code_modify_conf_as_old_version  success"
    get_new_dc_dict "${ONE_TASK_TMP_PATH}/new_dc_dict"
    echo -e "\nget_new_dc_dict  success"
    generate_new_code "${ONE_TASK_TMP_PATH}/new_dc_dict" "$ONE_TASK_PRODUCT_OLD" "$ONE_TASK_PRODUCT_NEW"
    echo -e "\ngenerate_new_code  success"
}

##! @AUTHOR:
##! @VERSION: 1.0
function start_test() {
    dict_name=`echo -e "use ${DATABASE}; select dictionary_name from ${DC_DICT_TABLE}  where id=${task_id}" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} | awk  '{ if (NR==2) {print $1}}'` 
    echo -e "\nget dict_name success : $dict_name"
    
    if [ ${dict_name}"x"=="x" ];then 
        exit_if_error "[error] dict_name is null"
    fi
    echo -e "select newold from ${DC_DICT_TABLE}  where id=${task_id}"
    newolddiff=`echo -e "use ${DATABASE}; select newold from ${DC_DICT_TABLE}  where id=${task_id}" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} | awk  '{ if (NR==2) {print $1}}'`
    speed=`echo -e "use ${DATABASE}; select speed from ${DC_DICT_TABLE}  where id=${task_id}" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} | awk  '{ if (NR==2) {print $1}}'`
    memory=`echo -e "use ${DATABASE}; select memory from ${DC_DICT_TABLE}  where id=${task_id}" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} | awk  '{ if (NR==2) {print $1}}'`
    echo -e "script:${start_test} -t $ONE_TASK_BASE_PATH -d $newolddiff -s $speed -m $memory"
    sh   ${start_test} -t $ONE_TASK_BASE_PATH -d $newolddiff -s $speed -m $memory
    exit_if_error "script:${start_test} -t $ONE_TASK_BASE_PATH  -d $newolddiff -s $speed -m $memory failed"
}


##! @AUTHOR:
##! @VERSION: 1.0
function result_analysis() {
	if [  $newolddiff -eq 1 ];then
        sh  ${DIFF_ANALYSIS} -b $ONE_TASK_BASE_PATH/data/memory -p 0  
	    exit_if_error "sh  ${RESULT_ANALYSIS} -b $ONE_TASK_BASE_PATH/data/common -p 0 failed"
		#continue
	fi
    if [  $memory -eq 1 ];then
        sh ${MEMORY_ANALYSIS} -b $ONE_TASK_BASE_PATH/data/memory -f $ONE_TASK_BASE_PATH/data/memory/new.log -d new 
        exit_if_error "sh ${MEMORY_ANALYSIS} -b $ONE_TASK_BASE_PATH/data/memory -f $ONE_TASK_BASE_PATH/data/memory/new.log -d new failed"

        sh ${MEMORY_ANALYSIS} -b $ONE_TASK_BASE_PATH/data/memory -f $ONE_TASK_BASE_PATH/data/memory/old.log -d old
        exit_if_error "sh ${MEMORY_ANALYSIS} -b $ONE_TASK_BASE_PATH/data/memory -f $ONE_TASK_BASE_PATH/data/memory/old.log -d old failed"
    fi
}


##! @AUTHOR:
##! @VERSION: 1.0
function scp_result_to_local() {
    ONE_TASK_RESULT_PATH="$RESULT_PATH/$task_id/"
    ONE_TASK_RESULT_PATH_DIFF="$ONE_TASK_RESULT_PATH/diff"
    ONE_TASK_RESULT_PATH_SPEED="$ONE_TASK_RESULT_PATH/speed"
    ONE_TASK_RESULT_PATH_MEMORY="$ONE_TASK_RESULT_PATH/memory"

    clear_path_content $ONE_TASK_RESULT_PATH

    if [[ $newolddiff -eq 1  ]];then
        clear_path_content $ONE_TASK_RESULT_PATH_DIFF
        cp $ONE_TASK_DATA_PATH/memory/diff_id.newold $ONE_TASK_RESULT_PATH_DIFF
        cp $ONE_TASK_DATA_PATH/memory/diff_id_saver.newold $ONE_TASK_RESULT_PATH_DIFF
        exit_if_error "cp $ONE_TASK_DATA_PATH/memory/diff_id.newold $ONE_TASK_RESULT_PATH_DIFF failed"
    fi
    if [[ $speed -eq 1  ]];then
        clear_path_content $ONE_TASK_RESULT_PATH_SPEED
        cp $ONE_TASK_DATA_PATH/speed/speed.log.* $ONE_TASK_RESULT_PATH_SPEED
        exit_if_error "cp $ONE_TASK_DATA_PATH/speed/speed.log.* $ONE_TASK_RESULT_PATH_SPEED  failed"
        
    fi
    if [[ $memory -eq 1  ]];then
        clear_path_content $ONE_TASK_RESULT_PATH_MEMORY
        cp -r $ONE_TASK_DATA_PATH/memory/memory_* $ONE_TASK_RESULT_PATH_MEMORY
        exit_if_error "cp -r $ONE_TASK_DATA_PATH/memory/memory_*  $ONE_TASK_RESULT_PATH_MEMORY  failed"
    fi
}


##! @AUTHOR:
##! @VERSION: 1.0
function update_mysql() { 
    local result=$1
    if [ $result -eq 0 ];then
	#ONE_TASK_BASE_PATH=$LOCAL_BASE_PATH/workspace/20160325/platform_common/${task_id} #test will del
	cache_diff_id=0
        diff_id=`cat $ONE_TASK_BASE_PATH/data/memory/diff_id.newold|wc -l`
        if [ $diff_id -eq 0 ]
        then
            cache_diff_id=0
        else
            cache_diff_id=`cat $ONE_TASK_BASE_PATH/data/memory/diff_id.newold`
        fi
	#cache_diff_id=`cat $ONE_TASK_BASE_PATH/data/memory/diff_id.newold`
	echo "cache_diff_id:$cache_diff_id"
        echo  "use ${DATABASE}; update ${DC_DICT_TABLE} set result='ftp://`hostname`:${LOCAL_BASE_PATH}/workspace/${TIME}/platform_common/${task_id}/data',cachediffid=${cache_diff_id} where id=${task_id}" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD}
        echo -e "use ${DATABASE}; update ${DC_DICT_TABLE} set result='ftp://`hostname`:${LOCAL_BASE_PATH}/workspace/${TIME}/platform_common/${task_id}/data',cachediffid=${cache_diff_id} where id=${task_id}" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD}
	#get diff result 
	result_sql=`curl -d "id=${task_id}&diffid=${cache_diff_id}" http://pat.baidu.com/?r=dictionary/getTaskDiffResultAPI`
	#check status
        last_job_status=0
        last_job_status=`echo -e "use ${DATABASE}; select status from ${DC_DICT_TABLE}  where id=${task_id}" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} | awk  '{ if (NR==2) {print $1}}'`
        if [ ${last_job_status} -lt 3 ]	
	then
        	curl -d "id=${task_id}&status=3" http://pat.baidu.com/?r=dictionary/changeTaskStatusAPI
	fi
    elif [ $result -eq 1 ];then
        curl -d "id=${task_id}&status=8" http://pat.baidu.com/?r=dictionary/changeTaskStatusAPI
    fi
}

##! @AUTHOR:
##! @VERSION: 1.0
function start_process() {
	echo -e "\n"	
	echo "[START] check_last_job_whether_done"
    check_last_job_whether_done
    echo "[END] check_last_job_whether_done success"
	
    echo -e "\n"	
	echo "[START] get_code_and_data_to_local"
    get_code_to_local
    echo "[END] get_code_and_data_to_local success"
	
	echo -e "\n"	
	echo "[START] start_ec_and_send_pack"
    start_test
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
    echo "Usage: $name  -t <task_id>"
    echo "Ex: $name -t 20"
}

#----------------main----------------------#
while getopts "ht:" opt
do
    case $opt in
        t) 
            task_id=$OPTARG
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

if [ ${task_id}"x" == "x" ];then
    Usage $0
    exit 1
fi

start_time=`date +%Y:%m:%d-%H:%M:%S`
start_process

update_mysql  0
echo -e "\nupdate mysql success\n"

end_time=`date +%Y:%m:%d-%H:%M:%S`
echo $start_time
echo $end_time

exit 0
