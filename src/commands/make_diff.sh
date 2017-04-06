 #!/bin/bash
source ~/.bash_profile

new_result=$1
old_result=$2
diffpath=/home/work/platform_dc/diff/$4/$3
mkdir -p $diffpath
cd $diffpath
wget $new_result/cache -O cache.new
wget $old_result/cache -O cache.old
wget $new_result/saver -O saver.new
wget $old_result/saver -O saver.old
mkdir -p $diffpath/diffcache
cd $diffpath/diffcache
~/ci/lib/baselib/bin/diffpack $diffpath/cache.new $diffpath/cache.old > diffcache
cd ..
mkdir -p $diffpath/diffsaver
cd $diffpath/diffsaver
~/ci/lib/baselib/bin/diffpacket $diffpath/saver.new $diffpath/saver.old > diffsaver
