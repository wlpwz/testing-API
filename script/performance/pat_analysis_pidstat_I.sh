#!/bin/bash
_file=$1

cat $1 | sed -e '/^$/d' | awk 'BEGIN{i=1;s="";} {if(i>2) {if($2=="PM") sub(substr($1,1,2),substr($1,1,2)+12,$1); s=($1" "$7" "$8); printf("%s\n",s);s=""} i++;}' | sort -nk 1 -o $1

cpu_avg=`cat $1 | awk '{ sum += $2} END {if (NR>0) print sum / NR}'`
cpu_min=`cat $1 | awk '{print $2}' | sort -nu | sed -n '1P'`
cpu_max=`cat $1 | awk '{print $2}' | sort -nu | sed -n '$P'`
echo "CPU:" ${cpu_avg} ${cpu_min} ${cpu_max}

sed -i '1 i\time cpu cpu_core' $1
