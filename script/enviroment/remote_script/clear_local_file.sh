#!/bin/bash

. /home/spider/.bashrc

DATA_PATH="/home/spider/remote_ecplatform/workspace"

Old_Day=`date -d "-7 days" +%Y%m%d`
Old_Dir=$DATA_PATH/$Old_Day
if [ -d ${Old_Dir} ]; then
  rm -rf ${Old_Dir}
fi
exit 0
