#!/bin/bash
#===============================================================================
#
#          FILE: dict_problem.sh
# 
#         USAGE: sh dict_problem.sh url del_reason flag
# 
#   DESCRIPTION: 
# 
#       OPTIONS: ---
#  REQUIREMENTS: ---
#          BUGS: ---
#         NOTES: ---
#        AUTHOR: yangyanhong (yyh), yangyanhong@baidu.com
#  ORGANIZATION: Baidu
#       CREATED: 2015年05月27日 13时31分 CST
#      REVISION:  ---
#===============================================================================
#set -o nounset                              # Treat unset variables as an error
set -o pipefail
set -o errexit
trap "echo Fail unexpectedly on line \$LINENO!" ERR
RESULT_PATH="/home/spider/platform_dc/script/dictproblem"
RESULT_FILE="check_dict_result"
function wget_file()
{
    ftp_path=${URL}
    local path_num=`echo ${ftp_path} | awk -F "/" 'END{print NF-4 }'`
    file=`echo ${ftp_path} | awk -F "/" 'END{print $NF }'`
    echo -e "ftp_path=${ftp_path}; path_num=${path_num}"
    wget -r -nH --preserve-permissions --level=0 --cut-dirs=${path_num} ${ftp_path}  >/dev/null 2>&1
    if [ $? -ne 0 ] 
    then
       exit 1
    fi
    if [ ! -f ${file} ]
    then
       exit 1
    fi
}
function check_dict()
{
    URL=$1
    DEL_REASON=$2
    if [ ${DEL_REASON} -eq 30 ]
    then
        echo "${URL}"| ./tl_pattern -a ../conf/pattern >${RESULT_PATH}/result_tmp
        cat ${RESULT_PATH}/result_tmp |awk 'BEGIN{FS="\t";OFS="\t";}{print $0""OFS"""pattern"}' \
>>${RESULT_PATH}/${RESULT_FILE}
    elif [ ${DEL_REASON} -eq 38 ]
    then
        echo "${URL}"|./tl_pcre -a ../conf/pcre >${RESULT_PATH}/result_tmp
        cat ${RESULT_PATH}/result_tmp |awk 'BEGIN{FS="\t";OFS="\t";}{print $0""OFS"""pattern"}' \
>>${RESULT_PATH}/${RESULT_FILE}
         
    fi
}

function check_flag()
{
    if [ -f ${RESULT_PATH}/${RESULT_FILE}.flag ]
    then
        result=`cat ${RESULT_PATH}/${RESULT_FILE}.flag`
        if [ ${result} != "success" ]
        then
            echo "pending" >${RESULT_PATH}/dict_page.flag
            echo "no" 
        else
            echo "ok"
        fi
    else
       echo "pending" >${RESULT_PATH}/dict_page.flag
       echo "no"   
    fi
}
#==============check last run status==============
while [ 1 ];
do
    last_flag=$(check_flag)
    if [ ${last_flag} == "ok" ]
    then    
        break
    else
        sleep 10
    fi
done
rm ${RESULT_PATH}/${RESULT_FILE}.flag 
#============check parameters================
if [ $# -lt 3 ]
then
   echo "sh -x dict_problem.sh url del_reason flag"
   exit 1
fi
#===============run begin====================
date_str=`date '+%Y%m%d%H%M%S'`
#check result file
if [ -f ${RESULT_PATH}/${RESULT_FILE} ]
then
   mv ${RESULT_PATH}/${RESULT_FILE} ${RESULT_PATH}/bak/${RESULT_FILE}.${date_str}
   touch ${RESULT_PATH}/${RESULT_FILE} ${RESULT_PATH}
fi
URL=$1
DEL_REASON=$2
FLAG=$3
if [ ${FLAG} -eq 1 ]
then
    check_dict ${URL} ${DEL_REASON}
    echo "success" >${RESULT_PATH}/${RESULT_FILE}.flag
    echo "success" >${RESULT_PATH}/dict_page.flag
    echo "================success==================="
elif [ ${FLAG} -eq 2 ]
then
    #wget file
    file=`echo ${URL} | awk -F "/" 'END{print $NF }'`
    wget_file ${URL}
    cat ${file} |while read line
    do
       url=`echo $line |awk '{print $1}'`
       del_reason=`echo $line |awk '{print $2}'`
       echo ${del_reason}
       check_dict  ${url} ${del_reason}

    done
    echo "success" >${RESULT_PATH}/${RESULT_FILE}.flag
    echo "success" >${RESULT_PATH}/dict_page.flag
    echo "================success==================="
fi

