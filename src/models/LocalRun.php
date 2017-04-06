<?php
class LocalRun extends ActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'LocalRun';
    }

    public function rules(){
        return array(
        );
    }

    public function relations() {
        return array(
        );
    }
}
