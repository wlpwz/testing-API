#!/bin/bash

_file=$1

cat $1 | awk 'BEFIN{i=1;} { ex1 = index("mg", substr($4, length($4))); if (ex1 == -1) {ex1 = 0}; val1 = substr($4, 0, length($4) - 1); prod1 = val1 * 1024^(ex1); ex2 = index("mg", substr($5, length($5))); if (ex2 == -1) {ex2 = 0};val2 = substr($5, 0, length($5) - 1); prod2 = val2 * 1024^(ex2); printf "%s %s %d %.f %.f %.f %f %.f %s %d\n", $1, $2, $3, prod1, prod2, $6, $7, $8, $9,i; i++}' | sort -nk 10 -o $1

v_avg=`cat $1 | awk '{ sum += $4} END {if (NR>0) print sum / NR}'| awk '{printf("%d",$0)}'`
v_min=`cat $1 | awk '{print $4}' | sort -nu | sed -n '1P'`
v_max=`cat $1 | awk '{print $4}' | sort -nu | sed -n '$P'`
echo "VIRT:" ${v_avg} ${v_min} ${v_max}

r_avg=`cat $1 | awk '{ sum += $5} END {if (NR>0) print sum / NR}'| awk '{printf("%d",$0)}'`
r_min=`cat $1 | awk '{print $5}' | sort -nu | sed -n '1P'`
r_max=`cat $1 | awk '{print $5}' | sort -nu | sed -n '$P'`
echo "RES:" ${r_avg} ${r_min} ${r_max}

cpu_avg=`cat $1 | awk '{ sum += $7} END {if (NR>0) print sum / NR}'`
cpu_min=`cat $1 | awk '{print $7}' | sort -nu | sed -n '1P'`
cpu_max=`cat $1 | awk '{print $7}' | sort -nu | sed -n '$P'`
echo "CPU:" ${cpu_avg} ${cpu_min} ${cpu_max}

sed -i '1 i\date time pid virt res shr cpu mem command num' $1
