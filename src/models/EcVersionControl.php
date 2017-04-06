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
class EcVersionControl extends CActiveRecord
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
                return 'ec_version_control';
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
                        array('id, version, language, ecc_version, framework_version, pagevalue_version, is_splited', 'safe', 'on'=>'search'
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
                        'version' => 'Version',
                        'language'=>'Language',
                        'ecc_version' => 'Ecc Version',
                        'framework_version' => 'Framework Version',
						'pagevalue_version'=> 'Pagevalue Version',
                        'is_splited' => 'Is Splited',
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
                $criteria->compare('version',$this->version,true);
                $criteria->compare('language',$this->language,true);
                $criteria->compare('ecc_version',$this->ecc_version,true);
                $criteria->compare('framework_version',$this->framework_version, true);
				$criteria->compare('pagevalue_version',$this->pagevalue_version, true);
                $criteria->compare('is_splited',$this->is_splited,true);

                return new CActiveDataProvider($this, array(
                        'criteria'=>$criteria,
                ));
        }
}
