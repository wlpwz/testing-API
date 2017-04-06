<?php

function smarty_function_sitemapstatus($params, &$smarty){
    static $errors=array(
        0=>'正确', 
        1=>'等待抓取',
        2=>'抓取失败，请检查文件是否正确并手动更新',
        3=>'文件检测不存在，请检查文件是否正确并手动更新',
        4=>'解压缩失败，请检查文件是否正确压缩',
        5=>'xml文件初始化失败',
        6=>'非标准xml文件，请查看标准协议格式',
        7=>'xml文件urlset标签错误，请不要带xmlns属性',
        8=>'提取链接失败',
        9=>'点击查看具体错误信息',
        10=>'编码类型无法识别，推荐使用UTF-8和GBK，暂不支持gb18030、gb2312',
        11=>'无法识别的文件类型',
        12=>'txt文件格式不对，不是每行一条url',
        13=>'rss2文件格式不对',
        14=>'文件过大，已超过10M(10485760字节)',
        15=>'文件长度过短或为空文件',
        16=>'抓取超时，请检查网络和文件是否正确，稍后再手动更新',
        17=>'您提交的sitemap文件中含有不是您验证网站的url。请返回检查并手动更新文件',
        18=>'可能您的网站误封禁百度的UserAgent：baiduspider，请返回检查您的服务器设置并手动更新文件',
        19=>'抓取超时，请检查网络和文件是否正确，稍后再手动更新',
        20=>'连接超时，请检查网络和文件是否正确，稍后再手动更新',
        21=>'无法建立连接，请检查网络和文件是否正确，稍后再手动更新',
        22=>'返回数据错误，请检查网络和文件是否正确，稍后再手动更新',
        23=>'您的网站返回了错误状态码，请返回检查您的服务器设置并手动更新文件',
        100=>'服务器返回的字节数超出/不足http头中声明的字节数，请返回检查您的服务器设置并手动更新文件',
        101=>'index类型的sitemap中不可以嵌套index类型的sitemap，请修改您的xml文件并手动更新文件',
        102=>'sitemap中的url数量超出50000条，请修改您的xml文件并手动更新文件',
        104=>'请检查xml文档是否存在错误，常见错误为xml标签不闭合或文本内容中部分字符未转义',
        911=>'内部文件错误',
        1000=>'抓取失败',
        1001=>'抓取失败',
        1002=>'抓取失败',
        1003=>'抓取失败',
        1004=>'抓取失败',
        1005=>'抓取失败',
        1006=>'抓取失败',
        1007=>'抓取失败',
        2001=>'解压缩失败',
        2002=>'Xml格式错误', 
        2003=>'Xml根节点错误',
        2004=>'存在无效url',
        2005=>'文件超过10M',
        2006=>'文件空或过短',
        2007=>'主域校验失败',
        2008=>'索引型嵌套',
        2009=>'url数超50000',
        103=>"文件数超",
        2010=>'Xml解析失败'
    );
    $sitemap=@$params['sitemap'];
    $site=@$params['site'];
    $current=@$params['current'];
    if(!$sitemap || !$site || !$current)
        throw new Exception('no sitemap set');
    $action=isset($params['action'])? $params['action']: 'index';
        
    $out='';
    if($sitemap->stat==3){
        if($sitemap->error_no==9)
            $sitemap->error_no=2010;
        if($sitemap->error_no<911 && $sitemap->error_no!=103){
            $href='';
            $tag='span';
            if($sitemap->error_no==9){
                $href='href="'.surl(array('sitemapcheckxml', 'uid'=>$sitemap->uid)).'"';
                $tag='a';
            }
            $out.="<{$tag} {$href} title='{$errors[$sitemap->error_no]}'><span class='icon-error-new'>错误</span></{$tag}>";
        }elseif($sitemap->error_no==911){
            $out.="<a href=\"".surl(array($action, 'uid'=>$sitemap->uid, 'filter'=>3, 'back'=>json_encode($current)))."\"><span class='icon-error-new'>内部文件错误</span></a>";
        }else{
            $error=$errors[$sitemap->error_no];
            if($sitemap->error_no==103)
                $error.=$site->sitemapTotal();
            $out.="<a href=\"".surl(array('xmlerr', 'uid'=>$sitemap->uid, 'err'=>$sitemap->error_no))."\" target=\"_blank\"><span class='icon-error-new'>{$error}</span></a>";
        }
    }else{
        $out.="<span class='icon-wait-sitemapopen'>".($sitemap->stat==1?'等待':'正常')."</span>";
    }
    return $out;
}