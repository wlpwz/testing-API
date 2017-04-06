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
function memory_record() {
	top -b -d 10 | awk -v process_name_tmp=${process_name} '$12==process_name_tmp {sub(/[\r\n]+/, "");print strftime("%Y%m%d %H:%M:%S"), $1, $5, $6, $7, $9, $10, $12; fflush()}' > ${outfile}
}


##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => script name
function Usage() {
    local name=$1
    echo "Usage: $name  -p <process_name> -o <outfile>  [-h]"
    echo "Ex: $name -p i18n_ec_frmwork -o /home/spider/ddd "
}

#----------------main----------------------#
while getopts "hp:o:" opt
do
    case $opt in
        p) 
            process_name=$OPTARG
            ;;
        o) 
            outfile=$OPTARG
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

if [ ${process_name}"x" == "x" -o ${outfile}"x" == "x"  ];then
    Usage $0
    exit 1
fi

memory_record

exit 0
