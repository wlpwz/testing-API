<?php
/**
 * File Name: POP.php
 * URI: http://pop.baidu.com/
 * Author: Baidu Inc.
 * Description: A library 
 *
 */
require(dirname(__FILE__).DIRECTORY_SEPARATOR . '/popsdk_config.php');

class POP{
    private static $_LOGPATH;  
    private static $_LOGFILE;
    private static $_HISTORYDAYCOUNT = 30;      //day to keep log
    private static $_VERSION = "1.0";  

    /**
     *initializer
     *
     */
    public static function init(){
        if(!POP_LOG_FILE_PATH){
            return;
        }
  
        $pathArr = explode("/", POP_LOG_FILE_PATH);
        POP::$_LOGFILE = array_pop($pathArr);
        POP::$_LOGPATH = implode("/", $pathArr);
     
        if(POP_LOG_KEEP_DAY){
            POP::$_HISTORYDAYCOUNT = intval(POP_LOG_KEEP_DAY);
        }
     
        //clear history file
        POP::clearHistoryFile();     
    }

    
   /**
    * POP log interface
    * @name string monitor item name
    * @value string $value monitor value
    * @extra string or array $extra the details of the visit such as username .et
    *
    * @return written info length 
    *
    */
    public static function log($name, $value, $extra){
        $length = 0;
        $file = POP::getRealfile();
        
        if(false === $file){
            POP::errorLog("Log Path Cannot Be Accessed!");
            return 0;
        }

        $fp = @fopen($file, "a");
        if($fp){
            $record = POP::getRecord($name, $value, $extra);
            $length = fwrite($fp, $record."\n");
        }
        fclose($fp);
        return $length;
    }

    public static function version(){
        return POP::$_VERSION;
    }
    

    /************************************************************************************************************/
    protected static function getRecord($name, $value, $extra){
        if(is_array($extra)){
            $istring = json_encode($extra);
        }else{
            $istring = $extra;
        }

        $time = time();        

        $record = "{$istring}\t{$value}\t{$time}\t{$name}";
        return $record;
    }

     /** 
     * logfile will be splitted by date(YYmmdd)
     *
     * @param array $info log details
     *
     * @return string pop needed
     */
    protected static function getRealfile(){
        $date = date("Ymd", time());
        if(!POP::$_LOGPATH){
            return false;
        }

        if(!is_dir(POP::$_LOGPATH)){
            mkdir(POP::$_LOGPATH, 0777, true);
        }

        $logfile = POP_LOG_FILE_PATH.".".$date;
        return $logfile;
    }

     /** 
     * clear old log file
     *
     */
    protected static function clearHistoryFile(){
        $date = date("Ymd", time() - POP::$_HISTORYDAYCOUNT*86400);
        $filename = POP_LOG_FILE_PATH.".".$date;
     
        if(file_exists($filename)){
            $cmd = "rm -r {$filename}";
            exec($cmd, $info);
        }
    }
    
    protected static function errorLog($msg){
        $err = dirname(__FILE__)."/log/";
        if(!is_dir($err)){
            mkdir($err, 0777, true);
        }        
        $fp = fopen($err."pop.log.error", "a");
        if($fp){
            fwrite($fp, "[".date("Y-m-d H:i:s")."] {$msg}\n");
        }
        fclose($fp);
    }


}

POP::init();
