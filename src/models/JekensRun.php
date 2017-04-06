<?php
class JekensRun extends ActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'JekensRun';
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
