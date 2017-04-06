<?php
class ProjectMsg extends CApplicationComponent{
    ##项目优先级
    static $priority = ['1' => '最高', '3' => '普通'];
    ##项目分级
    static $level = ['1' => 'A级', '2' => 'B级', '3' => 'C级', '4' => 'D级'];    
    ##项目状态
    static $state = ['1' => '待提测',
                     '2' => '测试中', 
                     '5' => '测试完成'];

    static public function getPriorityList(){
        return self::$priority;
    }

    static public function getLevelList(){
        return self::$level;
    }
    
    static public function getStateList(){
        return self::$state;
    }

    static public function getTopicList($condition = ""){
        $topic = [];

        $tObj = Topic::model()->findAll($condition);
        foreach($tObj as $tval){
            $topic[$tval->id] = $tval->name;
        }
        return $topic;
    }

}
