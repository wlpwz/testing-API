<?php
define("CONST_CHART_TYPE_SIMPLE_PIE", "PIE");
define("CONST_CHART_TYPE_PIES", "PIES");
define("CONST_CHART_TYPE_LINE_BAR_BASIC", "LINE_BAR_BASIC");
define("CONST_CHART_TYPE_BAR_LINE_BASIC", "BAR_LINE_BASIC");
define("CONST_CHART_TYPE_MIX_PLB", "MP1LsBs");
define("CONST_CHART_DEFAULT_HEIGHT", 400);
/// require_once(dirname(__FILE__) . "/ChartTemplateFactory.php");

class ChartFactory {
    const CONST_CHART_TYPE_BAR_LINE_BASIC="BAR_LINE_BASIC";
    const CONST_CHART_TYPE_LINE_BAR_BASIC="LINE_BAR_BASIC";
    const CONST_CHART_TYPE_SIMPLE_PIE="PIE";
    public static $id = 0;
    public static function renderChart($id, $type, $data, $option, $height = CONST_CHART_DEFAULT_HEIGHT) {
        // get template option
        $option_str = ChartTemplateFactory::getTemplateByType($type, $id, $data, $option);
        // var_dump($option);
        // echo "<br>";
        // var_dump($option_str);
        // set data into template
        //...
        // deal with option if exist
        //..
        // render to the page
        self::renderOption($id, $option_str, $height);
    }
    public static function renderOption($id = "0", $json_option, $height) {
        // $chart_id;
        // if ($id=="0") {
        // 	self::$id=self::$id+1;
        // 	$chart_id="chart".toString(self::$id);
        // }
        
?>
		<div id="<?php echo $id ?>"  style="height:<?php echo $height ?>px;"></div>
		<div>
			<script>
		 		var temp_option= <?php  echo $json_option ?> ;
                                            	var temp_id="<?php echo $id ?>" ;
		 		var temp_object = {id:temp_id,value:temp_option};
                var chart_array= new Array();
		 		chart_array.push(temp_object);
			</script>
		</div>

		<?php
    }
}
?>
