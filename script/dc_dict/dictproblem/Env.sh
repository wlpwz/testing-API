#!/bin/bash
source pre.conf
path=$Installpath
Pwdpath=`pwd`
ValPre= $ValgrindPrefix
ValInstallPath=$ValgrindPath
Mypath="$path/outcome"
MyFtp="$path/ftp"
LineOnDcConf="$Mypath/LineOndc/conf"
LineOffDcConf="$Mypath/LineOffdc/conf"
LineOnDcBin="$Mypath/LineOndc/bin"
LineOffDcBin="$Mypath/LineOffdc/bin"
HK_LineOnDcConf="$Mypath/HK_LineOndc/conf"
HK_LineOffDcConf="$Mypath/HK_LineOffdc/conf"
HK_LineOnDcBin="$Mypath/HK_LineOndc/bin"
HK_LineOffDcBin="$Mypath/HK_LineOffdc/bin"

#################################help

if [ $# -ne 2 ];then
   echo "搭建中文线上版本DC环境：sh Env.sh CN 0 ;"
   echo "搭建中文线下版本DC环境：sh Env.sh CN 1 ;"
   echo "搭建中文数据diffDC环境：sh Env.sh CN 2 ;"
   echo "搭建国际化线上版本DC：  sh Env.sh HK 0 ;"
   echo "搭建国际化线下版本DC：  sh Env.sh HK 1 ;"
fi
#####################################清理工作#######################################################################################
function clearenv()
{
	#清理工作
	killall trapdc.pl
	for dis in `ps aux |grep -v grep|grep dis|grep spider|awk '{print $2}'`
	do
        	kill -9 $dis
	done

	#准备工作
	if [ ! -d "$Mypath" ]; then
		mkdir "$Mypath"
	else
		echo "outcome existed!"
		rm -r $Mypath
		mkdir "$Mypath"
	fi
}

###################################创建总目录####################################################################################
##创建总目录
#Mypath="$path/outcome"
#if [ ! -d "$Mypath" ]; then
#mkdir "$Mypath"
#else
#echo "outcome existed!"
#rm -r $Mypath
#mkdir "$Mypath"
#fi

###################################判断DC是否启动成功###########################################################################
##判断DC是否启动成功
StartedPd()
{
count=0
num=0
while true
do
    sleep 1
    ((num++))
    cpuinfo=`top -b -n 1|grep distribute2|awk '{cpu=int($9);if(cpu == 0){print 1}else{print 0}}'`
    if [[ $cpuinfo -eq 1 ]];then
         ((count++))
    else
         count=0
    fi
    if [[ $count -gt 5 ]];then
        touch $Mypath/succeed
        break
    fi
    if [[ $num -eq 500 ]];then
        touch $Mypath/failed
        break
    fi
done
}

##########################判断是否要新增词典##############################################################################
##判断是否新增词典
#MyFtp="$path/ftp"
IsFtp()
{
    num=`ls $MyFtp | wc  -l `
    if [ $num -ne 0 ]; then
        return 1
    else
        return 0
    fi
}
                          
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@#
#####################中文#####################################################################################################
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@#

##########################
#拉取线上DC 
GetLineOnDc()
{
    mkdir log
    mkdir status
    wget -r -nH --preserve-permissions --level=0 --cut-dirs=3 --retr-symlinks  ftp://db-spi-ddc1.db01.baidu.com/home/spider/dc/bin
    wget -r -nH --preserve-permissions --level=0 --cut-dirs=3 --retr-symlinks  ftp://db-spi-ddc1.db01.baidu.com/home/spider/dc/conf
    wget -r -nH --preserve-permissions --level=0 --cut-dirs=3 --retr-symlinks  ftp://db-spi-ddc1.db01.baidu.com/home/spider/dc/lib
    #wget -r -nH --preserve-permissions --level=0 --cut-dirs=3 --retr-symlinks  ftp://cq01-stest-dc1.cq01/home/spider/dc/bin
    #wget -r -nH --preserve-permissions --level=0 --cut-dirs=3 --retr-symlinks  ftp://cq01-stest-dc1.cq01/home/spider/dc/conf
}

#修改线上DC的配置
ModifyDcOnlineConf()
{
    ######################启动并配置新dc############################################################################################
    #  sed -e 'nc/just do it' file
    #cd $Mypath/LineOndc/conf
    cd $LineOnDcConf
    sed -i 's/info_collect_level:1/info_collect_level:3/g' distribute2.conf

    #修改线程数
    sed -i 's/#ec_thread_num : 1/ec_thread_num : 10/g' distribute2.conf
    #sed -i 's/mon_listen_port : 9236/mon_listen_port : 19236/g' distribute2.conf
	sed -i 's/esp_port :  9236/esp_port :  19236/g' distribute2.conf
    sed -i 's/^COMLOG_DEVICE_NUM.*$/COMLOG_DEVICE_NUM : 2/' distribute2.conf
    sed -i 's/ec_listen_urgent_port : 9237/ec_listen_urgent_port : 19237/g' distribute2.conf

    sed -i 's/BIGPIPE1_BIGPIPE_PIPENAME : spider-dc-pipe/BIGPIPE1_BIGPIPE_PIPENAME : pipe1/g' distribute2.conf
    sed -i 's/BIGPIPE1_BIGPIPE_TOKENNAME : spiderdc-PUB/BIGPIPE1_BIGPIPE_TOKENNAME : token/g' distribute2.conf

    less distribute2.conf  | awk -F ":" -v ip=$Ec2Dcip '{if($1!="ip-access-grant ")print $0;else print $0";"ip}' >distribute2.conf1
    less distribute2.conf1 | awk -F ":" -v port=$Ec2DcPortOn '{if($1!="ec_listen_port ")print $0;else print $1":"port}' >distribute2.conf2
    less distribute2.conf2 | awk -F ":" -v port=$EcThreadNum '{if($1!="ec_thread_num ")print $0;else print $1":"port}'> distribute2.conf3
    cp distribute2.conf3 distribute2.conf
    rm distribute2.conf1 distribute2.conf2 distribute2.conf3
    
    #saver
    less saver.conf |awk -F ":" -v ip=$Ec2DcSaverIpOn '{if($1!="SaverIP")print $0;else print $1":"ip}' >saver.conf.tmp
    less saver.conf.tmp |awk -F ":" -v port=$EC2DcSaverPortOn '{if($1!="SaverPort")print $0;else print $1":"port}' >saver.conf
    rm saver.conf.tmp

    #cache
    less cache.conf |awk -F ":" -v ip=$Ec2DcCacheIpOn '{if($1!="CacheIp")print $0;else print $1":"ip}' >cache.conf.tmp
    less cache.conf.tmp |awk -F ":" -v port=$EC2DcCachePortOn '{if($1!="CachePort")print $0;else print $1":"port}' >cache.conf
    rm cache.conf.tmp

    #wdn
    less wdn.conf |awk -F ":" -v ip=$Ec2DcWdnIpOn '{if($1!="CacheIp")print $0;else print $1":"ip}' >wdn.conf.tmp
    less wdn.conf.tmp |awk -F ":" -v port=$EC2DcWdnPortOn '{if($1!="CachePort")print $0;else print $1":"port}' >wdn.conf
    rm wdn.conf.tmp

    #wisecache
    less wise_cache.conf |awk -F ":" -v ip=$Ec2DcWiseCacheIpOn '{if($1!="CacheIp")print $0;else print $1":"ip}' >wisecache.conf.tmp
    less wisecache.conf.tmp |awk -F ":" -v port=$EC2DcWiseCachePortOn '{if($1!="CachePort")print $0;else print $1":"port}' >wise_cache.conf
    rm wisecache.conf.tmp

    #xpath
    less xpath.conf |awk -F ":" -v ip=$Ec2DcXpathIpOn '{if($1!="CacheIp")print $0;else print $1":"ip}' >xpath.conf.tmp
    less xpath.conf.tmp |awk -F ":" -v port=$EC2DcXpathPortOn '{if($1!="CachePort")print $0;else print $1":"port}' >xpath.conf
    rm xpath.conf.tmp

    #gfw
    less gfw.conf |awk -F ":" -v ip=$Ec2DcGfwIpOn '{if($1!="CacheIp")print $0;else print $1":"ip}' >gfw.conf.tmp
    less gfw.conf.tmp |awk -F ":" -v port=$EC2DcGfwPortOn '{if($1!="CachePort")print $0;else print $1":"port}' >gfw.conf
    rm gfw.conf.tmp

    #mainlink
    less mainlink.conf |awk -F ":" -v ip=$Ec2DcMainlinkIpOn '{if($1!="MainlinkIP")print $0;else print $1":"ip}' >mainlink.conf.tmp
    less mainlink.conf.tmp |awk -F ":" -v port=$EC2DcMainlinkPortOn '{if($1!="MainlinkPort")print $0;else print $1":"port}' >mainlink.conf
    rm mainlink.conf.tmp

    #WdnVideo
    less wdn_video.conf |awk -F ":" -v ip=$Ec2DcWdnVideoIpOn '{if($1!="WdnVideoIp")print $0;else print $1":"ip}' >wdn_video.conf.tmp
    less wdn_video.conf.tmp |awk -F ":" -v port=$EC2DcWdnVideoPortOn '{if($1!="WdnVideoPort")print $0;else print $1":"port}' >wdn_video.conf
    rm wdn_video.conf.tmp

    #img_cache
    less img_cache.conf | awk -F ":" -v ip=$Ec2DcImagCacheIpOn '{if($1!="CacheIp")print $0;else print $1":"ip}' >imag_cache.conf.tmp
    less imag_cache.conf.tmp |awk -F ":" -v port=$EC2DcImagCachePortOn '{if($1!="CachePort")print $0;else print $1":"port}' >img_cache.conf
    rm  imag_cache.conf.tmp

    #tn_cache.conf
    less tn_cache.conf | awk -F ":" -v ip=$Ec2DcTnCacheIpOn '{if($1!="CacheIp")print $0;else print $1":"ip}' >tu_cache.conf.tmp
    less tu_cache.conf.tmp |awk -F ":" -v port=$EC2DcTnCachePortOn '{if($1!="CachePort")print $0;else print $1":"port}' >tn_cache.conf
    rm  tu_cache.conf.tmp

	#page_extract_socket.conf 
	less page_extract_socket.conf | awk -F ":" -v ip=$Ec2DcPageExtractIpOn '{if($1!="PageExtractIP")print $0;else print $1":"ip}' >tu_cache.conf.tmp
	less tu_cache.conf.tmp |awk -F ":" -v port=$EC2DcPageExtractPortOn '{if($1!="PageExtractPort")print $0;else print $1":"port}' >page_extract_socket.conf
	rm  tu_cache.conf.tmp
			

}

ModifyIndexConf()
{
    cp $Pwdpath/Index/wap_dup_ss.conf .
    cp $Pwdpath/Index/dedup_domain.conf .
    cp $Pwdpath/Index/bigpipe.conf .
    cp $Pwdpath/Index/redir_type_ss.conf .
}

StartDc()
{
    export LD_LIBRARY_PATH=`pwd`
    nohup ./distribute2 -c ../conf/distribute2.conf 1>log 2>err &
    sleep 60
    StartedPd
}

GetProduct()
{
    cd $Pwdpath/Index/

    #拉取frame
    mkdir frame
    cd frame
    wget -r -nH --preserve-permissions --level=0 --cut-dirs=9 ftp://getprod:getprod@product.scm.baidu.com:/data/prod-unit/prod-64/ps/spider/frame-dc/frame/$FrameVersion/product
    num=`ls|wc -l`
    if [ $num -eq 0 ];then
    wget -r -nH --preserve-permissions --level=0 --cut-dirs=7 ftp://getprod:getprod@product.scm.baidu.com:/data/prod-64/ps/spider/frame-dc/frame/$FrameVersion
    fi
    cd ..
    
    #拉取startegy
    mkdir strategy
    cd strategy
    wget -r -nH --preserve-permissions --level=0 --cut-dirs=9 ftp://getprod:getprod@product.scm.baidu.com:/data/prod-unit/prod-64/ps/spider/frame-dc/strategy/$StrategyVersion/product
    num=`ls|wc -l`
    if [ $num -eq 0 ];then
    wget -r -nH --preserve-permissions --level=0 --cut-dirs=7 ftp://getprod:getprod@product.scm.baidu.com:/data/prod-64/ps/spider/frame-dc/strategy/$StrategyVersion
    fi
    cd ..

    # cd $path/outcome/LineOffdc/bin
    if [ $1 -eq 0 ];then
        cd $LineOffDcBin
    else
        cd $HK_LineOffDcBin
    fi
   
    cp -r $Pwdpath/Index/frame/output/bin/* .
    cp -r $Pwdpath/Index/strategy/output/bin/* .
    cd ..

    cd conf
    cp -r $Pwdpath/Index/conf/* .
    cp -r $Pwdpath/Index/dictionary/* .
    cd ..
    
    cd lib
    cp -r $Pwdpath/Index/lib/* .
    #cp -r $Pwdpath/Index/frame/output/conf/* .
    #cp -r $Pwdpath/Index/strategy/output/conf/* .
    cd ..

    #清理
    cd $Pwdpath/Index/
    rm -r frame
    rm -r strategy
    
}




LineOnDc()
{
    mkdir $Mypath/LineOndc
    cd $Mypath/LineOndc/
    #1.拉取线上DC
    GetLineOnDc
    
    #2.修改线上DC的conf
    ModifyDcOnlineConf
    
    #3.修改Index的conf
    #cd $path/outcome/LineOndc/conf
    cd $LineOnDcConf
    ModifyIndexConf
    
    #4.启动DC
    #cd $Mypath/LineOndc/bin
    cd $LineOnDcBin
    StartDc
}


ModifyDcOffConf()
{
    ##################################################################################################################
    #cd $path/outcome/LineOffdc/conf
    cd $LineOffDcConf
    
    sed -i 's/info_collect_level:1/info_collect_level:3/g' distribute2.conf
	
    #修改线程数
    sed -i 's/#ec_thread_num : 1/ec_thread_num : 10/g' distribute2.conf
    #sed -i 's/mon_listen_port : 9236/mon_listen_port : 29236/g' distribute2.conf
    sed -i 's/esp_port :  9236/esp_port :  29236/g' distribute2.conf
	sed -i 's/ec_listen_urgent_port : 9237/ec_listen_urgent_port : 29237/g' distribute2.conf

    sed -i 's/^COMLOG_DEVICE_NUM.*$/COMLOG_DEVICE_NUM : 2/' distribute2.conf
    sed -i 's/BIGPIPE1_BIGPIPE_PIPENAME : spider-dc-pipe/BIGPIPE1_BIGPIPE_PIPENAME : pipe1/g' distribute2.conf
    sed -i 's/BIGPIPE1_BIGPIPE_TOKENNAME : spiderdc-PUB/BIGPIPE1_BIGPIPE_TOKENNAME : token/g' distribute2.conf

    
    less distribute2.conf  | awk -F ":" -v ip=$Ec2Dcip '{if($1!="ip-access-grant ")print $0;else print $0";"ip}' >distribute2.conf1
    less distribute2.conf1 | awk -F ":" -v port=$Ec2DcPortOff '{if($1!="ec_listen_port ")print $0;else print $1":"port}' >distribute2.conf2
    less distribute2.conf2 | awk -F ":" -v port=$EcThreadNum '{if($1!="ec_thread_num ")print $0;else print $1":"port}'> distribute2.conf3
    cp distribute2.conf3 distribute2.conf
    rm distribute2.conf1 distribute2.conf2 distribute2.conf3
  

    #saver
    less saver.conf |awk -F ":" -v ip=$Ec2DcSaverIpOff '{if($1!="SaverIP")print $0;else print $1":"ip}' >saver.conf.tmp
    less saver.conf.tmp |awk -F ":" -v port=$EC2DcSaverPortOff '{if($1!="SaverPort")print $0;else print $1":"port}' >saver.conf
    rm saver.conf.tmp

    #cache
    less cache.conf |awk -F ":" -v ip=$Ec2DcCacheIpOff '{if($1!="CacheIp")print $0;else print $1":"ip}' >cache.conf.tmp
    less cache.conf.tmp |awk -F ":" -v port=$EC2DcCachePortOff '{if($1!="CachePort")print $0;else print $1":"port}' >cache.conf
    rm cache.conf.tmp

    #wdn
    less wdn.conf |awk -F ":" -v ip=$Ec2DcWdnIpOff '{if($1!="CacheIp")print $0;else print $1":"ip}' >wdn.conf.tmp
    less wdn.conf.tmp |awk -F ":" -v port=$Ec2DcWdnPortOff '{if($1!="CachePort")print $0;else print $1":"port}' >wdn.conf
    rm wdn.conf.tmp

    #wisecache
    less wise_cache.conf |awk -F ":" -v ip=$Ec2DcWiseCacheIpOff '{if($1!="CacheIp")print $0;else print $1":"ip}' >wisecache.conf.tmp
    less wisecache.conf.tmp |awk -F ":" -v port=$EC2DcWiseCachePortOff '{if($1!="CachePort")print $0;else print $1":"port}' >wise_cache.conf
    rm wisecache.conf.tmp

    #xpath
    less xpath.conf |awk -F ":" -v ip=$Ec2DcXpathIpOff '{if($1!="CacheIp")print $0;else print $1":"ip}' >xpath.conf.tmp
    less xpath.conf.tmp |awk -F ":" -v port=$EC2DcXpathPortOff '{if($1!="CachePort")print $0;else print $1":"port}' >xpath.conf
    rm xpath.conf.tmp

    #gfw
    less gfw.conf |awk -F ":" -v ip=$Ec2DcGfwIpOff '{if($1!="CacheIp")print $0;else print $1":"ip}' >gfw.conf.tmp
    less gfw.conf.tmp |awk -F ":" -v port=$EC2DcGfwPortOff '{if($1!="CachePort")print $0;else print $1":"port}' >gfw.conf
    rm gfw.conf.tmp

    #WdnVideo
    less wdn_video.conf |awk -F ":" -v ip=$Ec2DcWdnVideoIpOff '{if($1!="WdnVideoIp")print $0;else print $1":"ip}' >wdn_video.conf.tmp
    less wdn_video.conf.tmp |awk -F ":" -v port=$EC2DcWdnVideoPortOff '{if($1!="WdnVideoPort")print $0;else print $1":"port}' >wdn_video.conf
    rm wdn_video.conf.tmp

    #mainlink
    less mainlink.conf |awk -F ":" -v ip=$Ec2DcMainlinkIpOff '{if($1!="MainlinkIP")print $0;else print $1":"ip}' >mainlink.conf.tmp
    less mainlink.conf.tmp |awk -F ":" -v port=$Ec2DcMainlinkPortOff '{if($1!="MainlinkPort")print $0;else print $1":"port}' >mainlink.conf
    rm mainlink.conf.tmp

    #img_cache
    less img_cache.conf | awk -F ":" -v ip=$Ec2DcImagCacheIpOff '{if($1!="CacheIp")print $0;else print $1":"ip}' >imag_cache.conf.tmp
    less imag_cache.conf.tmp |awk -F ":" -v port=$EC2DcImagCachePortOff '{if($1!="CachePort")print $0;else print $1":"port}' >img_cache.conf
    rm  imag_cache.conf.tmp

    #tn_cache.conf
    less tn_cache.conf | awk -F ":" -v ip=$Ec2DcTnCacheIpOff '{if($1!="CacheIp")print $0;else print $1":"ip}' >tu_cache.conf.tmp
    less tu_cache.conf.tmp |awk -F ":" -v port=$EC2DcTnCachePortOff '{if($1!="CachePort")print $0;else print $1":"port}' >tn_cache.conf
    rm  tu_cache.conf.tmp

	#page_extract_socket.conf 
	less page_extract_socket.conf | awk -F ":" -v ip=$Ec2DcPageExtractIpOff '{if($1!="PageExtractIP")print $0;else print $1":"ip}' >tu_cache.conf.tmp
	less tu_cache.conf.tmp |awk -F ":" -v port=$EC2DcPageExtractPortOff '{if($1!="PageExtractPort")print$0;else print $1":"port}' >page_extract_socket.conf
	rm  tu_cache.conf.tmp
    ###############################################################################################################################
}

LineOffDc()
{
    mkdir $Mypath/LineOffdc
    cd $Mypath/LineOffdc
    #1.拉取线上DC
    GetLineOnDc
    #2.拉取产品库
    GetProduct 0
    #3.修改配置
    ModifyDcOffConf
    #4.修改Index配置
    cd $path/outcome/LineOffdc/conf
    ModifyIndexConf
    #5.加载用户词典
    IsFtp
    if [ `echo $?` -eq 1 ];then
         cp -r $MyFtp/* $LineOffDcConf
    fi
    
    #6.启动DC
    #cd $path/outcome/LineOffdc/bin
    cd $LineOffDcBin
    StartDc
}


EnvAll()
{
    ##################################部署线上DC############################################################################## 
    mkdir $Mypath/LineOndc
    cd $Mypath/LineOndc/
    #1.拉取线上DC
    GetLineOnDc 
    #2.修改线上DC的conf
    ModifyDcOnlineConf

    #3.修改Index的conf
    #cd $path/outcome/LineOndc/conf
    cd $LineOnDcConf
    ModifyIndexConf
   
    #4.启动线上DC
    cd $Mypath/LineOndc/bin
    export LD_LIBRARY_PATH=`pwd`
    nohup ./distribute2 -c ../conf/distribute2.conf 1>log 2>err &

    ############################布置线下DC######################################################################################
    mkdir $Mypath/LineOffdc
    cd $Mypath/LineOffdc
    mkdir log
    mkdir status
    cp -r $Mypath/LineOndc/bin .     
    cp -r $Mypath/LineOndc/conf . 
    
    GetProduct 0
    #3.修改配置
    ModifyDcOffConf
    #4.修改Index配置
    #cd $path/outcome/LineOffdc/conf
    cd $LineOffDcConf
    ModifyIndexConf
    
    IsFtp
    if [ `echo $?` -eq 1 ];then
        cp -r $MyFtp/* $LineOffDcConf
    fi
   
    #################################启动dc########################################################################################
    #cd $path/outcome/LineOffdc/bin
    cd $LineOffDcBin
    export LD_LIBRARY_PATH=`pwd`
    nohup ./distribute2 -c ../conf/distribute2.conf 1>log 2>err &
    ################################################################################################################################
    
    sleep 120
    disnum=`ps aux|grep dis | grep -v "grep" | wc -l`
    if [ $disnum -eq 2 ];then
        touch $Mypath/succeed
    fi

}


ValgrindDc()
{
     mkdir $Mypath/LineOffdc
     cd $Mypath/LineOffdc
     #1.拉取线上DC
     GetLineOnDc
     #2.拉取产品库
     GetProduct 0
     #3.修改配置
     ModifyDcOffConf
     #4.修改Index配置
     #cd $path/outcome/LineOffdc/conf
     cd $LineOffDcConf
     ModifyIndexConf
     #5.加载用户词典
     IsFtp
     if [ `echo $?` -eq 1 ];then
     cp -r $MyFtp/* $LineOffDcConf
     fi
    #################################启动dc########################################################################################
    cd $LineOffDcBin
    export LD_LIBRARY_PATH=`pwd`
    nohup $ValInstallPath  --log-file=log --tool=memcheck --leak-check=full --show-reachable=yes $ValPre ./distribute2 -c ../conf/distribute2.conf 1>log 2>err &
    ################################################################################################################################

}

######@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@###################################@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@###############################@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@#####################################@@@@@@@@@@@@@@@@@@@@@@@@@###########################################国######际#########化######################################################################
HK_GetLineOnDc()
{
    mkdir log
    mkdir status
    wget -r -nH --preserve-permissions --level=0 --cut-dirs=3 --retr-symlinks  ftp://hk01-spi-dc1.hk01.baidu.com/home/spider/dc/bin
    wget -r -nH --preserve-permissions --level=0 --cut-dirs=3 --retr-symlinks  ftp://hk01-spi-dc1.hk01.baidu.com/home/spider/dc/lib
    wget -r -nH --preserve-permissions --level=0 --cut-dirs=3 --retr-symlinks  ftp://hk01-spi-dc1.hk01.baidu.com/home/spider/dc/conf
}

HK_ModifyDcOnlineConf()
{
    #cd $Mypath/LineOndc/conf
    cd $HK_LineOnDcConf
    #修改线程数
    sed -i 's/#ec_thread_num : 1/ec_thread_num : 10/g' distribute2.conf
    sed -i 's/mon_listen_port : 9236/mon_listen_port : 19236/g' distribute2.conf
    sed -i 's/ec_listen_urgent_port : 9237/ec_listen_urgent_port : 19237/g' distribute2.conf


    less distribute2.conf  | awk -F ":" -v ip=$HK_Ec2Dcip '{if($1!="ip-access-grant ")print $0;else print $0";"ip}' >distribute2.conf1
    less distribute2.conf1 | awk -F ":" -v port=$HK_Ec2DcPortOn '{if($1!="ec_listen_port ")print $0;else print $1":"port}' >distribute2.conf2
    less distribute2.conf2 | awk -F ":" -v port=$HK_EcThreadNum '{if($1!="ec_thread_num ")print $0;else print $1":"port}'> distribute2.conf3
    cp distribute2.conf3 distribute2.conf
    rm distribute2.conf1 distribute2.conf2 distribute2.conf3

    #saver
    less saver.hk.conf |awk -F ":" -v ip=$HK_Ec2DcSaverIpOn '{if($1!="SaverIP")print $0;else print $1":"ip}' >saver.conf.tmp
    less saver.conf.tmp |awk -F ":" -v port=$HK_EC2DcSaverPortOn '{if($1!="SaverPort")print $0;else print $1":"port}' >saver.hk.conf
    rm saver.conf.tmp

    #cache
    less cache.hk.conf |awk -F ":" -v ip=$HK_Ec2DcCacheIpOn '{if($1!="CacheIp")print $0;else print $1":"ip}' >cache.conf.tmp
    less cache.conf.tmp |awk -F ":" -v port=$HK_EC2DcCachePortOn '{if($1!="CachePort")print $0;else print $1":"port}' >cache.hk.conf
    rm cache.conf.tmp

    #mainlink
    less mainlink.hk.conf |awk -F ":" -v ip=$HK_Ec2DcMainlinkIpOn '{if($1!="MainlinkIP")print $0;else print $1":"ip}' >mainlink.conf.tmp
    less mainlink.conf.tmp |awk -F ":" -v port=$HK_EC2DcMainlinkPortOn '{if($1!="CachePort")print $0;else print $1":"port}' >mainlink.hk.conf
    rm mainlink.conf.tmp
}

HK_ModifyIndexConf()
{
    cp $Pwdpath/Index/chk_url_ss.hk.conf .
}

HK_ModifyDcOffConf()
{
    #cd $path/outcome/LineOffdc/conf
    cd $HK_LineOffDcConf
    sed -i 's/info_collect_level:1/info_collect_level:3/g' distribute2.conf

    #修改线程数
    sed -i 's/#ec_thread_num : 1/ec_thread_num : 10/g' distribute2.conf
    sed -i 's/mon_listen_port : 9236/mon_listen_port : 29236/g' distribute2.conf
    sed -i 's/ec_listen_urgent_port : 9237/ec_listen_urgent_port : 29237/g' distribute2.conf

    less distribute2.conf  | awk -F ":" -v ip=$HK_Ec2Dcip '{if($1!="ip-access-grant ")print $0;else print $0";"ip}' >distribute2.conf1
    less distribute2.conf1 | awk -F ":" -v port=$HK_Ec2DcPortOff '{if($1!="ec_listen_port ")print $0;else print $1":"port}' >distribute2.conf2
    less distribute2.conf2 | awk -F ":" -v port=$HK_EcThreadNum '{if($1!="ec_thread_num ")print $0;else print $1":"port}'> distribute2.conf3
    
    cp distribute2.conf3 distribute2.conf
    rm distribute2.conf1 distribute2.conf2 distribute2.conf3


    #saver
    less saver.hk.conf |awk -F ":" -v ip=$HK_Ec2DcSaverIpOff '{if($1!="SaverIP")print $0;else print $1":"ip}' >saver.conf.tmp
    less saver.conf.tmp |awk -F ":" -v port=$HK_EC2DcSaverPortOff '{if($1!="SaverPort")print $0;else print $1":"port}' >saver.hk.conf
    rm saver.conf.tmp

    #cache
    less cache.hk.conf |awk -F ":" -v ip=$HK_Ec2DcCacheIpOff '{if($1!="CacheIp")print $0;else print $1":"ip}' >cache.conf.tmp
    less cache.conf.tmp |awk -F ":" -v port=$HK_EC2DcCachePortOff '{if($1!="CachePort")print $0;else print $1":"port}' >cache.hk.conf
    rm cache.conf.tmp

    #mainlink
    less mainlink.hk.conf |awk -F ":" -v ip=$HK_Ec2DcMainlinkIpOff '{if($1!="MainlinkIP")print $0;else print $1":"ip}' >mainlink.conf.tmp
    less mainlink.conf.tmp |awk -F ":" -v port=$HK_Ec2DcMainlinkPortOff '{if($1!="MainlinkPort")print $0;else print $1":"port}' >mainlink.hk.conf
    rm mainlink.conf.tmp
}


HK_LineOnDc()
{
    mkdir $Mypath/HK_LineOndc
    cd $Mypath/HK_LineOndc/
    #1.获取国际化线上DC
    HK_GetLineOnDc
    #2.修改配置
    HK_ModifyDcOnlineConf
    #3.修改Index的conf
    #cd $path/outcome/HK_LineOndc/conf
    cd $HK_LineOnDcConf
    HK_ModifyIndexConf
    #4.启动DC
    #cd $Mypath/LineOndc/bin
    cd $HK_LineOnDcBin
    StartDc
}

HK_LineOffDc()
{
     mkdir $Mypath/HK_LineOffdc
     cd $Mypath/HK_LineOffdc
     #1.获取国际化线上DC
     HK_GetLineOnDc
     #2.获取产品库
     GetProduct 1
     #3.修改配置
     HK_ModifyDcOffConf
     #4.修改Index配置
     #cd $path/outcome/HK_LineOffdc/conf
     cd $HK_LineOffDcConf
     HK_ModifyIndexConf
     #5.启动DC
     #cd $Mypath/LineOffdc/bin
     cd $HK_LineOffDcBin
     StartDc
}

GetChinaDownData()
{
	mkdir -p $Mypath/GetData && cd $Mypath/GetData 
	sh $Pwdpath/GetDcConfPort.sh $1 1 	
}

GetHkDownData()
{
	mkdir -p $Mypath/GetData && cd $Mypath/GetData
	sh $Pwdpath/HK_GetDcConfPort.sh $1 1
}

case $1 in
    "CN")
    if [ $2 -eq 0 ];then
        clearenv
        LineOnDc
	    GetChinaDownData $LineOnDcConf 
    elif [ $2 -eq 1 ];then             
         clearenv
	 LineOffDc
	 GetChinaDownData $LineOffDcConf
    elif [ $2 -eq 2 ];then
        clearenv 
	EnvAll
    elif [ $2 -eq 3 ];then
        clearenv 
	ValgrindDc
    else
        echo "wrong param!!"
    fi
    ;;
    "HK")
    if [ $2 -eq 0 ];then
        clearenv
	HK_LineOnDc
	GetHkDownData $HK_LineOnDcConf 
    elif [ $2 -eq 1 ];then
        clearenv
	HK_LineOffDc
	GetHkDownData $HK_LineOffDcConf
    else
        echo "wrong param!!"
    fi
    ;;
    *)
    echo "$1 is wrong!"
esac
    



