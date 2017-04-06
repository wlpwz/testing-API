#!/bin/sh

source ~/.bash_profile

cpacktool -l 'filter=function()
if _.trespassing_field.spider.links                  --�������links�ֶ�
then
for id,value in ipairs(_.trespassing_field.spider.links)  --���������飬idΪ�����±꣬valueΪֵ
do
print(string.format("[url=%s][link=%s][anchor=%s][group=%d][position=%d][protocal=%s][link_type=%d][image_type=%s]",_.target_url,value.url,value.anchor_text,value.group,value.position,value.protocol,value.vlink_func,value.image_type))
end                             --����ѭ��
end                             --����if����
end                             --��������
' $1 
