<?php
class qpsperfdetail extends ActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'qpsperfdetail';
    }

    public function rules(){
        return array(
        );
    }

    public function relations() {
        return array(
		    'qpsmain'=>array(self::BELONGS_TO, 'PerformanceMain', 'task_id'),
        );
    }
}
