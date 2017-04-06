#!/bin/bash

file=$1
pagenum=$2
each_page_num=$3
#keywords1="value"
lines_num=`cat $file | wc -l`
#field_num=`head -n 1 $file  | cut -f - | wc  -w`
#echo $field_num
#ii=1
#until [ $ii -gt $field_num ]
#do
#	field=`head -n 1 $file  | cut -f $ii`
#	temp=`echo $field | grep $keywords1`
#	is_field_show[$ii]=$?
#	ii=$[$ii+1]
#done
#echo ${row_data[2]}

#jj="\$1 \"\\t\" \$6 \"\\t\" \$7"

if [ "$pagenum"x = ""x ]; then
	pagenum=0
else
	pagenum=$[$pagenum-1]
fi

#each_page_num=${EACH_PAGE_NUMS}
#each_page_num=10
lines_num=$[$lines_num-1]
page_count=$[($lines_num+$each_page_num-1)/$each_page_num]
echo $page_count
line_start=$[$pagenum*$each_page_num+1]
line_end=$[$pagenum*$each_page_num+$each_page_num+1]
#echo $line_start
#echo $line_end
awk '{
		if ( NR == 1||(NR > '${line_start}' && NR <= '${line_end}'))
		{	
			if(NF == 6){
				printf("%s\t%s\n",$1,$NF);
			}
			if(NF >= 7){
				printf("%s\t%s\t%s\n",$1,$(NF-1),$NF);
			}
			if(NF <6){
				printf "<!-- the file is wrong -->"	
			}
		}
		if (NR >'${line_end}')
		{
			exit	
		}
}' $file
#cat $file | awk '{if(NR>'${line_start}' && NR<='${line_end}'){if("'${field_num}'"=="6" ){print $1 "\t" $6}elseif("'${field_num}'"=="7" ){print $1 "\t" $6 "\t" $7}elseif("'${field_num}'"=="8" ){print $1 "\t" $6 "\t" $7 "\t" $8}else{print "<!-- the file is wrong -->"}}}'
#cat $file | awk '{print $1 "\t" $6}'
#cat $file | awk '{print $1 "\t" $6 "\t" $7}'
#cat $file | awk '{print $1 "\t" $6 "\t" $7 "\t" $8}'
#echo "<!-- the file is wrong -->"
#f []

#	if (NR > '${line_end}')
#	{
#		exit;
#	}
#kk="1,6,7"

#printf "%s\t%s\t%s\n" $(cat $file | cut -f $kk) 
#$(cat $file | cut -f 6) $(cat $file | cut -f 7) 

#kk=1
#until [ $kk -gt $lines_num ]
#do
#	aaa=`echo ${row_data[0]} | cut -d ' ' -f $kk`	
#	bbb=`echo ${row_data[1]} | cut -d ' ' -f $kk`	
#	ccc=`echo ${row_data[2]} | cut -d ' ' -f $kk`	
#	echo $aaa $bbb $ccc
#	printf "%s\t%s\t%s\n" $aaa $bbb $ccc 
#	kk=$[$kk+1]
#done
#if [${field:0:}]
#echo $field
#echo ${row_data[0]}

