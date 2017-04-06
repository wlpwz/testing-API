<?php
class EcmonitorController extends Controller
{
	public static $HOST_NAME = "yuanbaolei@cq01-testing-zfqa33.cq01.baidu.com";
    public static $EC_RUN_HOST_NAME_DEFAULT = "spider@cq01-testing-ps7161.cq01";
    public static $EC_RUN_PATH_DEFAULT = "/home/spider/LibPP/DATA/NEW_EC/";
	public static $CI_BIN="~/ci/lib/baselib/bin/";
	public static $LOCAL_RESULT_PATH="/home/work/LibPP/RUN_RESULT/";
	public static $LOCAL_MONITOR_PATH="/home/work/LibPP/EC_MONITOR/";
	//config path
	public static $EC_RUN_BIN = "/home/spider/ci/lib/ps/spider/libpp/ECSysTest/";

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
	private function transferOptions($label_x,$label_y_unit,$label_y_precision){
                        $result[ChartTPL::$CHART_OPTION_LABEL_X]=$label_x;
                        $result[ChartTPL::$CHART_OPTION_LABEL_Y_UNIT]=$label_y_unit;
                        $result[ChartTPL::$CHART_OPTION_LABEL_Y_PRECISION]=$label_y_precision;
                        return $result;
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
    public function actionMemoryAPI()
    {
                        $this->layout='//layouts/blank';
                        $file = $_GET["file_path"];
						echo $file;
						return true;
                        $fp = fopen($file, "r");
						if ($fp == null)
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
                        if ($line_count <= $max_x)
                          $max_x = $line_count;
                        $interval = $line_count / $max_x;
                        for ($i=0;$i<$max_x;$i++)
                        {
                                $num=$interval * $i;
                                $label_x = $label_x.strval($num).",";
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
	public function actionEcmonitorresult()
	{
		$task_id=$_GET['id'];
		$r['task_id']=$task_id;
		$r['ec1_result']="http://pat.baidu.com/?r=tools/memoryAPI&file_path=/home/work/LibPP/EC_MONITOR/".strval($task_id)."/ec1.txt";
		$r['ec2_result']="http://pat.baidu.com/?r=tools/memoryAPI&file_path=/home/work/LibPP/EC_MONITOR/".strval($task_id)."/ec2.txt";
		$this->renderPartial('ecmonitorresult', $r);		
	}
	public function actionSubmit()
	{
		$ec1_hostname = $_POST['ec1_hostname'];
		$ec1_password = $_POST['ec1_password'];
		$ec1_pid = $_POST['ec1_pid'];
		$ec2_hostname = $_POST['ec2_hostname'];
		$ec2_password = $_POST['ec2_password'];
		$ec2_pid = $_POST['ec2_pid'];
		$description = $_POST['description'];
		$task = new EcMonitor();	
		$task->description = $description;
		$task->time = date('Y-m-d H:i:s',time());
		$task->user = Yii::app()->user->name;
		$ret = $task->save();
		if ($ret == false)
			return true;
		if ($ec1_hostname != "" && $ec1_password != "" && $ec1_pid != "")
		{
			$cmd="nohup sh /home/work/ec_test_service/src/commands/mem_check.sh \"$ec1_hostname\" \"$ec1_password\" \"$ec1_pid\" ".strval($task->task_id)." ec1";
			exec($cmd);
		}
		if ($ec2_hostname != "" && $ec2_password != "" && $ec2_pid != "")
		{
			$cmd="nohup sh /home/work/ec_test_service/src/commands/mem_check.sh \"$ec2_hostname\" \"$ec2_password\" \"$ec2_pid\" ".strval($task->task_id)." ec2";
		}
	}


}
?>
