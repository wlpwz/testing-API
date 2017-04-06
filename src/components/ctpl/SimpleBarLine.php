<?php
/// require dirname(__FILE__)."/ChartUtil.php";
/// require dirname(__FILE__)."/ChartTPL.php";

class SimpleBarLineTPL extends SimpleLineBarTPL {

     function __construct($name, $data, $options) {
        parent::__construct($name, $data, $options);
    }
    
    public function setToolbox() {
        $this->toolbox["show"] = true;
        $readOnly["readOnly"] = false;
        $magicType = array(
            ChartTPL::CHART_LINE,
            ChartTPL::CHART_BAR
        );
        $feature["mark"] = true;
        $feature["restore"] = true;
        $feature["dataView"] = $readOnly;
        $feature["saveAsImage "] = true;
        $feature["magicType"] = $magicType;
        $this->toolbox["feature"] = $feature;
    }
    public function setData($name, $data, $options) {
        $sep = self::getSep($options);
        $legend_data = array();
        
        foreach ($data as $key => $value) {
            $legend_data[] = $key;
            $serie = array();
            $serie["name"] = $key;
            $serie["type"] = ChartTPL::CHART_BAR;
			$serie["symbol"] = 'heart';
            $temp_data = explode($sep, $value);
            $data_result = array();
            
            foreach ($temp_data as $tvalue) {
                $data_result[] = (float)(trim($tvalue));
            }
            $serie["data"] = $data_result;
            $this->series[] = $serie;
        }
        $this->legend["data"] = $legend_data;
    }
   
    public function setXAxis($options) {
        // ldata : ['周一','周二','周三','周四','周五','周六','周日']
        $x["type"] = 'category';
        $sep = self::getSep($options);
        $xaxis_data = explode($sep, $options[ChartTPL::$CHART_OPTION_LABEL_X]);
        $x["data"] = $xaxis_data;
        $this->xAxis[] = $x;
    }
    
    
}
?>
