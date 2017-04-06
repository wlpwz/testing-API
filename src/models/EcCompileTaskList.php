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
class EcCompileTaskList extends CActiveRecord
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
                return 'ec_compile_task_list';
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
                        array('id, time, new_output_path, old_output_path, new_version, old_version, user, log_path, host_name, status, new_module_list, old_module_list', 'safe', 'on'=>'search'
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
                        'id' => 'ID',
                        'time'=>'Time',
 						'new_output_path'=>'New Output Path',
						'old_output_path'=>'Old Output Path',
						'new_version'=>'New Version',
						'old_version'=>'Old Version',
						'user'=>'User',
						'log_path'=>'Log Path',
						'host_name'=>'Host Name',
						'status'=>'Status',
						'new_module_list'=>'New Module List',
						'old_module_list'=>'Old Module List',
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

                $criteria->compare('id',$this->id);
                $criteria->compare('time',$this->time,true);
				$criteria->compare('new_output_path',$this->new_output_path,true);
				$criteria->compare('old_output_path',$this->old_output_path,true);
				$criteria->compare('new_version',$this->new_version,true);
				$criteria->compare('old_version',$this->old_version,true);
				$criteria->compare('user',$this->user,true);
				$criteria->compare('log_path',$this->log_path,true);
				$criteria->compare('host_name',$this->host_name,true);
				$criteria->compare('status',$this->status, true);
				$criteria->compare('new_module_list',$this->new_module_list, true);
				$criteria->compare('old_module_list',$this->old_module_list, true);

                return new CActiveDataProvider($this, array(
                        'criteria'=>$criteria,
                ));
        }
}
