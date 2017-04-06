<?php
/// require dirname(__FILE__)."/ChartUtil.php";
/// require dirname(__FILE__)."/ChartTPL.php";

class SimpleLineBarTPL extends ChartTPL {
    public $xAxis = array();
    public $yAxis = array();
    function __construct($name, $data, $options) {
        parent::__construct($name, $data, $options);
        $this->setToolbox();
        $this->setToolTip();
        $this->setXAxis($options);
        $this->setYAxis($options);
        $this->setData($name, $data, $options);
    }
    public function setLegend($orient, $x, $y) {
        parent::setLegend(ChartTPL::$CHART_OPTION_LEGEND_ORIENT_H, ChartTPL::$CHART_OPTION_LEGEND_X_CENTER, ChartTPL::$CHART_OPTION_LEGEND_Y_TOP);
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
        $feature["saveAsImage"] = true;
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
			$serie["symbol"] = "none";
            $serie["type"] = ChartTPL::CHART_LINE;
            $serie["symbol"] = "none";
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
    public function setToolTip() {
        $this->tooltip["trigger"] = "axis";
    }
    public function setXAxis($options) {
        // ldata : ['周一','周二','周三','周四','周五','周六','周日']
        $x["type"] = 'category';
        $x["boundaryGap"] = false;
        $sep = self::getSep($options);
        $xaxis_data = explode($sep, $options[ChartTPL::$CHART_OPTION_LABEL_X]);

        $x["data"] = $xaxis_data;
        $this->xAxis[] = $x;
    }
    public function setYAxis($options) {
        $label_unit = $options[ChartTPL::$CHART_OPTION_LABEL_Y_UNIT];
        $precision = $options[ChartTPL::$CHART_OPTION_LABEL_Y_PRECISION];
        $y["type"] = 'value';
        if (trim($precision) !="") {
             $y["precision"] = $precision;
        }
        $splitArea["show"] = true;
        $y["splitArea"] = $splitArea;
        if (ChartUtil::isTrimNull($label_unit)==false) {
            $axisLabel["formatter"]='{value}'.$label_unit;
            $y["axisLabel"]=$axisLabel;
        }
        $this->yAxis[] = $y;
    }
    public static function getSep($options) {
        $sep = $options[ChartTPL::$CHART_OPTION_DATA_SEP];
        if (ChartUtil::isTrimNull($sep)) {
            $sep = ChartTPL::$CHART_OPTION_DATA_SEP_DEFAULT;
        }
        
        return $sep;
    }
}
?>
