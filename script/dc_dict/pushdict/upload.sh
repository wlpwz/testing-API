#!/bin/bash
if [ -d attr_modify -a -d .attr_modify ]
then
	echo "Check the folder attr_modify OK!"
else
	echo "please run download.sh first!"
	exit 1
fi
rm -rf tmp
mkdir tmp
mkdir tmp/chk
cd tmp/chk
echo  "Check the present conf version..." 
wget -q yq01-spi-ddc67.yq01.baidu.com:/home/spider/dc/conf/attr_modify/attr_file && \
wget -q yq01-spi-ddc67.yq01.baidu.com:/home/spider/dc/conf/attr_modify/attr_file.bak && \
wget -q yq01-spi-ddc67.yq01.baidu.com:/home/spider/dc/conf/attr_modify/attr_modify_url && \
wget -q yq01-spi-ddc67.yq01.baidu.com:/home/spider/dc/conf/attr_modify/attr_modify_url.bak
if [ $? -ne 0 ]
then
	echo "download attr_file error!"
	exit 1
fi
cd ../../
for file in `ls tmp/chk`
do
	if [ -f .attr_modify/${file} ]
	then
		md5_now=`md5sum tmp/chk/${file} | awk '{print $1}'`
		md5_old=`md5sum .attr_modify/${file} | awk '{print $1}'`
		if [ "${md5_now}" != "${md5_old}" ]
		then
			echo "FAILD!"
			echo "please run download.sh to update the base file"
			echo "before execute download.sh, please backup your modification"
			exit 1
		fi
	fi
done
echo "PASS!"
echo "Check the validation..."
sort attr_modify/attr_modify_url > tmp/url_new
sort .attr_modify/attr_modify_url > tmp/url_old
comm tmp/url_new tmp/url_old -23 | sort > tmp/sorted_add
md5_now=`md5sum attr_modify/attr_modify_url | awk '{print $1}'`
md5_old=`md5sum .attr_modify/attr_modify_url | awk '{print $1}'`
if [ "${md5_now}" == "${md5_old}" ]
then
	echo "No modify!"
	exit 1
fi
comm tmp/url_new tmp/sorted_add -23 | sort > tmp/sorted_origin
while read line
do
	pattern=`echo -n $line | awk '{print $1}'`
	oper_type=`echo -n $line | awk '{print $2}'`
	res=""
	if [ "$oper_type" != "3" ]
	then
		res=`awk '{if($2!="3") {print $1} }' tmp/sorted_origin | grep "^${pattern}$"`
	else
		res=`awk '{if($2!="3") {print $1} }' tmp/sorted_origin | pcregrep "${pattern}"`
	fi
	if [ ${#res} -ne 0 ]
	then
		echo -e "${pattern} conflict with:\n${res}"
		exit 1
	fi
done < tmp/sorted_add
echo "PASS!"
rm -rf attr_modify/attr_modify
mkdir attr_modify/attr_modify
cp attr_modify/attr_file attr_modify/attr_file.bak attr_modify/attr_modify_url attr_modify/attr_modify_url.bak attr_modify/attr_modify/
if [ $? -ne 0 ]
then
	echo "dict files not complete! please run download.sh first"
	exit 1
fi
ftp_url="ftp://`hostname``pwd`/attr_modify/attr_modify"
user=$1
reason=$2
curl "http://pat.baidu.com/?r=dictionary/dctestAPI&language=0&method=0&newold=0&memory=1&speed=1&head=$1&source=1:$ftp_url&dictionary_name=attr_modify&reason=$2"
#rm -rf attr_modify/attr_modify
exit 0


