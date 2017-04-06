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
class EcMonitor extends CActiveRecord
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
                return 'ec_monitor';
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
                        array('task_id,time,user,input,description,ec1_result, ec2_result', 'safe', 'on'=>'search'
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
        public function attributeLabels()
        {
                return array(
                        'task_id' => 'Task Id',
                        'time'=>'Time',
						'user'=>'User',
						'input'=>'Input',
                        'description' => 'Description',
						'ec1_result'=>"EC1 Result",
						'ec2_result'=>"EC2 Result",
                );
        }

        /**
         * Retrieves a list of models based on the current search/filter conditions.
         * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
         */
        public function search()
        {
                // Warning: Please modify the following code to remove attributes that
                // should not be searched.

                $criteria=new CDbCriteria;

                $criteria->compare('task_id',$this->task_id);
                $criteria->compare('time',$this->time,true);
				$criteria->compare('user',$this->user,true);
				$criteria->compare('input',$this->input,true);
				$criteria->compare('description',$this->description,true);
				$criteria->compare('ec1_result',$this->ec1_result,true);
				$criteria->compare('ec2_result',$this->ec2_result,true);

                return new CActiveDataProvider($this, array(
                        'criteria'=>$criteria,
                ));
        }
}
