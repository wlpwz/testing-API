<?php
define ('SORT_KEY', 1);
define ('SORT_VALUE_NUMERIC', 2);
define ('SORT_VALUE', 3);

class ChartJsonAdaptor{
	public static $fillColor="#69D2E7";
	public static $strokeColor="rgba(220,220,220,1)";


	public static function genDataJson($data, $remove_zero = FALSE){
		if (!isset($data)  || is_null($data) /*|| trim($data)==""*/ || count($data)==0){
			return "";
		}
		else{
			$result=array();
			foreach ($data as $key => $value) {
			    if ($remove_zero && $value == 0)
			        continue;
				$item=array();
				$item["value"]=$value;
				$item["argument"]=$key;
				$result[]=$item;
			}
			return json_encode($result);
		}
	}

	public static function genStaticJson($static, $sort_type = SORT_VALUE_NUMERIC){
		if (!isset($static)  || is_null($static) /*|| trim($static)==""*/ || count($static)==0){
			return "";
		}
		else{
			$result=array();
			$label=array();
			$data=array();
			$dataset=array();
			$datasets=array();
			
			if ($sort_type === SORT_VALUE_NUMERIC)
			    asort($static, SORT_NUMERIC);
			else if ($sort_type === SORT_KEY)
			    ksort($static);
			else if ($sort_type === SORT_VALUE)
			    asort($static);
			
			foreach ($static as $key => $value) {
			    $str = $key . "";                                // 确保key被转化为字符串，应对PHP解码json时的bug
			    if ($str == "__other__")
			        $str = "其它值汇总";
				if (mb_strlen($str, "utf-8") > 15)
				{
				    $str = mb_substr($str, 0, 15, "utf-8");      // key过长时图表无法正常显示，注意使用utf-8来截取
				}
				$label[]=$str;
				$data[]=$value;
			}
			$dataset["data"]=$data;
			$dataset["fillColor"]=self::$fillColor;
			$dataset["strokeColor"]=self::$strokeColor;
			$datasets[]=$dataset;
			$result["labels"]=$label;
			$result["datasets"]=$datasets;
			return json_encode($result);
		}

	}

	

}
?>