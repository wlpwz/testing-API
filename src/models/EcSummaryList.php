<?php

/**
 * This is the model class for table "ts_pagediff_taskinfo".
 *
 * The followings are the available columns in table 'ts_pagediff_taskinfo':
 * @property integer $id
 * @property int $task_id
 * @property string $api_name
 * @property int $frequency
 * @property int $data_num
 */
class EcSummaryList extends CActiveRecord
{
        /**
         * Returns the static model of the specified AR class.
         * @param string $className active record class name.
         * @return TsPagediffTaskinfo the static model class
         */
		//public $sort_default;
	
        public static function model($className=__CLASS__)
        {
                return parent::model($className);
        }

        /**
         * @return string the associated database table name
         */
        public function tableName()
        {
                return 'ec_summary_list';
        }

		/*
		public function getDbConnetion(){
				return Yii::app()->db;
		}
		*/

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
                // NOTE: you should only define rules for those attributes that
                // will receive user inputs.
                return array();
        }

        /**
         * @return array relational rules.
         */
        public function relations()
        {
                // NOTE: you may need to adjust the relation name and the related
                // class name for the relations automatically generated below.
                return array();
        }
		
		public function search()
        {
                // Warning: Please modify the following code to remove attributes that
                // should not be searched.

                $criteria=new CDbCriteria;

                $criteria->compare('ID',$this->ID);
                $criteria->compare('time',$this->time,true);
                $criteria->compare('user',$this->user,true);
                $criteria->compare('summery',$this->summery,true);
                $criteria->compare('compile_id',$this->compile_id,true);
                $criteria->compare('run_id',$this->run_id, true);
                $criteria->compare('diff_task_id',$this->diff_task_id,true);
  

                return new CActiveDataProvider($this, array(
                        'criteria'=>$criteria,
                ));
        }
}
