#!/bin/bash

source ~/.bashrc


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
function diff_pack() {
    if [[ ${ec_type} -eq 0 ]];then
        ec_type_tmp="chineseec"
    elif [[ ${ec_type} -eq 1 ]];then
        ec_type_tmp="internationalec"
    fi

    new_path=$1
    old_path=$2
    diff_id_file=$3

    diff_id=`curl -d "discription='null'&new_version='null'&old_version='null'&lang=${ec_type_tmp}&new_path=$new_path&old_path=$old_path"  http://cp01-testing-ps6076.cp01.baidu.com:8900/?r=diff/resultanalysisAPI`
    echo $diff_id > ${diff_id_file}
}

##! @AUTHOR:
##! @VERSION: 1.0
function result_analysis() {
    local_base_path=${base_path##*:}
    
	if [[ ${newolddiff} -eq 1 ]];then
		diff_pack "$base_path/common_output_new" "$base_path/common_output_old" "$local_base_path/diff_id.newold" >/dev/null 2>&1
		exit_if_error "diff_pack failed"
		echo "newolddiff success"
    fi
	
    if [[ ${newdiff} -eq 1 ]];then
        diff_pack "$base_path/common_output_new" "$base_path/common_output_new_2" "$local_base_path/diff_id.new" >/dev/null 2>&1
		exit_if_error "diff_pack failed"
		echo "newdiff success"
    fi
    
    if [[ ${olddiff} -eq 1 ]];then
        diff_pack "$base_path/common_output_old" "$base_path/common_output_old_2" "$local_base_path/diff_id.old" >/dev/null 2>&1
		exit_if_error "diff_pack failed"
		echo "olddiff success"
    fi
}


##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => script name
function Usage() {
    local name=$1
    echo "Usage: $name  -b <path>  -p <ec_type> -A <newolddiff> -B <newdiff> -C <olddiff> [-h]"
    echo "Ex: $name -b /home/spider/2/output -p 1 -A 1 -B 1 -C 1 "
}

#----------------main----------------------#
while getopts "hb:p:A:B:C:" opt
do
    case $opt in
        b) 
            base_path=$OPTARG
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

if [ ${base_path}"x" == "x" -o ${ec_type}"x" == "x" -o ${newolddiff}"x" == "x" -o ${newdiff}"x" == "x"  -o ${olddiff}"x" == "x" ];then
    Usage $0
    exit 1
fi

result_analysis

exit 0
