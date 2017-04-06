#!/bin/bash

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
##! @RETURN: script absolute path
function get_script_abs_path() {
    local script_path=`dirname $(readlink -f $BASH_SOURCE)`
    echo $script_path
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN: $1 => file path
function parse_to_abs_path() {
    local file_path=$1
    echo "${file_path}" | grep "^/" >/dev/null
    local retval=$?
    if [ $retval -ne 0 ];then
        local script_path=`get_script_abs_path`
        assert_string_is_not_empty "${script_path}"
        local file_path=${script_path}"/"${file_path}
    fi
    echo "${file_path}"
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN: $1 => dir name
function assert_local_dir_does_not_exist() {
	if [ -d $1 ];then
        echo "[FATAL] local dir "$1"  should not exist!"
        exit 1
    fi
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN: $1 => dir name
function assert_local_dir_exist() {
	if [ ! -d $1 ];then
        echo "[FATAL] local dir "$1"  should exist!"
        exit 1
    fi
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN: $1 => file name
function assert_local_file_exist() {
	if [ ! -f $1 ];then
        echo "[FATAL] local file "$1" does not exist!"
        exit 1
    fi
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => product file
##! @IN $2 => product deploy path
function unzip_module_to_target_path() {
    assert_string_is_not_empty "${TMP_UNZIP_DIR}"
    rm -rf $TMP_UNZIP_DIR/*

    local product_file=$1
    local deploy_path=$2
    assert_local_file_exist "${product_file}"

    assert_local_dir_does_not_exist "${deploy_path}"
    mkdir -p ${deploy_path}
    exit_if_error "mkdir -p ${deploy_path} failed"

    tar -zxvf ${product_file} -C ${TMP_UNZIP_DIR}
    exit_if_error "tar -zxvf ${product_file} -C ${TMP_UNZIP_DIR} failed"

    local product_name=`ls $TMP_UNZIP_DIR`
    assert_string_is_not_empty "$product_name"

    mv ${TMP_UNZIP_DIR}/${product_name}/* ${deploy_path}
    exit_if_error "mv ${TMP_UNZIP_DIR}/${product_name}/* ${deploy_path} failed"
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => original string
function convert_slash() {
    local original_string=$1
    local convert_string=`echo $original_string | awk -F '/' '{
        for (i = 1; i < NF; ++i) {
            printf("%s\\\/",$i);
        }
        printf("%s\n",$NF);
    }'`
    echo "$convert_string"
}

##! @AUTHOR:
##! @VERSION: 1.0
function convert_quatation() {
    local original_string=$1
    local convert_string=`echo $original_string | awk -F '"' '{
        for (i = 1; i < NF; ++i) {
            printf("%s\"",$i);
        }
        printf("%s\n",$NF);
    }'`
    echo "$convert_string"
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => pattern
##! @IN $2 => file
function assert_pattern_is_in_file() {
    local pattern=$1
    local file=$2
    local matched_line=`grep "$pattern" $file | wc -l`
    if [ $matched_line -le 0 ];then
        echo "[FATAL] pattern <$pattern> can not be found in file <$file>"
        exit 1
    fi
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => replaced file
##! @IN $2 => replaced pattern
##! @IN $3 => new string
function replace_string_in_file() {
    assert_string_is_not_empty "$TMP_FILE_DIR"
    local replaced_file=$1
    local replaced_pattern="`convert_slash "$2"`"
    local replaced_pattern="`convert_quatation "$replaced_pattern"`"
    assert_string_is_not_empty $replaced_file
    local new_string="`convert_slash "$3"`"
    local new_string="`convert_quatation "$new_string"`"

    assert_pattern_is_in_file "$replaced_pattern" "$replaced_file"
    cat $replaced_file | sed 's/'"$replaced_pattern"'/'"$new_string"'/g' > ${TMP_FILE_DIR}/tmp_file
    exit_if_error "replace string using sed failed"
    mv $TMP_FILE_DIR/tmp_file $replaced_file
    exit_if_error "mv $TMP_FILE_DIR/tmp_file $replaced_file failed"
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => xml file
##! @IN $2 => key
##! @IN $3 => value
function add_property_to_xml() {
    local xml_file=$1
    local key=$2
    local value=$3
    replace_string_in_file "$xml_file" "</configuration>" ""
    echo "    <property>" >> $xml_file
    exit_if_error "append xml_file failed"
    echo "        <name>$key</name>" >> $xml_file
    exit_if_error "append xml_file failed"
    echo "        <value>$value</value>" >> $xml_file
    exit_if_error "append xml_file failed"
    echo "    </property>" >> $xml_file
    exit_if_error "append xml_file failed"
    echo "</configuration>" >> $xml_file
    exit_if_error "append xml_file failed"
}

##! @AUTHOR:
##! @VERSION: 1.0
function make_env() {
    local script_path=`get_script_abs_path`
    assert_string_is_not_empty "${script_path}"
    local conf_file=`parse_to_abs_path "$1"`
    assert_string_is_not_empty "${conf_file}"

    assert_local_file_exist "$conf_file"
    source ${conf_file}

    assert_string_is_not_empty "${TMP_DIR}"
    assert_local_dir_does_not_exist "${TMP_DIR}"
    mkdir -p ${TMP_DIR}
    exit_if_error "mkdir -p ${TMP_DIR} failed"

    TMP_SVN_DIR="${TMP_DIR}/svn"
    mkdir -p ${TMP_SVN_DIR}
    exit_if_error "mkdir -p ${TMP_SVN_DIR} failed"

    TMP_UNZIP_DIR="${TMP_DIR}/unzip"
    mkdir -p "${TMP_UNZIP_DIR}"
    exit_if_error "mkdir -p ${TMP_UNZIP_DIR} failed"
    TMP_FILE_DIR="${TMP_DIR}/unzip"
    mkdir -p "${TMP_FILE_DIR}"
    exit_if_error "mkdir -p ${TMP_FILE_DIR} failed"
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => product file on svn
##! @RETURN product file on local
function get_product_from_svn() {
    local svn_path=$1
    rm -f $TMP_SVN_DIR/*
    svn cat ${svn_path} > ${TMP_SVN_DIR}/product.tar.gz
    exit_if_error "svn cat ${svn_path} > ${TMP_SVN_DIR}/product.tar.gz failed"
    echo `ls $TMP_SVN_DIR/*.tar.gz`
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => file dir path which will be used to replace other files
##! @IN $2 => file dir path whose some files will be replaced
function replace_files() {
    local to_replace_files_path=$1
    assert_local_dir_exist ${to_replace_files_path}

    local be_replaced_files_path=$2
    assert_local_dir_exist ${be_replaced_files_path}

    cp -r ${to_replace_files_path}/* ${be_replaced_files_path}
    exit_if_error "cp -r ${to_replace_files_path}/* ${be_replaced_files_path} failed"
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => alias path which will be defined in ~/.bashrc
function add_alias_into_bashrc(){
    local alias_path=$1
    echo alias ${alias_path} >> ~/.bashrc
    exit_if_error "echo alias ${alias_path} >> ~/.bashrc failed"
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => script name
function Usage() {
    local name=$1
    echo "Usage: sh -x $name [-c <configure_file>] [-h]"
    echo "Ex: sh -x $name "
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => conf path
function source_conf_file(){
    local conf_file=$1
    assert_string_is_not_empty "${conf_file}"
    assert_local_file_exist "$conf_file"
    source ${conf_file}
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
##! @IN $1 => source dir
##! @IN $2 => dest dir
function cp_all_dir_to_another_dir(){
    local source_dir=$1
    local dest_dir=$2

    assert_local_dir_exist "${source_dir}"
    assert_local_dir_exist "${dest_dir}"
    cp -r ${source_dir} ${dest_dir}
    exit_if_error "cp -r ${source_dir} ${dest_dir} failed"
}