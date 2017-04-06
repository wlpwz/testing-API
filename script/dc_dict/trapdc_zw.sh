#!/bin/bash

dc_conf_path=$1
doit=$2

cache_port=`cat $dc_conf_path/cache.conf |grep CachePort|awk -F ":" '{print $2}'`
wdn_port=`cat $dc_conf_path/wdn.conf |grep CachePort|awk -F ":" '{print $2}'`
saver_port=`cat $dc_conf_path/saver.conf |grep SaverPort|awk -F ":" '{print $2}'`
xpath_port=`cat $dc_conf_path/xpath.conf |grep CachePort|awk -F ":" '{print $2}'`
mainlink_port=`cat $dc_conf_path/mainlink.conf |grep MainlinkPort|awk -F ":" '{print $2}'`
gfw_port=`cat $dc_conf_path/gfw.conf |grep CachePort|awk -F ":" '{print $2}'`
wisecache_port=`cat $dc_conf_path/wise_cache.conf | grep CachePort| awk -F ":" '{print $2}'`
wdnvideo_port=`cat $dc_conf_path/wdn_video.conf | grep WdnVideoPort| awk -F ":" '{print $2}'`
imag_port=`cat $dc_conf_path/img_cache.conf | grep CachePort| awk -F ":" '{print $2}'`
tn_port=`cat $dc_conf_path/tn_cache.conf | grep CachePort| awk -F ":" '{print $2}'`
#filtLinkSrcType_port=`cat $dc_conf_path/filter_ccdb.conf | grep CachePort| awk -F ":" '{print $2}'`

new_port=`cat $dc_conf_path/page_extract_socket.conf | grep PageExtractPort| awk -F ":" '{print $2}'`

NUlldata()
{
    ~/ci/lib/baselib/bin/trapdc.pl -s $saver_port 3>/dev/null &
    ~/ci/lib/baselib/bin/trapdc.pl -w $cache_port 4>/dev/null  &
    ~/ci/lib/baselib/bin/trapdc.pl -w $wdn_port 4>/dev/null &
    ~/ci/lib/baselib/bin/trapdc.pl -w $xpath_port 4>/dev/null &
    ~/ci/lib/baselib/bin/trapdc.pl -w $mainlink_port 4>/dev/null &
    ~/ci/lib/baselib/bin/trapdc.pl -w $gfw_port 4>/dev/null &
    ~/ci/lib/baselib/bin/trapdc.pl -w $wisecache_port 4>/dev/null &
    ~/ci/lib/baselib/bin/trapdc.pl -w $wdnvideo_port 4>/dev/null &
    ~/ci/lib/baselib/bin/trapdc.pl -w $imag_port 4>/dev/null &
    ~/ci/lib/baselib/bin/trapdc.pl -w $tn_port 4>/dev/null &
    ~/ci/lib/baselib/bin/trapdc.pl -w $new_port 4>/dev/null &
 #   ~/ci/lib/baselib/bin/trapdc.pl -w $filtLinkSrcType_port 4>/dev/null &
}

Fulldata()
{
    ~/ci/lib/baselib/bin/trapdc.pl -s $saver_port 3>saver &
    ~/ci/lib/baselib/bin/trapdc.pl -w $cache_port 4>cache  &
    ~/ci/lib/baselib/bin/trapdc.pl -w $wdn_port 4>wdn &
    ~/ci/lib/baselib/bin/trapdc.pl -w $xpath_port 4>xpath &
    ~/ci/lib/baselib/bin/trapdc.pl -w $mainlink_port 4>mainlink &
    ~/ci/lib/baselib/bin/trapdc.pl -w $gfw_port 4>gfw &
    ~/ci/lib/baselib/bin/trapdc.pl -w $wisecache_port 4>wisecache &
    ~/ci/lib/baselib/bin/trapdc.pl -w $wdnvideo_port 4>wdnvideo &
    ~/ci/lib/baselib/bin/trapdc.pl -w $imag_port 4>image &
    ~/ci/lib/baselib/bin/trapdc.pl -w $tn_port 4>tn &
    ~/ci/lib/baselib/bin/trapdc.pl -w $new_port 4>new_port &
  #  ~/ci/lib/baselib/bin/trapdc.pl -w $filtLinkSrcType_port 4>filtLST &
}

if [ $doit -eq 0 ];then
    NUlldata
elif [ $doit -eq 1 ];then
    Fulldata
else
    echo "sh GetDcConfPort.sh pathconf 0 or sh GetDcConfPort.sh pathconf 1"
fi

