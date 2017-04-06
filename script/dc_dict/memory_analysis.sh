#!/bin/bash

source ~/.bashrc
MEMOEY_STATIC="/home/spider/platform_dc/script/memory_static.sh"

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
function memory_analysis() {
    cat $memory_file | awk '{if (NR!=1 && NR!=2 && NR!=3) {print $0} }' >$memory_file.del.front.tmp
    local maxrow=`cat $memory_file.del.front.tmp | awk 'END{print NR}'`
    cat $memory_file.del.front.tmp | awk -v maxrow_tmp=$maxrow '{if(NR!=maxrow_tmp) {print $0}}' >$memory_file
    rm $memory_file.del.front.tmp
    echo "filter memory record success"

    mkdir -p $base_path/memory_$module_name
    exit_if_error "mkdir -p $base_path/memory_$module_name failed"
    
    cd $base_path/memory_$module_name
    exit_if_error "cd $base_path/memory_$module_name failed"
    sh  ${MEMOEY_STATIC} -i "ftp://`hostname`:${memory_file}" 
    exit_if_error "sh ${MEMOEY_STATIC} -i "ftp://`hostname`:${memory_file}" failed"
    echo "$module_name memory static success"
}


##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => script name
function Usage() {
    local name=$1
    echo "Usage: $name  -b <base_path>  -f <memory_file> -d <module_name> [-h]"
    echo "Ex: $name -b /home/spider/2/output  -f /home/spider/2/output -d new"
}

#----------------main----------------------#
while getopts "hb:f:d:" opt
do
    case $opt in
        b) 
            base_path=$OPTARG
            ;;
        f) 
            memory_file=$OPTARG
            ;;
        d) 
            module_name=$OPTARG
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

if [ ${base_path}"x" == "x" -o ${memory_file}"x" == "x" -o ${module_name}"x" == "x" ];then
    Usage $0
    exit 1
fi

memory_analysis

exit 0
