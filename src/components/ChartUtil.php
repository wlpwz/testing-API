<?php 
class ChartUtil{
    
    public static function isTrimNull($temp_value){
        if (is_null($temp_value)||trim($temp_value)=="") {
            return true;
        }
        return false;
    }

    public static function getArrayValue($key,$array,$default){
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }
        return $default;
    }
    
}
?>