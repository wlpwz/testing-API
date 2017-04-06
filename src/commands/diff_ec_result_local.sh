
diffpacket pack_2 pack_1 1>diff.info 2>diff.stat;

#change ptdef 
if [ -f diffpacket_result/diff_field/trespassing_field,spider,ptdef ]
then
        cat diffpacket_result/diff_field/trespassing_field,spider,ptdef | awk '{
                if (NR > 1)
                {
                        printf("%s\t",$1);
                        for (i = 2; i< NF-1 ;i++)
            {
                printf("%s\t",$i);
            }
                        cmd="curl \"http://tservice.baidu.com/pageevaluate/ptdefInfoAPI?usr=baiyang03&ptdef=" $(NF-1) "\"";
                        system(cmd);
                        printf("\t");
                        cmd1="curl \"http://tservice.baidu.com/pageevaluate/ptdefInfoAPI?usr=baiyang03&ptdef=" $NF "\"";
                        system(cmd1);
                        printf("\n");
                }
                if (NR == 1)
                        printf("%s\n",$0);
        }' > diffpacket_result/diff_field/.ptdef
        if [ -s diffpacket_result/diff_field/.ptdef ]
        then
                mv diffpacket_result/diff_field/.ptdef diffpacket_result/diff_field/trespassing_field,spider,ptdef
        fi
fi

if [ -f diffpacket_result/miss_field/trespassing_field,spider,ptdef ]
then
        cat diffpacket_result/miss_field/trespassing_field,spider,ptdef | awk '{
                if (NR > 1)
                {
                        printf("%s\t",$1);
                        for(i = 2; i < NF; i++)
                        {
                                printf("%s\t",$i);
                        }
                        cmd1="curl \"http://tservice.baidu.com/pageevaluate/ptdefInfoAPI?usr=baiyang03&ptdef=" $NF "\"";
                        system(cmd1);
                        printf("\n");
                }
                if (NR == 1)
                {
                        printf("%s\n",$0);
                }
        }' > diffpacket_result/miss_field/.ptdef
        if [ -s diffpacket_result/miss_field/.ptdef ]
        then
                mv diffpacket_result/miss_field/.ptdef diffpacket_result/miss_field/trespassing_field,spider,ptdef
        fi
fi

if [ -f diffpacket_result/new_field/trespassing_field,spider,ptdef ]
then
        cat diffpacket_result/new_field/trespassing_field,spider,ptdef | awk '{
                if (NR > 1)
                {
                        printf("%s\t",$1);
                        for (i = 2;i < NF; i++)
                        {
                                printf("%s\t",$i);
                        }
                        cmd1="curl \"http://tservice.baidu.com/pageevaluate/ptdefInfoAPI?usr=baiyang03&ptdef=" $NF "\"";
                        system(cmd1);
                        printf("\n");
                }
                if (NR == 1)
                {
                        printf("%s\n",$0);
                }
        }' > diffpacket_result/new_field/.ptdef
        if [ -s diffpacket_result/new_field/.ptdef ]
        then
                mv diffpacket_result/new_field/.ptdef diffpacket_result/new_field/trespassing_field,spider,ptdef
        fi
fi

#deal diff vlinks
if [ -f diffpacket_result/diff_field/trespassing_field,spider,links ]
then
        cat diffpacket_result/diff_field/trespassing_field,spider,links | awk '{print $1}' > diff.links.list
        cpacktool -F -k target_url -u diff.links.list pack_1 > diff.links.packs_1
    cpacktool -F -k target_url -u diff.links.list pack_2 > diff.links.packs_2
        sh /home/work/ec_test_service/src/commands/extractlinks.sh diff.links.packs_1 > diff.links_1
        sh /home/work/ec_test_service/src/commands/extractlinks.sh diff.links.packs_2 > diff.links_2
        result_link=`curl -l "http://tservice.baidu.com/pageevaluate/vlinkdiffAPI?new_file=ftp://cp01-testing-ps6076.cp01.baidu.com$result_path/diff.links_2&old_file=ftp://cp01-testing-ps6076.cp01.baidu.com$result_path/diff.links_1"`

        LINK_DIFF=`echo $result_link | python /home/work/ec_test_service/src/commands/jsonParser.py result`

        wget $LINK_DIFF

        tar xvf $LINK_DIFF

