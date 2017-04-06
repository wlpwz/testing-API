<?php


///< 包含nusoap
require_once('NuSoap.class.php');

///< 定义服务地址
define('LOGDATA_WEBSERVICE_URL',    'http://log.baidu.com/logdata/static/xml/server/WebServiceAPI.php?wsdl');
define('LOGDATA_WEBSERVICE_FUNC',   'getResultFromWebService');

/**
 * @class LogdataClient 客户端封装的接口
 * @author liushaowei@baidu.com
 */
class LogdataClient
{
    /**
     * @function query 执行查询过程
     * @access public
     * @param int $searchID, array $searchParams
     * @return false / array
     */
    public static function query($searchID, $searchParams, $encoding = 'GBK')
    {

        // 1.0 设置时区
        ini_set('date.timezone', 'Asia/Shanghai');
        // 1.1 定义客户端对象
        $client = new nusoap_client(LOGDATA_WEBSERVICE_URL . "&id=12", true);
        $client->soap_defencoding = 'UTF-8';
        $client->decode_utf8 = false;
        $client->xml_encoding = 'UTF-8';
        // 1.2 验证参数格式
        $parameter['searchID'] = strval($searchID);
        if (!is_array($searchParams)) {
            $parameter['searchParams'] = self::jsonEncode(array($searchParams), $encoding);
        } else {
            $parameter['searchParams'] = self::jsonEncode($searchParams, $encoding);
        }
        // 1.3 查询
        $ret = $client->call(LOGDATA_WEBSERVICE_FUNC, $parameter);
        if (($err = $client->getError())) {
            $result = $err;
        } else {
            $result = self::jsonDecode($ret, 'UTF-8', $encoding);
        }

        ///< Display the result
        //print_r($result);
        ///< Display the request and response
        //echo '<h2>Request</h2>';
        //echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
        //echo '<h2>Response</h2>';
        //echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';

        return $result;
    }

    /**
     * @function jsonEncode json编码
     * @access public
     * @param array $src
     * @return string
     */
    public static function jsonEncode($src, $encoding)
    {
        if (strtoupper($encoding) != 'UTF-8') {
            return json_encode(self::iconvRecursive($src, $encoding, 'UTF-8'));
        }
        return json_encode($src);

    }

    /**
     * @function jsonDecode json解码
     * @access public
     * @param array $src, bool $isGBK 指明输入是否是gbk编码
     * @return void
     */
    public static function jsonDecode($src, $currEncoding, $destEncoding)
    {
        if (strtoupper($currEncoding) != 'UTF-8') {
            $src = iconv($currEncoding, 'UTF-8', $src);
        }

        $ret = json_decode($src, true);

        if (strtoupper($destEncoding) == 'UTF-8') {
            return $ret;
        }
        return self::iconvRecursive($ret, 'UTF-8', $destEncoding);
    }

    /**
     * @function iconvRecursive 递归转码
     * @access public
     * @param array $src, string $from, string $to
     * @return array
     */
    public static function iconvRecursive($src, $from, $to)
    {
        if (is_array($src)) {
            $dest = array();
            foreach ($src as $key => $value) {
                $key = iconv($from, $to, $key);
                $dest[$key] = self::iconvRecursive($value, $from, $to);
            }
            return $dest;
        } elseif (is_string($src)) {
            return iconv($from, $to, $src);
        } else {
            return $src;
        }
    }
}


?>
