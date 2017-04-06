#!/bin/bash`

DC_DICT_MACHINE="spider@cq7210"
i=10
~/ci/lib/baselib/bin/go ${DC_DICT_MACHINE} "ps -ef | grep 'spider' | grep ${i}; cd /home/spider/platform_dc/script&&sh test.sh ${i}"

