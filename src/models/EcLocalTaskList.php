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
class EcLocalTaskList extends CActiveRecord
{
        public $sort_default;
        /**
         * Returns the static model of the specified AR class.
         * @param string $className active record class name.
         * @return TsPagediffTaskinfo the static model class
         */
        public static function model($className=__CLASS__)
        {
                return parent::model($className);
        }

        /**
         * @return string the associated database table name
         */
        public function tableName()
        {
                return 'LocalRun';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
                // NOTE: you should only define rules for those attributes that
                // will receive user inputs.
                return array(
                        // The following rule is used by search().
                        // Please remove those attributes that should not be searched.
                        array('run_task_id, time, user, related_run_id, diff_id, log_path, host_name, run_path, status, bin_output_new, bin_output_old, ec_type, conf_new, conf_old, input_path, input_num', 'safe', 'on'=>'search'
                         ),
                );
        }

        /**
         * @return array relational rules.
         */
        public function relations()
        {
                // NOTE: you may need to adjust the relation name and the related
                // class name for the relations automatically generated below.
                return array(
                );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
  /*      public function attributeLabels()
        {
                return array(
                        'run_task_id' => 'Run_Task_Id',
                        'time'=>'Time',
						'user'=>'User',
						'related_run_id'=>'Related Run Id',
						'diff_id'=>'Diff Id',
						'log_path'=>'Log Path',
						'host_name'=>'Host Name',
						'run_path'=>'Run Path',
						'status'=>'Status',
 						'bin_output_new'=>'Bin Output New',
						'bin_output_old'=>'Bin Output Old',
						'ec_type'=>'Ec Type',
						'conf_new'=>'Conf New',
						'conf_old'=>'Conf Old',
						'input_path'=>'Input Path',
						'input_num'=>'Input Num',
                );
        }*/

        /**
         * Retrieves a list of models based on the current search/filter conditions.
         * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
         */
        public function search()
        {
                // Warning: Please modify the following code to remove attributes that
                // should not be searched.

                $criteria=new CDbCriteria;

                $criteria->compare('TASK_ID',$this->TASK_ID);
				$criteria->compare('USER',$this->USER);
                $criteria->compare('TIME',$this->TIME,true);
                $criteria->compare('STATUS',$this->STATUS,true);
                $criteria->compare('CMD',$this->CMD,true);
                $criteria->compare('RUN_RESULT',$this->RUN_RESULT,true);
				$criteria->compare('newolddiff',$this->newolddiff,true);
				$criteria->compare('newdiff',$this->newdiff,true);
				$criteria->compare('olddiff',$this->olddiff,true);
				$criteria->compare('memory',$this->memory,true);
				$criteria->compare('speed',$this->speed,true);
				$criteria->compare('Valgrind',$this->Valgrind,true);

                return new CActiveDataProvider($this, array(
                        'criteria'=>$criteria,
                ));
        }
}
