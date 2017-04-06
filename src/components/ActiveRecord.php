<?php
class ActiveRecord extends CActiveRecord {
    public function getDbConnection() 
	{
		return Yii::app()->db;
	}
	public function exportattributes(){
		return $this->attributes;
	}
    public function toArray(){
        $return=$this->exportattributes();
        foreach(array_keys((array)$this->getMetaData()->relations) as $r){
            if($this->hasRelated($r) && isset($this->$r)){
                if(is_a($this->$r, 'CActiveRecord'))
                    $return[$r]=$this->{$r}->toArray();
                elseif(is_array($this->$r)){
                    $return[$r]=array();
                    foreach($this->$r as $k=>$v){
                        $return[$r][$k]=$v->toArray();
                    }
                }else
                    $return[$r]=$this->$r;
            }
        }
        return $return;
    }
    /**
    *artoarray for ActiveRecord, it recursively all data to transfer ActiveRecord to array
    */
    static function artoarray($obj){ //ActiveRecord to array
        self::_artoarray($obj);
        return $obj;
    }
    private static function _artoarray(&$obj){
        if(is_a($obj, 'CActiveRecord')){
            $obj=$obj->toArray();
        }elseif(is_array($obj)){
            foreach($obj as &$item){
                self::_artoarray($item);
            }
        }
    }
    public function page($condition='', $params=array()){
		if(is_string($condition) || is_null($condition)){
			$condition=array('condition'=>(string)$condition);
			if(!empty($params))
				$condition['params']=$params;
		}
		if(is_array($condition)){
			if(isset($condition['pagesize']))
				$condition['limit']=$condition['pagesize'];
			if(isset($condition['page']))
				$page=$condition['page'];
			unset($condition['page']);
			unset($condition['pagesize']);
			$condition=new CDbCriteria($condition);
            if($condition->offset<0) 
                $condition->offset=0;
		}elseif(is_a($condition, 'CDbCriteria')){
            if(isset($params['page']))
                $page=$params['page'];
            if(isset($params['pagesize']))
                $condition->limit=$params['pagesize'];
        }
		if(is_a($condition, 'CDbCriteria')){
			if($condition->limit<1)
				$condition->limit=defined('PAGESIZE') ? constant('PAGESIZE') : 10;
			if(isset($page) && $page>0)
				$condition->offset=($page-1)*$condition->limit;
			else
				$page=ceil(intval($condition->offset)/$condition->limit)+1;
		}
		$count=$this->count($condition);
		return array(
			'count'=>$count, 
			'list'=>$count>0 ? $this->findAll($condition): array(), 
			'pagesize'=>@$condition->limit, 
			'page'=>@$page,
			'offset'=>@$condition->offset);
	}
	
  public function page2($condition='', $params=null, $page=1, $pagesize=10){
        if($pagesize<1)
            $pagesize=defined('PAGESIZE') ? constant('PAGESIZE') : 10;
        $page=(int) $page;
        if($page<1)
            $page=1;
        $ret=array('count'=>0, 'list'=>array(), 'page'=>$page, 'pagesize'=>$pagesize, 'offset'=>($page-1)*$pagesize);
        $criteria=$this->getCommandBuilder()->createCriteria($condition,(array)$params);
        $dbc = $this->getDbCriteria();
        $count=$this->count($criteria);
        $this->setDbCriteria($dbc);
        if($count){
            $ret['count']=$count;
            if($ret['offset']<$count){
                $criteria->limit=$pagesize;
                $criteria->offset=$ret['offset'];  
                $ret['list']=$this->findAll($criteria);
            }
        }
        return $ret;
    }
   
}
