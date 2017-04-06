<?php
class Drainage extends ActiveRecord {

	public $fifos;
	public $sents;
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'tb_drainage';
    }
/*
    public function getDbConnection() {
        return Yii::app()->drainagedb;
    }
*/

    public function rules(){
        return array(
        );
    }

    public function relations() {
        return array(
        );
    }
}