fi

#deal new vlinks
if [ -f diffpacket_result/new_field/trespassing_field,spider,links ]
then
        cat diffpacket_result/new_field/trespassing_field,spider,links | awk '{print $1}' > new.links.list
        cpacktool -F -k target_url -u new.links.list pack_2 > new.links.packs
        sh /home/work/ec_test_service/src/commands/extractlinks.sh new.links.packs > new.links
fi

#deal miss vlinks
if [ -f diffpacket_result/miss_field/trespassing_field,spider,links ]
then
        cat diffpacket_result/miss_field/trespassing_field,spider,links | awk '{print $1}' > miss.links.list
        cpacktool -F -k target_url -u miss.links.list pack_1 > old.links.packs
        sh /home/work/ec_test_service/src/commands/extractlinks.sh old.links.packs > old.links
fi


if [ ! -f diffpacket_result/summary ]
then
        if [ -d diffpacket_result/diff_field ]
        then
                temp=`ls -l diffpacket_result/diff_field/ | wc -l`
                diff_field=`expr $temp - 1`
        else
                diff_field=0
        fi
        if [ -d diffpacket_result/miss_field ]
        then
                temp=`ls -l diffpacket_result/miss_field/ | wc -l`
                miss_field=`expr $temp - 1`
        else
                miss_field=0
        fi
        if [ -d diffpacket_result/new_field ]
        then
                temp=`ls -l diffpacket_result/new_field/ | wc -l`
                new_field=`expr $temp - 1`
        else
                new_field=0
        fi
        if [ -f diffpacket_result/packs_same ]
        then
                same_num=`cat diffpacket_result/packs_same | wc -l`
        else
                same_num=0
        fi
        total_num=`cpacktool -l 'filter=function() print(_.target_url) end' pack_1 | wc -l`
        diff_num=`expr $total_num - $same_num`
        echo "process_time=1s same_pack=$same_num diff_pack=$diff_num new_pack=0 miss_pack=0 new_item=$new_field miss_item=$miss_field diff_item=$diff_field" >> diffpacket_result/summary
        if [ $new_field -gt 0 ]
        then
                echo "NEW_ITEMS=$new_field" >> diffpacket_result/summary
            for line in `ls diffpacket_result/new_field`
                do
                        temp=`cat diffpacket_result/new_field/$line | wc -l`
                        num=`expr $temp - 1`
                        echo "$line $num" | awk '{printf("\t%s\t%d\n",$1,$2);}' >> diffpacket_result/summary
                done
        fi
        if [ $miss_field -gt 0 ]
        then
                echo "MISS_ITEMS=$miss_field" >> diffpacket_result/summary
                for line in `ls diffpacket_result/miss_field` 
                do
                        temp=`cat diffpacket_result/miss_field/$line | wc -l`
                        num=`expr $temp - 1`
                        echo "$line $num" | awk '{printf("\t%s\t%d\n",$1,$2);}' >> diffpacket_result/summary
                done
        fi
        if [ $diff_field -gt 0 ]
        then
                echo "DIFF_ITEMS=$diff_field" >> diffpacket_result/summary
            for line in `ls diffpacket_result/diff_field`
                do
                        temp=`cat diffpacket_result/diff_field/$line | wc -l`
                        num=`expr $temp - 1`
                        echo "$line $num" | awk '{printf("\t%s\t%d\n",$1,$2);}' >> diffpacket_result/summary
                done
        fi
fi

new_pack_num=`cat diff.stat | awk '{if(NR==1){printf("%s",$4)}}'`
old_pack_num=`cat diff.stat | awk '{if(NR==2){printf("%s",$4)}}'`

# diff pvdetail

sh -x /home/work/ec_test_service/src/commands/diff_pvdetail.sh  pack_1 pack_2 $result_path $lang

echo [SUC] diffpacket success;

exit 0;
