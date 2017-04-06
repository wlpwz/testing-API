#!ybin/bash

source ~/.bashrc
source ~/.bash_profile

MEMORY_RECORD="/home/spider/platform_dc/script/memory_record.sh"
PROCESS_NAME_KILL="[d]istribute2"
PROCESS_NAME_MEMORY="distribute2"
SPEED_PACK_NUM="200000"
SCRIPT_TRAPDC_ZW="/home/spider/platform_dc/script/trapdc_zw.sh"
DC_PORT="29325"
MEMORY_SPEED_INPUT="/home/spider/platform_dc/data/zhongwen/memory_speed_input"
DIFF_INPUT="/home/spider/platform_dc/data/zhongwen/diff_input"

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
function common_start() {
	local module_name=$4
	echo -e "\n"
	echo "[START] generate diff pack $module_name"
    local input_data_path=$1
    local output_data_path=$2
    local conf_path=$3
    
    ps -ef | grep ${PROCESS_NAME_KILL} | awk '{print $2}' | xargs kill -9 >/dev/null 2>&1
    killall trapdc.pl >/dev/null 2>&1
    
    sleep 20 
    cd $conf_path/../bin
    nohup ./distribute2 -c ../conf/distribute2.conf  >/dev/null 2>&1 &
    exit_if_error  "nohup ./distribute2 -c ../conf/distribute2.conf  & failed" 

    mkdir -p $output_data_path
    exit_if_error "mkdir -p $output_data_path failed"

    cp $SCRIPT_TRAPDC_ZW $output_data_path
    exit_if_error "cp $SCRIPT_TRAPDC_ZW $output_data_path failed"
 
    cd $output_data_path
    exit_if_error "cd $output_data_path  failed" 
    
    sleep 100
    sh  trapdc_zw.sh  $conf_path  1 >/dev/null 2>&1
    exit_if_error "sh  trapdc_zw.sh  $conf_path  1 failed"
    
    nc localhost $DC_PORT <$input_data_path  
	if [ $? -ne 0 ];then
	  echo "[END] generate diff pack $module_name failed"
	  exit 1
	else 
	  echo "[END] generate diff pack $module_name success"
	fi
    
    sleep 60
    ps -ef | grep ${PROCESS_NAME_KILL} | awk '{print $2}' | xargs kill -9 >/dev/null 2>&1
    killall trapdc.pl >/dev/null 2>&1
}

##! @AUTHOR:
##! @VERSION: 1.0
function memory_speed_start() {
	local module_name=$4
	echo -e "\n"
	echo "[START] memory speed calculate $memory_analysis"
    local input_data_path=$1
    local output_data_path=$2
    local conf_path=$3
    
    #***---common---***# 
    ps -ef | grep ${PROCESS_NAME_KILL} | awk '{print $2}' | xargs kill -9 >/dev/null 2>&1
    killall trapdc.pl >/dev/null 2>&1
    
    sleep 20
    cd $conf_path/../bin
    nohup ./distribute2 -c ../conf/distribute2.conf  >/dev/null 2>&1 &
    exit_if_error  "nohup ./distribute2 -c ../conf/distribute2.conf  & failed" 
    
    mkdir -p $output_data_path
    exit_if_error "mkdir -p $output_data_path failed"

    cp $SCRIPT_TRAPDC_ZW $output_data_path
    exit_if_error "cp $SCRIPT_TRAPDC_ZW $output_data_path failed"
 
    cd $output_data_path
    exit_if_error "cd $output_data_path  failed" 
    
    sleep 100
    sh trapdc_zw.sh  $conf_path  0 >/dev/null 2>&1
    exit_if_error "sh  trapdc_zw.sh  $conf_path  1 failed"
    #***---common end---***# 

    local memory_file=$ONE_TASK_BASE_PATH/data/memory/$module_name.log
    nohup sh ${MEMORY_RECORD} -p ${PROCESS_NAME_MEMORY} -o $memory_file & 
    local start_time=`date +%s`
    
    nc localhost $DC_PORT <$input_data_path  
	if [ $? -ne 0 ];then
	  echo "[END] memory speed calculate $module_name failed"
	  exit 1
	else 
	  echo "[END] memory speed calculate $module_name success"
	fi

    local end_time=`date +%s`
    ps -ef | grep ${PROCESS_NAME_KILL} | awk '{print $2}' | xargs kill -9 >/dev/null 2>&1
    killall trapdc.pl >/dev/null 2>&1

	local speed=$(( $SPEED_PACK_NUM/($end_time - $start_time) ))
    echo  $speed > $ONE_TASK_BASE_PATH/data/speed/speed.log.$module_name
    echo "speed static success"
}

