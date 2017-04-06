#!/bin/bash

source ~/.bashrc
DIFF_API=""

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
function diff_analysis() {
    new_path="ftp://`hostname`:$base_path/trap_out_new" 
    old_path="ftp://`hostname`:$base_path/trap_out_old" 
    diff_id_file="$base_path/diff_id.newold"
    
    diff_id=`curl -d "discription='null'&lang=${ec_type}&new_path=$new_path&old_path=$old_path" $DIFF_API >/dev/null 2>&1`
    exit_if_error "diff_pack failed"
    echo $diff_id > ${diff_id_file}
    echo "newolddiff success"
}


##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => script name
function Usage() {
    local name=$1
    echo "Usage: $name  -b <base_path>  -p <ec_type>  [-h]"
    echo "Ex: $name -b /home/spider/2/output  -p 0 "
}

#----------------main----------------------#
while getopts "hb:p:" opt
do
    case $opt in
        b) 
            base_path=$OPTARG
            ;;
        p) 
            ec_type=$OPTARG
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

if [ ${base_path}"x" == "x" -o ${ec_type}"x" == "x" ];then
    Usage $0
    exit 1
fi

diff_analysis

exit 0
