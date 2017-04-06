#!/bin/bash - 
#===============================================================================
#
#          FILE: requirement_report.sh
# 
#         USAGE: ./requirement_report.sh 
# 
#   DESCRIPTION: 
# 
#       OPTIONS: ---
#  REQUIREMENTS: ---
#          BUGS: ---
#         NOTES: ---
#        AUTHOR: yangyanhong (yyh), yangyanhong@baidu.com
#  ORGANIZATION: Baidu
#       CREATED: 2015-05-08
#      REVISION:  ---
#===============================================================================
DATA_PATH="/home/work/ec_test_service/src/commands"
source "/home/work/ec_test_service/config/warninglevel_requirement"
source ${SEND_MSG_SH}

    REPORT="requirementReport.txt"
    send_mail_msg -t 0 -s "requirement description" -p "${DATA_PATH}/${REPORT}" >/dev/null 2>&1
    rm ${DATA_PATH}/${REPORT}
    rm /home/work/ec_test_service/config/warninglevel_requirement