##! @AUTHOR:
##! @VERSION: 1.0
function speed_start() {
	local module_name=$4
	echo -e "\n"
	echo "[START] speed calculate $memory_analysis"
    local input_data_path=$1
    local output_data_path=$2
    local conf_path=$3
    
    #***---common---***# 
    ps -ef | grep ${PROCESS_NAME_KILL} | awk '{print $2}' | xargs kill -9 >/dev/null 2>&1
    killall trapdc.pl >/dev/null 2>&1
    
    sleep 20
    cd $conf_path/../bin
    nohup ./distribute2 -c ../conf/distribute2.conf >/dev/null 2>&1  &
    exit_if_error  "nohup ./distribute2 -c ../conf/distribute2.conf  & failed" 
    
    mkdir -p $output_data_path
    exit_if_error "mkdir -p $output_data_path failed"

    cp $script_trapdc $output_data_path
    exit_if_error "cp $script_trapdc $output_data_path failed"
 
    cd $output_data_path
    exit_if_error "cd $output_data_path  failed" 
    
    sleep 100
    sh  trapdc_zw.sh  $conf_path  0 >/dev/null 2>&1
    exit_if_error "sh  GetDcConfPort.sh  $conf_path  1 failed"
    #***---common end---***# 

    local start_time=`date +%s`
    
    nc localhost $DC_PORT <$input_data_path  
	if [ $? -ne 0 ];then
	  echo "[END] speed calculate $module_name failed"
	  exit 1
	else 
	  echo "[END] speed calculate $module_name success"
	fi

    local end_time=`date +%s`
    ps -ef | grep ${PROCESS_NAME_KILL} | awk '{print $2}' | xargs kill -9 >/dev/null 2>&1
    killall trapdc.pl >/dev/null 2>&1

    #***---speed analysis---***#
	local speed=$(( $SPEED_PACK_NUM/($end_time - $start_time) ))
    echo  $speed > $ONE_TASK_BASE_PATH/data/speed/speed.log.$module_name
    echo "speed static success"
    #***---speed analysis---***#
}


##! @AUTHOR:
##! @VERSION: 1.0
function start_test() {
    if [[ ${newolddiff} -eq 1 ]];then
        clear_path_content $ONE_TASK_BASE_PATH/data/common
        common_start $DIFF_INPUT  $ONE_TASK_BASE_PATH/data/common/trap_out_new $ONE_TASK_BASE_PATH/code/product_new/conf new 
        common_start $DIFF_INPUT  $ONE_TASK_BASE_PATH/data/common/trap_out_old $ONE_TASK_BASE_PATH/code/product_old/conf old
        
    fi
    if [[ ${memory} -eq 1 ]];then
        clear_path_content $ONE_TASK_BASE_PATH/data/memory
        clear_path_content $ONE_TASK_BASE_PATH/data/speed
        memory_speed_start $MEMORY_SPEED_INPUT $ONE_TASK_BASE_PATH/data/memory/trap_out_new $ONE_TASK_BASE_PATH/code/product_new/conf new 
        memory_speed_start $MEMORY_SPEED_INPUT $ONE_TASK_BASE_PATH/data/memory/trap_out_old $ONE_TASK_BASE_PATH/code/product_old/conf old 

    else
        if [[ ${speed} -eq 1 ]];then
            clear_path_content $ONE_TASK_BASE_PATH/data/speed
            speed_start $MEMORY_SPEED_INPUT $ONE_TASK_BASE_PATH/data/speed/trap_out_new $ONE_TASK_BASE_PATH/code/product_new/conf new
            speed_start $MEMORY_SPEED_INPUT $ONE_TASK_BASE_PATH/data/speed/trap_out_old $ONE_TASK_BASE_PATH/code/product_old/conf old
        fi
    fi 
}

##! @AUTHOR:
##! @VERSION: 1.0
function chmod_log() {
	cd $ONE_TASK_BASE_PATH/code/product_new
	chmod 755 log/

	cd $ONE_TASK_BASE_PATH/code/product_old
	chmod 755 log/
	
	echo -e "\nlog chmod success\n"
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => script name
function Usage() {
    local name=$1
    echo "Usage: $name -t <ONE_TASK_BASE_PATH> -d <newolddiff> -s <speed> -m <memory> [-h]"
    echo "Ex: $name  -t /home/spider/2/output/20 -d 1 -s 1 -m 1"
}

#----------------main----------------------#
while getopts "ht:d:s:m:" opt
do
    case $opt in
        t) 
            ONE_TASK_BASE_PATH=$OPTARG
            ;;
        d) 
            newolddiff=$OPTARG
            ;;
                
        s) 
            speed=$OPTARG
            ;;
        m) 
            memory=$OPTARG
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

if [ ${ONE_TASK_BASE_PATH}"x" == "x" -o ${newolddiff}"x" == "x"  -o ${speed}"x" == "x" -o ${memory}"x" == "x" ];then
    Usage $0
    exit 1
fi

start_test
chmod_log

exit 0
