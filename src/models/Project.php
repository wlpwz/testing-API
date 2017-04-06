<?php
class Project extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ConfigUserlog the static model class
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
		return 'project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
            array( 'content,icafe, module, level, priority, version, codelines, rd, lift_date, online_date, influence, state, topic_id', 'safe')
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
    
    public function defaultScope(){
        return array(
            "condition" => " `is_del`=0 ",
            "order" => "update_time desc"
        );
        
    }


}
