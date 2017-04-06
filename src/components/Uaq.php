<?php
class Uaq extends CApplicationComponent{
    public $service;
    public $tpl;

    const ACTION_START = '/common/start';
    const ACTION_RESULT = '/common/result';    
   
    protected function genSign($data){
        return $this->tpl;
    }
 
    protected function get($action, $data, $raw = false)
    {
        $data['tpl'] = $this->tpl;
        $data['sign'] = $this->genSign($data);
        $url = "{$this->service}{$action}?". http_build_query($data);
        $result = Yii::app()->simpleCurl->get($url, $data);
    
        $code = json_decode($result, true);
        if($raw===false){
            return $code;
        }else{
            return $result;
        }
    }

    public function start($url)
    {
        if ($url){ 
            $data = [];
            $data['testURL'] = $url; 
            $result = $this->get(self::ACTION_START, $data); 
            
            if ($result && isset($result['statusCode']) && $result['statusCode']=='200'){
                return $result['testID'];
            } elseif (@$result['statusCode'] !== '400') {
                //Logger::warning("UAQ服务返回结果异常，[%s]",[var_export($result, true)]);
            }
        }
        return false;
    }
    public function result($id, $raw = false)
    {
        $data = [];
        $data['testId'] = $id;
        $result = $this->get(self::ACTION_RESULT, $data, $raw);

        return $result;
    }

}
