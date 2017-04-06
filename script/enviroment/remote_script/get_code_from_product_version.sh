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
function get_version_code() {
    clear_path_content ${output}
    exit_if_error "clear_path_content ${output} failed"
    
    clear_path_content $output/../tmp
    cd  $output/../tmp

    scm_version_3wei=`echo $version | awk -F'.' '{print $1"."$2"."$3}'`
    assert_string_is_not_empty $scm_version_3wei
    
    wget "http://scm.baidu.com/http/queryModuleByThreeversion.action?cvspath=ps/wdm/itlg-ec1&version=$scm_version_3wei" -O VerInfo >/dev/null 2>&1
    exit_if_error "wget "http://scm.baidu.com/http/queryModuleByThreeversion.action?cvspath=ps/wdm/itlg-ec1&version=$scm_version_3wei" -O VerInfo failed"
    
    state=`cat VerInfo | sed 's/[\{|\}|"]//g' | awk -F',' '{for(i=1;i<=NF;i++){if($i ~ /^state/){gsub(/^state\:/,"",$i);print $i;}}}'`
    newest_version=`cat VerInfo | sed 's/[\{|\}|"]//g' | awk -F',' '{for(i=1;i<=NF;i++){if($i ~ /^version/){gsub(/^version\:/,"",$i);print $i;}}}' | sed 's/\./-/g'`

    assert_string_is_not_empty $state
    assert_string_is_not_empty $newest_version    

    if [ $state -eq 1 ]; then
        wget "http://scm.baidu.com/http/queryRDProductPathOfVersion.action?cvspath=ps/wdm/itlg-ec1&version=$version" -O Develping >/dev/null 2>&1
        exit_if_error "wget "http://scm.baidu.com/http/queryRDProductPathOfVersion.action?cvspath=ps/wdm/itlg-ec1&version=$version" -O Develping failed"

        scm_path=`cat Develping | sed 's/[\{|\}|"]//g' | awk -F',' '{if(NR==1){for(i=1;i<=NF;i++){if($i ~ /^result/){gsub(/^result\:/,"",$i);print $i}}}}'`
        echo $scm_path | awk '{if($0 ~ /^Not found the fourversion in the module/){exit 1;} exit 0}'
    elif [ $state -ne 1 ]; then
        wget "http://scm.baidu.com/http/getReleaseVersion.action?cvspath=ps/wdm/itlg-ec1&version=$scm_version_3wei" -O Release >/dev/null 2>&1
        exit_if_error "wget "http://scm.baidu.com/http/getReleaseVersion.action?cvspath=ps/wdm/itlg-ec1&version=$scm_version_3wei" -O Release failed "
        scm_path=`cat Release | awk '{if(NR==1){for(i=1;i<=NF;i++){if($i ~ /^getprod@/)print $i}}}' | awk -F'/' -v new_ver=$newest_version '{str=$1;for(i=2;i<NF;i++){str = str"/"$i};print str"/""itlg-ec1""_"new_ver"_PD_BL"}'`
        assert_string_is_not_empty $scm_path
    fi

    ftp_path=`echo $scm_path | sed -e 's/^.*getprod@/ftp:\/\//g'`
    dir_depth=`echo $ftp_path | awk -F'/' '{print NF-4}'`
	module_name_scm=`echo $scm_path | awk -F'/' '{print $NF}'`
    wget -nH --cut-dirs=$dir_depth -r -l 0 --user=getprod --password=getprod   $ftp_path >/dev/null 2>&1
    mv  $output/../tmp/$module_name_scm/output/* $output
}

##! @AUTHOR:
##! @VERSION: 1.0
##! @IN $1 => script name
function Usage() {
    local name=$1
    echo "Usage: $name  -v <version>  -o <output>   [-h]"
    echo "Ex: $name -v 3.0.1.0 -o /home/spider/2/output"
}

#----------------main----------------------#
while getopts "hv:o:" opt
do
    case $opt in
        v) 
            version=$OPTARG
            ;;
        o) 
            output=$OPTARG
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

if [ ${version}"x" == "x" -o ${output}"x" == "x" ];then
    Usage $0
    exit 1
fi
get_version_code
exit 0
