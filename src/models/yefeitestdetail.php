<?php
class yefeitestdetail extends ActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'yefeitestdetail';
    }

    public function rules(){
        return array(
        );
    }

    public function relations() {
        return array(
		    'yefeitestmain'=>array(self::BELONGS_TO, 'yefeitestmain', 'task_id'),
        );
    }
}
