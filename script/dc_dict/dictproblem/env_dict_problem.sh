#!/bin/bash

source ~/.bashrc
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

bak_dc_path="/home/spider/dc_dict/outcome/LineOndc/"
bak_dc_path_before="/home/spider/dc_dict/outcome/"
script_path="/home/spider/platform_dc/script/dictproblem"
rm -rf /home/spider/dc_dict/*
source ~/.bashrc
#sh Env.sh CN 0 1 >/dev/null  2 >err
nohup sh   Env.sh CN 0 1 >/dev/null &
wait
cd $bak_dc_path_before
if [[ ! -f succeed ]]
then
  exit_if_error "workspace  failed"  
fi
cp ${script_path}/dict_problem.sh ${bak_dc_path}/bin
echo "====================success==============="
exit 0
