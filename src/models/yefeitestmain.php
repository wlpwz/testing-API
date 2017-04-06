<?php
class yefeitestmain extends ActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'yefeitestmain';
    }

    public function rules(){
        return array(
        );
    }

    public function relations() {
        return array(
		    'yefeitestdetail'=>array(self::HAS_ONE, 'yefeitestdetail', 'task_id'),
        );
    }
}
