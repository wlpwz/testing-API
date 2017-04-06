echo 1
exit
result_path=/home/work/LibPP/DIFF_RESULT/22
sh /home/work/ec_test_service/src/commands/extractlinks.sh pack_1 > links_1
sh /home/work/ec_test_service/src/commands/extractlinks.sh pack_2 > links_2
    
result_link=`curl -l "http://tservice.baidu.com/pageevaluate/vlinkdiffAPI?new_file=ftp://cp01-testing-ps6076.cp01.baidu.com$result_path/links_1&old_file=ftp://cp01-testing-ps6076.cp01.baidu.com$result_path/links_2"`

LINK_DIFF=`echo $result_link | python /home/work/ec_test_service/src/commands/jsonParser.py result`

wget $LINK_DIFF

tar xvf $LINK_DIFF
