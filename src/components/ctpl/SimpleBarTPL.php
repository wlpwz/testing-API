<?php 

///require dirname(__FILE__)."/ChartUtil.php";
///require dirname(__FILE__)."/ChartTPL.php";

class SimplePBarTPL extends ChartTPL{

    function __construct($name,$data,$options){
        parent::__construct();
        $this->setDeaultToolbox();
        $this->setDefaultToolTip();
        $legend_v=ChartUtil::getArrayValue(CHART_OPTION_LEGEND_ORIENT, $options, "");
        $legend_x=ChartUtil::getArrayValue(CHART_OPTION_LEGEND_X, $options, "");
        $legend_y=ChartUtil::getArrayValue(CHART_OPTION_LEGEND_Y, $options, "");
        $this->setLegend($legend_v,$legend_x,$legend_y);
        $this->setData($name, $data);
    }

    public function toJson(){
        return json_encode($this);
    }

    public function setLegend($orient,$x,$y){
        if (ChartUtil::isTrimNull($orient)) {
           $orient=CHART_OPTION_LEGEND_ORIENT_V;
        }
        if (ChartUtil::isTrimNull($x)) {
            $x=CHART_OPTION_LEGEND_X_RIGHT;
        }
        if (ChartUtil::isTrimNull($y)) {
            $y=CHART_OPTION_LEGEND_Y_BOTTOM;
        }
        $this->legend["orient"]=$orient;
        $this->legend["x"]=$x;
        $this->legend["y"]=$y;
    }

    public function setDeaultToolbox(){
        $this->toolbox["show"]=true;
        $readOnly["readOnly"]=false;
        $feature["mark"]=true;
        $feature["restore"]=true;
        $feature["dataView"]=$readOnly;
        $this->toolbox["feature"]=$feature;
    }

     public function setData($data_name,$dataArray){
        $serie=array();
        $serie["name"]=$data_name;
        $serie["type"]="pie";
        foreach ($dataArray as $key => $value) {
            $serie["data"][]=array("value"=>$value,"name"=>$key);
            $this->legend["data"][]=$key;
        }
        $this->series[]=$serie;
    }

   public function setDefaultToolTip(){
        $this->tooltip["trigger"]="item";
        $this->tooltip["formatter"]="{b} : {c} ({d}%)";
   }

}
?>