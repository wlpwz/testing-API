<?php
class Bucket {
    private $bcs;
    private $bucketname;
    private $baseurl;

    function __construct($bcs, $bucketname){
        $this->bcs=$bcs;
        $this->bucketname=$bucketname;
    }

    function put($key, $path){
        $opt=array('acl'=>BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_WRITE, BaiduBCS::IMPORT_BCS_LOG_METHOD=>'_yunlog');
        $opt['curlopts']=array(CURLOPT_CONNECTTIMEOUT => 10, CURLOPT_TIMEOUT => 1800 );
        $response=$this->bcs->create_object($this->bucketname, $key, $path, $opt);
        return $response->isOK();
    }
    function delete($key){
        $response = $this->bcs->delete_object($this->bucketname, $key, array(BaiduBCS::IMPORT_BCS_LOG_METHOD=>'_yunlog'));
        return $response->isOK();
    }
    function saveTo($key, $path){
        $opt=array('fileWriteTo' => $path, BaiduBCS::IMPORT_BCS_LOG_METHOD=>'_yunlog');
        $response = $this->bcs->get_object ( $this->bucketname, $key, $opt );
        return $response->isOK();
    }
    function page($start=0, $limit=20, $prefix='/'){
        $opt = array ('start' => $start,'limit' => $limit,'prefix' => $prefix, BaiduBCS::IMPORT_BCS_LOG_METHOD=>'_yunlog' );
        $response = $this->bcs->list_object ( $this->bucketname, $opt );
        if($response->isOK()){
            return json_decode($response->body, true);
        }
        return false;
    }

    public function setBaseurl($url)
    {
        $this->baseurl = $url;
    }
    public function __set($name, $value)
    {
        //什么也不做。不允许动态添加属性
    }
    public function __get($name)
    {
        if ('baseurl' == $name) {
            return $this->baseurl; //只允许使用 baseurl
        }
        return null;
    }
}

class Yun extends CApplicationComponent{
    static function loadlibs(){
        if(!defined('BCS_AK')){
            Yii::import('application.vendors.yun.*');
            require_once('bcs.class.php');
        }
    }
    private $bcs;
    private $_private;
    private $_public;
    public function init(){
        parent::init();
        self::loadlibs();
        $ak=Conf::requireKey('bcs', 'ak');
        $sk=Conf::requireKey('bcs', 'sk');
        $host=Conf::requireKey('bcs', 'host');
        $this->bcs=new BaiduBCS ( $ak, $sk, $host );
    }
    public function getPrivate(){
        if(!$this->_private) {
            $bucketname = Conf::requireKey('bcs', 'private');
            $baseurl = trim(Conf::requireKey('bcs', 'baseurl'), '/') . '/' . $bucketname;
            $this->_private = new Bucket($this->bcs, $bucketname);
            $this->_private->setBaseurl($baseurl);
        }
        return $this->_private;

    }
    public function getPublic(){
        if(!$this->_public) {
            $bucketname = Conf::requireKey('bcs', 'public');
            $baseurl = trim(Conf::requireKey('bcs', 'baseurl'), '/') . '/' . $bucketname;
            $this->_public = new Bucket($this->bcs, $bucketname);
            $this->_public->setBaseurl($baseurl);
        }
        return $this->_public;
    }
}
