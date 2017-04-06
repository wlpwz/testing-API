<?php

class ChartTPL{

    public static $CHART_OPTION_CHART_TITLE="chart_title";
    public static $CHART_OPTION_CHART_HEIGHT="chart_height";
    public static $CHART_OPTION_LABEL_X="label_x";
    public static $CHART_OPTION_LABEL_Y_UNIT="label_y_unit";
    public static $CHART_OPTION_LABEL_Y_PRECISION="label_y_precision";
    public static $CHART_OPTION_LEGEND="legend";
    public static $CHART_OPTION_LEGEND_NO_LEGEND="legend_no";
    public static $CHART_OPTION_LEGEND_X="legend_x";
    public static $CHART_OPTION_LEGEND_X_CENTER="center";
    public static $CHART_OPTION_LEGEND_X_LEFT="left";
    public static $CHART_OPTION_LEGEND_X_RIGHT="right";
    public static $CHART_OPTION_LEGEND_Y="legend_y";
    public static $CHART_OPTION_LEGEND_Y_CENTER="center";
    public static $CHART_OPTION_LEGEND_Y_TOP="top";
    public static $CHART_OPTION_LEGEND_Y_BOTTOM="bottom";
    public static $CHART_OPTION_LEGEND_ORIENT="legend_orient";
    public static $CHART_OPTION_LEGEND_ORIENT_V="vertical";
    public static $CHART_OPTION_LEGEND_ORIENT_H="horizontal";
    public static $CHART_OPTION_DATA_SEP="data_sep";
    public static $CHART_OPTION_DATA_SEP_DEFAULT=",";
    public static $CHART_OPTION_TITLE_POSITION_X_LEFT="left";
    public static $CHART_OPTION_TITLE_POSITION_X_RIGHT="right";
    public static $CHART_OPTION_TITLE_POSITION_X_CENTER="center";
    public static $CHART_OPTION_TITLE_POSITION_Y_TOP="top";
    public static $CHART_OPTION_TITLE_POSITION_Y_BOTTOM="bottom";
    public static $CHART_OPTION_TITLE_POSITION_Y_CENTER="center";

    const CHART_LINE="line";
    const CHART_BAR="bar";
    const CHART_PIE="pie";


    public $title=array();
    public $tooltip=array();
    public $legend=array();
    public $toolbox=array();
    public $calculable=true;
    public $series=array();

    function __construct($name,$data,$options){
        $legend_v=ChartUtil::getArrayValue(ChartTPL::$CHART_OPTION_LEGEND_ORIENT, $options, "");
        $legend_x=ChartUtil::getArrayValue(ChartTPL::$CHART_OPTION_LEGEND_X, $options, "");
        $legend_y=ChartUtil::getArrayValue(ChartTPL::$CHART_OPTION_LEGEND_Y, $options, "");
        $this->setLegend($legend_v,$legend_x,$legend_y);
        $title=ChartUtil::getArrayValue(ChartTPL::$CHART_OPTION_CHART_TITLE, $options, "");
        $this->setTitle($title);

    }

    public function toJson(){
        return json_encode($this);
    }
/*

*/
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

   public function setTitle($title){
    $this->title["subtext"]="";
    $this->title["text"]=$title;
    if (ChartUtil::isTrimNull($title)) {
        $this->title["x"]=self::$CHART_OPTION_TITLE_POSITION_X_RIGHT;
        $this->title["y"]=self::$CHART_OPTION_TITLE_POSITION_Y_BOTTOM;
    }

   }



// private static $template='{
//     title : {
//         x:"center"
//     },
//     tooltip : {
//         trigger: "",
//          formatter: "{a} <br/>{b} : {c} ({d}%)"
//     },
//     legend: {
//         orient : "vertical",
//         x : "left",
//         data:["直接访问","邮件营销","联盟广告","视频广告","搜索引擎"]
//     },
//     toolbox: {
//         show : true,
//         feature : {
//             mark : true,
//             dataView : {readOnly: false},
//             restore : true
//         }
//     },
//     calculable : true,
//     series : [
//         {
//             name:"访问来源",
//             type:"pie",
//             itemStyle : {
//                 normal : {
//                     label : {
//                         position : "outer"
//                     },
//                     labelLine : {
//                         show : true
//                     }
//                 }
//             },
//             data:[
//                 {value:335, name:"直接访问"},
//                 {value:310, name:"邮件营销"},
//                 {value:234, name:"联盟广告"},
//                 {value:135, name:"视频广告"},
//                 {value:1548, name:"搜索引擎"}
//             ]
//         }
//     ]
// }';

// public function getDefaultOption(){
//     return self::$template;
// }

    



}
?>
