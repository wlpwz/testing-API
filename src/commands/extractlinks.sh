#!/bin/sh

source ~/.bash_profile

cpacktool -l 'filter=function()
if _.trespassing_field.spider.links                  --如果存在links字段
then
for id,value in ipairs(_.trespassing_field.spider.links)  --遍历此数组，id为数组下标，value为值
do
print(string.format("[url=%s][link=%s][anchor=%s][group=%d][position=%d][protocal=%s][link_type=%d][image_type=%s]",_.target_url,value.url,value.anchor_text,value.group,value.position,value.protocol,value.vlink_func,value.image_type))
end                             --结束循环
end                             --结束if条件
end                             --结束函数
' $1 
