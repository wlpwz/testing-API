#!/bin/bash
rm -rf attr_modify
rm -rf .attr_modify
mkdir attr_modify
cd attr_modify
wget yq01-spi-ddc67.yq01.baidu.com:/home/spider/dc/conf/attr_modify/attr_file && \
wget yq01-spi-ddc67.yq01.baidu.com:/home/spider/dc/conf/attr_modify/attr_file.bak && \
wget yq01-spi-ddc67.yq01.baidu.com:/home/spider/dc/conf/attr_modify/attr_modify_url && \
wget yq01-spi-ddc67.yq01.baidu.com:/home/spider/dc/conf/attr_modify/attr_modify_url.bak
if [ $? -ne 0 ]
then
	echo "download attr_modify files error!"
	exit 1
fi
cp -r ../attr_modify ../.attr_modify
