<?php

class ToolsController extends Controller
{
	public $layout = "main";
	public function filters()
    {
        return array('popLog');
    }
    public function filterPopLog(CFilterChain $chain){
    $username = Yii::app()->user->name; //获取登录用户，注意结合项目实际获取方式更改
    $url = $chain->controller->id."/".$chain->action->id;
    POP::log("page", $url, $username);
    $chain->run();
    }       	
	public function actionIndex(){
        $this->renderPartial('index', $r);
	}

	public function actionMemorystatic(){
	    $this->layout='//layouts/blank';
        $data = array();
        $memory_ftp=trim($_GET['memory_ftp']);
		
		$cmd = "sh /home/work/ec_test_service/script/memorystatic.sh -i  {$memory_ftp} &>/home/work/ec_test_service/script/memorystatic.sh.log ";exec($cmd);
        $cmd = "cat /home/work/ec_test_service/script/tmp/memory/timefile";exec($cmd, $memorytime);
        $cmd = "cat /home/work/ec_test_service/script/tmp/memory/physicalmemoryfile";exec($cmd,$physicalmemory);
        $cmd = "cat /home/work/ec_test_service/script/tmp/memory/maxmemoryfile";exec($cmd,$maxmemory);
        $cmd = "cat /home/work/ec_test_service/script/tmp/memory/minmemoryfile";exec($cmd,$minmemory);
        $cmd = "cat /home/work/ec_test_service/script/tmp/memory/averagememoryfile";exec($cmd,$averagememory);


        #$data['maxmemory'] = $maxmemory[0];
        #$data['minmemory'] = $minmemory[0];
        #$data['averagememory'] = $averagememory[0];

        $data=$physicalmemory[0];
        $label_x=$memorytime[0];
        $height="260";
		$label_y_unit="g";
		$legend = array();
		$legend['0']="最大物理内存";
		$legend['1']="最小物理内存";
        $result_data=$this->transferGetData($data);
        $options=$this->transferOptions($label_x,$label_y_unit,$label_y_precision,$legend);
        $chart_id=ChartFactory::CONST_CHART_TYPE_LINE_BAR_BASIC."_".md5(rand());
        $this->render('chart',array(
            "data"=>$result_data,
            "options"=>$options,
            "height"=>$height,
            'chart_type'=>ChartFactory::CONST_CHART_TYPE_LINE_BAR_BASIC,
            'chart_id'=>$chart_id,

			'maxmemory'=>$maxmemory[0],
			'minmemory'=>$minmemory[0],
			
            ));
	}
    public function actionMemoryAPI()
    {
                        $this->layout='//layouts/blank';
                        $file = $_GET["file_path"];
                        $fp = fopen($file, "r");
                        if (!$fp)
                             return true;
                        $model1_string="RSS";
                        $model2_string="VSS";
                        $label_x="";
                        $line_count=0;
                        $max_x=20;
                        while (!feof($fp))
                        {
                                $string=fgets($fp,4096);
                                $str = str_replace(PHP_EOL, '', $string);
                                $m_array = split(" ",$str);
                                if (count($m_array) > 1)
                                {
                                        $model1_string=$model1_string.",".$m_array[0];
                                        $model2_string=$model2_string.",".$m_array[1];
                                }
                                $line_count++;
                        }
                        $data = $model1_string.";".$model2_string;
                        $result_data = $this->transferGetData($data);
#if ($line_count <= $max_x)
#                         $max_x = $line_count;
#                       $interval = $line_count / $max_x;
#                       for ($i=0;$i<$max_x;$i++)
#                       {
#                               $num=$interval * $i;
#                                $label_x = $label_x.strval($num).",";
#                        }
						for ($i=0;$i<$line_count; $i++)
						{
							$label_x = $label_x.strval($i).",";
						}
                        $label_y = "Mb";
                        $options=$this->transferOptions($label_x,$label_y,"");
                        $chart_id=ChartFactory::CONST_CHART_TYPE_LINE_BAR_BASIC."_".md5(rand());
                        $height=500;
                        $this->render('apichart',array(
                                "data"=>$result_data,
                                "options"=>$options,
                                "height"=>$height,
                                'chart_type'=>ChartFactory::CONST_CHART_TYPE_LINE_BAR_BASIC,
                                'chart_id'=>$chart_id,
                        ));
    }						

