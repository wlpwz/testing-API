<?php
class PerformanceDetail extends ActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'performance_detail';
    }

    public function rules(){
        return array(
        );
    }

    public function relations() {
        return array(
		    'performance_main'=>array(self::BELONGS_TO, 'PerformanceMain', 'task_id'),
        );
    }
}
