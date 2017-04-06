<?php
/**
 * generate the site's url according to request.
 *
 * Syntax:
 * {base}
 *
 * @see Yii::app()->request
 *
 * @return string
 */
function smarty_function_xmlcolor($params, &$smarty){
    if(!empty($params['xml'])){
        $xml=$params['xml'];
        // 标签
        $xml = preg_replace("/\<(\w+)/", "<[tag]\\1[/tag]", $xml);
        $xml = preg_replace("/\<\/(\w+)/", "</[tag]\\1[/tag]", $xml);
        // 属性
        $xml = preg_replace("/\"([^\"]*)\"/", "\"[attr]\\1[/attr]\"", $xml);
        // 普通内容
        $xml = preg_replace("/\>(.*)\</", ">[text]\\1[/text]<", $xml);
        /*$xml = str_replace(array("&amp;", "&lt;", "&gt;", "&apos;", "&quot;", "\r\n"),
                array("&", "<", ">", "'", "\"", "\n"), $xml);
        */
        $xml = str_replace(array("&", "<", ">", "'", "\""), 
                array("&amp;", "&lt;", "&gt;", "&apos;", "&quot;"), $xml);
        /*$xml = str_replace(array("\r", "\n", " ", "　"), 
                array("<br/>\n", "<br/>\n", "&nbsp;", "&nbsp;&nbsp;"), $xml);
        */
        $xml = str_replace(array("[tag]", "[/tag]", "[attr]", "[/attr]", "[text]", "[/text]"),
                array("<font class='tag'>", "</font>", "<font class='attr'>", "</font>", "<font class='text'>", "</font>" ), $xml);
        $out='';
        $pattern="/^\s+/";
        foreach(split("\n", $xml) as $line){
            if(strlen(trim($line))==0) continue;
            $count=0;
            if(preg_match_all($pattern, $line, $matches, PREG_PATTERN_ORDER)){
                $trim=$matches[0][0];
                $trim=str_replace("\t", '    ', $trim);
                $count=strlen($trim);
            }
            $line=trim($line);
            $out.="<div>".str_repeat("<span class='indent'>&nbsp;</span>", $count)."{$line}</div>";
        }
        return $out;
    }
}
