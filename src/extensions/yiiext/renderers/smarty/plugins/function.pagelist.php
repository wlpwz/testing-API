<?php
/**
 * Smarty {pagelist} function plugin
 *
 * Type:     function
 * Name:     pagelist
 * @author   Freek <freek@126.com>
 * @version 2010.03.24
 * @param array
 * @param Smarty
 * @return string
 */
function smarty_function_pagelist($params, $smarty)
{
    $paramlist = array(
        'page'       => 1,       //当前页码
        'blocksize'  => 7,       //显示的数码数
        'holder'     => '#page#',  //URL里的页码占位符
        'pagecount'  => null,    //总页数
        'url'        => null,    //默认URL
        'isjump'     => false,   //是否显示跳转用的input框
        );
    foreach ($params as $key => $val) {
        $key = strtolower($key);
        if (array_key_exists($key, $paramlist)) {
            $paramlist[$key] = $val;
        } else {
            $smarty->trigger_error("[pagelist] Unknown parameter $key", E_USER_WARNING);
        }
    }
    unset($key, $val);
    extract($paramlist, EXTR_OVERWRITE);

    if ($pagecount <= 1) return '';

    //URL内嵌页码变量的
    $isinline = false;
    $invar = &$holder;

    $display_page_num = isset($blocksize) ? $blocksize : 7;
    $startpage = $page - floor($display_page_num / 2);
    $endpage = $page + floor($display_page_num / 2);
    if ($startpage < 1) {
        $endpage += abs($startpage) + 1;
        $startpage = 1;
    }
    if ($endpage > $pagecount) {
        $endpage = $pagecount;
        $startpage = $endpage - $display_page_num + 1;
        $startpage = $startpage > 0 ? $startpage : 1;
    }

    $text = '';
    for ($i = $startpage; $i <= $endpage; $i++) {
        $on = ($i == $page) ? ' class="on"' : '';
        $newurl = str_replace($invar, $i, $url);
        $text .= "<a href=\"{$newurl}\"{$on}>{$i}</a>";
    }
    if ($isjump) {
        $text .= "<kbd><input size=\"3\" maxlength=\"10\" onkeydown=\"javascript: if(event.keyCode==13){ var url='{$url}'; location.href=url.replace('$invar', this.value);return false;}\" type=\"text\"></kbd>";
    }
    $left = '';
    if ($startpage > 1) {
        $newurl = str_replace($invar, '1', $url);
        $left = "<a href=\"{$newurl}\">首页</a>" ;
    }
    if ($page > 1) {
        $newurl = str_replace($invar, $page-1, $url);
        $left .= "<a href=\"{$newurl}\">上一页</a>";
    }
    $text = $left . $text;
    if ($page < $pagecount) {
        $newurl = str_replace($invar, $page+1, $url);
        $text .= "<a href=\"{$newurl}\">下一页</a>";
    }
    if ($endpage < $pagecount) {
        $newurl = str_replace($invar, $pagecount, $url);
        $text .= "<a href=\"{$newurl}\">末页</a>";
    }
    echo $text;
    return '';
}