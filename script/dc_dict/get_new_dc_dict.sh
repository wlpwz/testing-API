#!/bin/bash

source ~/.bashrc
source ~/.bash_profile

MYSQL="mysql"
HOST="10.94.50.19"
PORT="3306"
USER="root"
PASSWORD="521aladdin"
DATABASE="project_ktv"
TABLE_DC_DICT="dictionary"

HADOOP="/home/spider/tools/hadoop-client/hadoop/bin/hadoop"
SVN="/home/spider/tools/subversion/bin/svn"
SVN_PATH="https://svn.baidu.com/ps-test/spider/trunk/autolib/ps/spider/kb/lib/kb-ft/dc_dict"

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
function wget_ftp() {
    local ftp_path=$1
    local output_path=$2

    assert_string_is_not_empty $ftp_path
    assert_string_is_not_empty $output_path
    
    assert_local_dir_or_file_exist $output_path
    cd $output_path

    local path_num=`echo $ftp_path | awk -F "/" 'END{print NF-3 }'`
    echo -e "ftp_path=$ftp_path; path_num=$path_num"
    wget -r -nH --preserve-permissions --level=0 --cut-dirs=$path_num $ftp_path  >/dev/null 2>&1
    exit_if_error "wget -r -nH --preserve-permissions --level=0 --cut-dirs=$path_num $ftp_path failed" 
}

##! @AUTHOR:
##! @VERSION: 1.0
function get_new_dc_dict_from_ftp() {
    local dict_source_value=${dict_source#*:}
    echo $dict_source_value
    wget_ftp $dict_source_value  $output_path
    echo "get_new_dc_dict_ftp success"
}

##! @AUTHOR:
##! @VERSION: 1.0
function get_new_dc_dict_from_hdfs() {
    local dict_source_value=${dict_source#*:}
    echo $dict_source_value
    $HADOOP dfs -get $dict_source_value $output_path
    exit_if_error "$HADOOP dfs -get $dict_source_value $output_path failed"
    echo "get_new_dc_dict_from_hdfs success"
}

##! @AUTHOR:
##! @VERSION: 1.0
function get_new_dc_dict_from_svn() {
    local dict_source_value=${dict_source#*:}
    echo $dict_source_value
    $SVN  co  $SVN_PATH $output_path -r $dict_source_value  
    exit_if_error "svn  co  $SVN_PATH $output_path -r $dict_source_value failed"
    echo "get_new_dc_dict_from_svn success"
}

##! @AUTHOR:
##! @VERSION: 1.0
function get_new_dc_dict() {
    dict_source=`echo -e "use ${DATABASE}; select source from ${TABLE_DC_DICT}  where id=${task_id}" | $MYSQL -h${HOST} -P${PORT} -u${USER} -p${PASSWORD} | awk  '{ if (NR==2) {print $1}}'` 
    local dict_source_choice=`echo $dict_source | awk -F ":" '{print $1}'`
    echo $dict_source 
    if [ $dict_source_choice"x" == "1x" ];then
        get_new_dc_dict_from_ftp 
    elif [ $dict_source_choice"x" == "2x" ];then
        get_new_dc_dict_from_hdfs 
    elif [ $dict_source_choice"x" == "3x" ];then
        get_new_dc_dict_from_svn 
    fi
}


##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => script name
function Usage() {
    local name=$1
    echo "Usage: $name  -t <task_id> -o <out_path>"
    echo "Ex: $name -t 10 -o /home/spider/outputpath"
}

#----------------main----------------------#
while getopts "ht:o:" opt
do
    case $opt in
        t) 
            task_id=$OPTARG
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

if [ ${task_id}"x" == "x" -o ${output_path}"x" == "x" ];then
    Usage $0
    exit 1
fi

get_new_dc_dict

exit 0
