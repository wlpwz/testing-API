<?php 

/// require dirname(__FILE__)."/ChartUtil.php";
/// require dirname(__FILE__)."/ChartTPL.php";

class SimplePieTPL extends ChartTPL{

    function __construct($name,$data,$options){
        parent::__construct($name,$data,$options);
        $this->setToolbox();
        $this->setToolTip();
        $this->setData($name, $data,$options);
    }

    public function toJson(){
        return json_encode($this);
    }

    public function setToolbox(){
        $this->toolbox["show"]=true;
        $readOnly["readOnly"]=false;
        $feature["mark"]=true;
        $feature["restore"]=true;
         $feature["saveAsImage"] = true;
        $feature["dataView"]=$readOnly;
        $this->toolbox["feature"]=$feature;
    }

     public function setData($data_name,$dataArray,$options=array()){
        $serie=array();
        $serie["name"]=$data_name;
        $serie["type"]="pie";
        $legend_data=array();
        foreach ($dataArray as $key => $value) {
            $serie["data"][]=array("value"=>$value,"name"=>$key);
            $legend_data[]=$key;
        }
        $legend_no=StringUtil::invalid2Default($options[ChartTPL::$CHART_OPTION_LEGEND_NO_LEGEND],false);
        if ($legend_no==false) {
            $this->legend["data"]=$legend_data;
        }
        $this->series[]=$serie;
    }

   public function setToolTip(){
        $this->tooltip["trigger"]="item";
        $this->tooltip["formatter"]="{b} : {c} ({d}%)";
   }

   public function setLegend($orient,$x,$y){
        if (ChartUtil::isTrimNull($orient)) {
           $orient=ChartTPL::$CHART_OPTION_LEGEND_ORIENT_V;
        }
        if (ChartUtil::isTrimNull($x)) {
            $x=ChartTPL::$CHART_OPTION_LEGEND_X_LEFT;
        }
        if (ChartUtil::isTrimNull($y)) {
            $y=ChartTPL::$CHART_OPTION_LEGEND_Y_BOTTOM;
        }
        $this->legend["orient"]=$orient;
        $this->legend["x"]=$x;
        $this->legend["y"]=$y;
    }

}
?>