	public function actionMemorystaticAPI(){
	    $this->layout='//layouts/blank';
        $data= array();
        $memory_path=trim($_GET['memory_path']);
        $cmd = "cat $memory_path/timefile";exec($cmd,$memorytime);
		$cmd = "cat $memory_path/physicalmemoryfile";exec($cmd,$physicalmemory);
        $cmd = "cat $memory_path/maxmemoryfile";exec($cmd,$maxmemory);
        $cmd = "cat $memory_path/minmemoryfile";exec($cmd,$minmemory);

		$data=$physicalmemory[0];
        $label_x=$memorytime[0];
        $height="260";
		$label_y_unit="g";
        $result_data=$this->transferGetData($data);
        $options=$this->transferOptions($label_x,$label_y_unit,$label_y_precision);
        $chart_id=ChartFactory::CONST_CHART_TYPE_LINE_BAR_BASIC."_".md5(rand());
        $this->render('apichart',array(
            "data"=>$result_data,
            "options"=>$options,
            "height"=>$height,
            'chart_type'=>ChartFactory::CONST_CHART_TYPE_LINE_BAR_BASIC,
            'chart_id'=>$chart_id,
			'maxmemory'=>$maxmemory[0],
			'minmemory'=>$minmemory[0],
            ));
	}

	public function actionMemoryDc(){
	    $this->layout='//layouts/blank';
        $data= array();
        $memory_path=trim($_GET['memory_path']);
        $cmd = "~/ci/lib/baselib/bin/go spider@cq7210 'cat $memory_path/timefile'";exec($cmd,$memorytime);
		$cmd = "~/ci/lib/baselib/bin/go spider@cq7210 'cat $memory_path/physicalmemoryfile'";exec($cmd,$physicalmemory);
        $cmd = "~/ci/lib/baselib/bin/go spider@cq7210 'cat $memory_path/maxmemoryfile'";exec($cmd,$maxmemory);
        $cmd = "~/ci/lib/baselib/bin/go spider@cq7210 'cat $memory_path/minmemoryfile'";exec($cmd,$minmemory);

		$data=$physicalmemory[0];
        $label_x=$memorytime[0];
        $height="260";
		$label_y_unit="g";
        $result_data=$this->transferGetData($data);
        $options=$this->transferOptions($label_x,$label_y_unit,$label_y_precision);
        $chart_id=ChartFactory::CONST_CHART_TYPE_LINE_BAR_BASIC."_".md5(rand());
        $this->render('apichart',array(
            "data"=>$result_data,
            "options"=>$options,
            "height"=>$height,
            'chart_type'=>ChartFactory::CONST_CHART_TYPE_LINE_BAR_BASIC,
            'chart_id'=>$chart_id,
			'maxmemory'=>$maxmemory[0],
			'minmemory'=>$minmemory[0],
            ));
	}
	private function getMillisecond() {
		    list($s1, $s2) = explode(' ', microtime());
			return (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
	}

    private function transferGetData($data){
        $data_array=explode(";",$data);
        $result=array();
        foreach ($data_array as $value) {
            $temp_array=explode(",", $value);
            $temp_key=$temp_array[0];
            $temp_sub_array=array_slice($temp_array,1);
            $temp_value=implode(",", $temp_sub_array);
            $result[$temp_key]=$temp_value;
        }
        return $result;
    }

    private function transferOptions($label_x,$label_y_unit,$label_y_precision){
        $result[ChartTPL::$CHART_OPTION_LABEL_X]=$label_x;
        $result[ChartTPL::$CHART_OPTION_LABEL_Y_UNIT]=$label_y_unit;
        $result[ChartTPL::$CHART_OPTION_LABEL_Y_PRECISION]=$label_y_precision;
		return $result;
    }
	public function actionLocalexec()
	{
		$this->renderPartial('localApi', $r);
	}
	public function actionDictapi()
	{
		$this->renderPartial('localDictApi', $r);
	}
	public function actionDict1api()
	{
		$this->renderPartial('localDict1Api', $r);
	}
	public function actionPerfapi()
	{
		$this->renderPartial('localPerfApi', $r);
	}
	public function actionDiffapi()
	{
		$this->renderPartial('localDiffApi', $r);
	}

}
