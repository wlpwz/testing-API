#!/bin/bash

_file=$1

#sort -nk 1 -o sorted $1


q_avg=`cat $1 | awk '{a[$1]+=$2} END{for(i in a) {print i,a[i]}}' | awk '{ sum += $2} END {if (NR>0) print sum / NR}'| awk '{printf("%d",$0)}'`
q_min=`cat $1 | awk '{a[$1]+=$2} END{for(i in a) {print i,a[i]}}' | awk '{print $2}' | sort -nu | sed -n '1P'`
q_max=`cat $1 | awk '{a[$1]+=$2} END{for(i in a) {print i,a[i]}}' | awk '{print $2}' | sort -nu | sed -n '$P'`
echo "QPS:" ${q_avg} ${q_min} ${q_max}

#sort -nk 1 $1 | awk '{a[$1]+=$2} END{for(i in a) {print i,a[i]}}'

cat $1 | awk '{a[$1]+=$2} END{for(i in a) {print i,a[i]}}' | sort -nk 1 -o $1

sed -i '1 i\time qps' $1
