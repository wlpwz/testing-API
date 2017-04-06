<?php
class Requirement extends ActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'requirement';
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
