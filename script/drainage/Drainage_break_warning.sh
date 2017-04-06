#!/bin/bash

CMD_CTL="/home/work/ci/lib/ps/spider/signserver/shell/signserver_simple_deploy/signserver_rebuild_tools/bin"

break_str=`echo -e "list"| ${CMD_CTL}/cmd_ctl cq01-testing-ps7219.cq01:9000 | awk '{if($5==0) print $1}'`
echo ${break_str}
