<?php
class CommonCountData extends CApplicationComponent{
		
    public static function getTid($type){
        $obj = CountType::model()->find(array("condition" => " `type`=:type ", "params" => array(":type" => $type)));

        if($obj)
            return $obj->id;
        return false;
    }


		public static function getDataByType($type, $limit = 30){
				$data = $crit = array();

			  $tid = self::getTid($type);
				$crit["condition"] = " `tid`=:tid order by ctime desc ";
				$crit["params"] = array(":tid" => $tid);
				$data = CountData::model()->findAll($crit);

				return $data;
		}

		public static function getNewestData($crit, $type = "daily"){
        $modName = "CountData";

        $data = CountData::model()->find($crit);
        return $data;
    }

}
