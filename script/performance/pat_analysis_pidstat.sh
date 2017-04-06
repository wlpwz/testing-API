#!/bin/bash
_file=$1

cat $1 | sed -e '/^$/d' | awk 'BEGIN{i=0;j=1;s="";} {if(i%4==2) {if(($2=="PM") && ($1<"12:00:00")) sub(substr($1,1,2),substr($1,1,2)+12,$1);if(($2=="AM") && ($1>="12:00:00")) sub(substr($1,1,2),substr($1,1,2)-12,$1); s=($1" "$7" "$8);} if(i>0 && i%4==0) {s=(s" "$6" "$7" "$8" "j);printf("%s\n",s);s="";i=0;j++} i++;}' | sort -nk 7 -o $1

v_avg=`cat $1 | awk '{ sum += $4} END {if (NR>0) print sum / NR}'| awk '{printf("%.2f",$0)}'`
v_min=`cat $1 | awk '{print $4}' | sort -nu | sed -n '1P'`
v_max=`cat $1 | awk '{print $4}' | sort -nu | sed -n '$P'`
echo "VIRT:" ${v_avg} ${v_min} ${v_max}

r_avg=`cat $1 | awk '{ sum += $5} END {if (NR>0) print sum / NR}'| awk '{printf("%.2f",$0)}'`
r_min=`cat $1 | awk '{print $5}' | sort -nu | sed -n '1P'`
r_max=`cat $1 | awk '{print $5}' | sort -nu | sed -n '$P'`
echo "RES:" ${r_avg} ${r_min} ${r_max}

cpu_avg=`cat $1 | awk '{ sum += $2} END {if (NR>0) print sum / NR}'`
cpu_min=`cat $1 | awk '{print $2}' | sort -nu | sed -n '1P'`
cpu_max=`cat $1 | awk '{print $2}' | sort -nu | sed -n '$P'`
echo "CPU:" ${cpu_avg} ${cpu_min} ${cpu_max}

sed -i '1 i\time cpu cpu_core virt res %mem num' $1
