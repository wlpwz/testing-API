<?php
// require_once(dirname(__FILE__) . "/ctpl/ChartTpl.php");
/// require_once(dirname(__FILE__) . "/ctpl/SimplePieTpl.php");

class ChartTemplateFactory {
    public static function getTemplateByType($chartType, $id, $data, $option) {
        switch ($chartType) {
            case ChartFactory::CONST_CHART_TYPE_SIMPLE_PIE:
                $chartObj = new SimplePieTPL($id, $data, $option);
                return $chartObj->toJson();
            case ChartFactory::CONST_CHART_TYPE_LINE_BAR_BASIC:
                $chartObj = new SimpleLineBarTPL($id, $data, $option);
                return $chartObj->toJson();
            case ChartFactory::CONST_CHART_TYPE_BAR_LINE_BASIC:
                $chartObj = new SimpleBarLineTPL($id, $data, $option);
                return $chartObj->toJson();
            default:
                // code...
                break;
        }
    }
}
?>