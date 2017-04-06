#!/bin/bash

source ~/.bashrc
source ~/.bash_profile

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
##! @IN: $1 => dir name
function assert_local_dir_or_file_exist() {
	if [ -d $1  -o -f $1 ];then
		continue
    else
        echo "[FATAL] local dir or file "$1"  should exist!"
        exit 1
    fi
}


##! @AUTHOR:
##! @VERSION: 1.0
function generate_new_code() {
    assert_local_dir_or_file_exist $old_code_path
    assert_local_dir_or_file_exist $dict_path
    assert_local_dir_or_file_exist $output_path

    cp -r $old_code_path/* $output_path
    exit_if_error "cp -r $old_code_path/* $output_path failed"
    echo "cp old_code_path out_path success"

    cp -r $dict_path/* $output_path/conf 
    exit_if_error "cp -r $dict_path/* $output_path/conf  failed"
    echo "cp dict to out_path success"
}


##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => script name
function Usage() {
    local name=$1
    echo "Usage: $name -d <dict_path> -p <old_code_path> -o <output_path>"
    echo "Ex: $name -d /home/spider/outputpath -p /home/spider/outputpath -o /home/spider/outputpath"
}

#----------------main----------------------#
while getopts "hd:p:o:" opt
do
    case $opt in
        d) 
            dict_path=$OPTARG
            ;;
        p) 
            old_code_path=$OPTARG
            ;;
        o) 
            output_path=$OPTARG
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

if [ ${dict_path}"x" == "x" -o ${old_code_path}"x" == "x" -o ${output_path}"x" == "x" ];then
    Usage $0
    exit 1
fi

generate_new_code

exit 0
