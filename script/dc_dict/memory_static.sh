#!/bin/bash

source ~/.bashrc



WGET_FILE=wgetfile
TIME_FILE=timefile
PHYSICALMEMORY_FILE=physicalmemoryfile
MAXMEMORY_FILE=maxmemoryfile
MINMEMORY_FILE=minmemoryfile
AVERAGEMEMORY_FILE=averagememoryfile

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
         exit_if_error "mkdir -p  ${path}"
     fi
}


##! @AUTHOR:
##! @VERSION: 1.0
function memory_static() {
    wget_memory_record_file
    generate_time_file
    generate_physicalmemory_file
    generate_maxmemory_file
    generate_minmemory_file
}

##! @AUTHOR:
##! @VERSION: 1.0
function wget_memory_record_file() {
    wget "${memory_ftp}" -O "${WGET_FILE}" >/dev/null 2>&1
    exit_if_error "wget "${memory_ftp}" -O "${WGET_FILE}" >/dev/null 2>&1 failed"
	echo "wget memory_ftp success"
}

##! @AUTHOR:
##! @VERSION: 1.0
function generate_time_file() {
    cat "${WGET_FILE}" |  awk '{print $2}' | awk '{if (NR==1){a=$1} else {a=a","$1} }'END'{print a}' > ${TIME_FILE}
    exit_if_error "cat "${WGET_FILE}" | awk '{print $2}' | awk '{if (NR==1){a=$1} else {a=a","$1} }'END'{print a}' > ${TIME_FILE} failed"
	echo "generate_time_file success"
}

##! @AUTHOR:
##! @VERSION: 1.0
function generate_physicalmemory_file() {
    cat "${WGET_FILE}" |  awk '{print $5}' | awk 'BEGIN{a="物理内存变化曲线"}{if (NR==1){a=a","$1} else {a=a","$1} } END{print a}' > ${PHYSICALMEMORY_FILE}
    exit_if_error "cat "${WGET_FILE}" |  awk '{print $5}' | awk 'BEGIN{a="物理内存变化曲线"}{if (NR==1){a=a","$1} else {a=a","$1} } END{print a}' > ${PHYSICALMEMORY_FILE} failed"
	echo "generate_physicalmemory_file success"
}

##! @AUTHOR:
##! @VERSION: 1.0
function generate_maxmemory_file() {
    cat "${WGET_FILE}" | awk '{print $5}'| awk '{if(NR==1){a=$1} else {if($1>a){a=$1}}}'END'{print a}' > ${MAXMEMORY_FILE}
    exit_if_error "cat "${WGET_FILE}" | awk '{print $5}'| awk '{if(NR==1){a=$1} else {if($1>a){a=$1}}}'END'{print a}' > ${MAXMEMORY_FILE} failed"
	echo "generate_maxmemory_file success"
}

##! @AUTHOR:
##! @VERSION: 1.0
function generate_minmemory_file() {
    cat "${WGET_FILE}" |awk '{print $5}'|  awk '{if(NR==1){a=$1} else {if($1<a){a=$1}}}'END'{print a}' > ${MINMEMORY_FILE}
    exit_if_error "cat "${WGET_FILE}" |awk '{print $5}'|  awk '{if(NR==1){a=$1} else {if($1<a){a=$1}}}'END'{print a}' > ${MINMEMORY_FILE} failed"
	echo "generate_minmemory_file success"
    
}


##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => script name
function Usage() {
    local name=$1
    echo "Usage: $name  -i <memory_ftp>  [-h]"
    echo "Ex: $name -i ftp://cq01-testing-ps7121.vm.baidu.com:/home/spider/wget_liupan/memory_record.sh "
}

#----------------main----------------------#
while getopts "hi:" opt
do
    case $opt in
        i) 
            memory_ftp=$OPTARG
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

if [ ${memory_ftp}"x" == "x" ];then
    Usage $0
    exit 1
fi
memory_static

exit 0
