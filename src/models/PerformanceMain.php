<?php
class PerformanceMain extends ActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'performance_main';
    }

    public function rules(){
        return array(
        );
    }

    public function relations() {
        return array(
			'qpsdetail'=>array(self::HAS_ONE, 'qpsperfdetail','task_id'),
		    'performance_detail'=>array(self::HAS_ONE, 'PerformanceDetail', 'task_id'),
        );
    }
}
