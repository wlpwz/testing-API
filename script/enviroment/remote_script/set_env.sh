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
function set_env() {
    cd $path
    sh env-build.sh --no-frame-down --ec1-down --ec2-down >/dev/null 2>&1
    exit_if_error "sh env-build.sh --no-frame-down --ec1-down --ec2-down failed"
	echo "sh env-build.sh --no-frame-down --ec1-down --ec2-down success"
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => script name
function Usage() {
    local name=$1
    echo "Usage: $name  -p <path>  [-h]"
    echo "Ex: $name -p /home/spider/2/output"
}

#----------------main----------------------#
while getopts "hp:" opt
do
    case $opt in
        p) 
            path=$OPTARG
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

if [ ${path}"x" == "x" ];then
    Usage $0
    exit 1
fi

set_env

exit 0
