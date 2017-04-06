#!/bin/bash

_file=$1

#v_avg=`cat $1 | awk '{ sum += $5} END {if (NR>0) print sum / NR}'| awk '{printf("%d",$0)}'`
v_avg=`cat $1 | awk '{ ex1 = index("mg", substr($5, length($5))); sum += $5} END {if (NR>0) printf("%d %s",ex1,sum / NR)};' | awk '{if ($1 < 1) printf("%.2f",$2); else if ($1 == 1) printf("%.2fm",$2); else printf("%.2fg",$2);}'`
v_min=`cat $1 | awk '{print $5}' | sort -nu | sed -n '1P'`
v_max=`cat $1 | awk '{print $5}' | sort -nu | sed -n '$P'`
echo "VSZ:" ${v_avg} ${v_min} ${v_max}

#r_avg=`cat $1 | awk '{ sum += $6} END {if (NR>0) print sum / NR}'| awk '{printf("%d",$0)}'`
r_avg=`cat $1 | awk '{ ex1 = index("mg", substr($6, length($6))); sum += $6} END {if (NR>0) printf("%d %s",ex1,sum / NR)};' | awk '{if ($1 < 1) printf("%.2f",$2); else if ($1 == 1) printf("%.2fm",$2); else printf("%.2fg",$2);}'`
r_min=`cat $1 | awk '{print $6}' | sort -nu | sed -n '1P'`
r_max=`cat $1 | awk '{print $6}' | sort -nu | sed -n '$P'`
echo "RSS:" ${r_avg} ${r_min} ${r_max}

cpu_avg=`cat $1 | awk '{ sum += $3} END {if (NR>0) print sum / NR}'`
cpu_min=`cat $1 | awk '{print $3}' | sort -nu | sed -n '1P'`
cpu_max=`cat $1 | awk '{print $3}' | sort -nu | sed -n '$P'`
echo "CPU:" ${cpu_avg} ${cpu_min} ${cpu_max}

sed -i '1 i\date time cpu mem virt res' $1
