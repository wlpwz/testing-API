#!/bin/bash
_file=$1


num_s=`cat $1 | wc -l`
num_e=5000
val=`expr ${num_s} / ${num_e} + 1`

echo ${num_s} ${num_e} ${val}

if [ ${num_s} -gt ${num_e} ]
then
	cat $1 | awk -v interval=${val} 'BEGIN {i=2;} { if (NR==1) {s="num"" "$0; print s;} else if (NR==i) {s=NR" "$0; print s; i+=interval;}}' | sort -nk 1 -o $1
fi
	
