<?php
class RunController extends Controller
{
	public static $HOST_NAME = "yuanbaolei@cq01-testing-zfqa33.cq01.baidu.com";
    public static $EC_RUN_HOST_NAME_DEFAULT = "spider@cq01-testing-ps7161.cq01";
    public static $EC_RUN_PATH_DEFAULT = "/home/spider/LibPP/DATA/NEW_EC/";
	public static $CI_BIN="~/ci/lib/baselib/bin/";
	public static $LOCAL_RESULT_PATH="/home/work/LibPP/RUN_RESULT/";
	//config path
	public static $EC_RUN_BIN = "/home/spider/ci/lib/ps/spider/libpp/ECSysTest/";

	public $layout = "run";
    public function actions()
    {      
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName            'page'=>array(
           'page'=>array(
                'class'=>'CViewAction',
            ),
        );
    }

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
	public function actionIndex($topic='', $state = '', $keyword = '', $page = 1, $pagesize = 30){
        $compile_id= $_GET['compileid'];
		if($compile_id==""){
			$compile_id="null";
		}
        $r['compile_id'] = $compile_id;
		$array = EcVersionControl::model()->findAll("",array());
        $version_list = "";
        if (count($array) > 1)
            $version_list = $array[0]->version;
        for ($i=1;$i < count($array); $i++)
            $version_list = $version_list . "&&" .$array[$i]->version;
        $r['version_list'] = $version_list;
		$array2 = EcInputPack::model()->findAll("",array());
        $input_pack_list = "";
        if (count($array2) > 1)
            $input_pack_list = $array2[0]->pack_name;
        for ($i=1;$i < count($array2); $i++)
            $input_pack_list = $input_pack_list . "&&" .$array2[$i]->pack_name;
        $r['input_pack_list'] = $input_pack_list;
		//$this->renderPartial('index', $r);
	    $this->render('index',$r);
    }


    public function actionLocalrun(){
        $data = array();
        $machine_select=trim($_POST['machine_select']);
        $remote_dis_machine="cp6076";
        $remote_dis_machine_script="/home/work/local_ecplatform/remote_dis_machine_script/enviroment";
       /* if($machine_select=="define_machine")
        {
            $define_machine_machine=trim($_POST['define_machine_machine']);
            $define_machine_password=trim($_POST['define_machine_password']);
            $define_machine_deploypath=trim($_POST['define_machine_deploypath']);
            
            $code_select=trim($_POST['code_select']);
            if($code_select=="product_code")
            {
                $product_new_version=trim($_POST['product_new_version']);
                $product_old_version=trim($_POST['product_old_version']);
                
                $data_select=trim($_POST['data_select']);
                if($data_select=="platform_data")
                {
                    $platform_data_type=trim($_POST['platform_data_type']);
                    $platform_data_num=trim($_POST['platform_data_num']);
                    # insert_myql_record(id time user parameter result)
                    #get_record_id
                    
                    #$cmd="cd /home/work/ec_test_service/script/enviroment 'sh -x run.sh -m $define_machine_machine -p $define_machine_deploypath -n $product_new_version -o $product_old_version -t $platform_data_type -d $platform_data_num  -i <task_id>'";
                    #exec($cmd);  
                       
                }   
                else if($data_select=="define_data")
                {
                    $define_data_ftp_path=trim($_POST['define_data_ftp_path']);
 
                    # insert_myql_record(id time user parameter result)
                    #get_record_id
                    
                    #$cmd="cd /home/work/ec_test_service/script/enviroment 'sh -x run.sh -m $define_machine_machine -p $define_machine_deploypath -n $product_new_version -o $product_old_version -d $define_data_ftp_path  -i <task_id>'";
                    #exec($cmd);  
                       
                }
                
            }
            else if($code_select=="define_code")
            {
                $define_code_new_code_path=trim($_POST['define_code_new_code_path']);
                $define_code_old_code_path=trim($_POST['define_code_old_code_path']);
                
                $data_select=trim($_POST['data_select']);
                if($data_select=="platform_data")
                {
                    $platform_data_type=trim($_POST['platform_data_type']);
                    $platform_data_num=trim($_POST['platform_data_num']);

                    $user="default";
                    $time=date('Y-m-d_H:i:s', time());

                    $pd = new LocalRun();
                    $pd->USER = $user;
                    $pd->TIME = $time;
                    $pd->STATUS = "Doing";
                    $pd->save();
                     
                    $task_id = $pd->TASK_ID; 
                    
                    $cmd="cd /home/work/ec_test_service/script/enviroment;nohup sh -x run_machine_define_code_define_data_default.sh  -m $define_machine_machine -w $define_machine_password -p $define_machine_deploypath -n $define_code_new_code_path -o $define_code_old_code_path -t $platform_data_type -d $platform_data_num  -i $task_id &>./log/$task_id.m_defi_c_defi_d_defa.log &";
                    $pd = LocalRun::model()->updateAll(array('CMD'=>$cmd),'TIME=:time',array(':time'=>$time));
                    
                    exec($cmd);  
                       
                    $this->json(array('result' => 1,'task_id' => $task_id));
                       
                }   
                else if($data_select=="define_data")
                {
                    $define_data_ftp_path=trim($_POST['define_data_ftp_path']);
 
                    $user="default";
                    $time=date('Y:m:d-H:i:s', time());

                    $pd = new LocalRun();
                    $pd->USER = $user;
                    $pd->TIME = $time;
                    $pd->STATUS = "Doing";
                    $pd->save();
                    $task_id = $pd->TASK_ID; 
                          
                    $cmd="cd /home/work/ec_test_service/script/enviroment;nohup sh -x run_machine_define_code_define_data_define.sh -m $define_machine_machine -w $define_machine_password  -p $define_machine_deploypath -n $define_code_new_code_path -o $define_code_old_code_path -d $define_data_ftp_path  -i $task_id &>./log/$task_id.m_defi_c_defi_d_defi.log &";
                    
                    $pd = LocalRun::model()->updateAll(array('CMD'=>$cmd),'TIME=:time',array(':time'=>$time));
                    
                    exec($cmd);  
                         
                    $this->json(array('result' => 1,'task_id' => $task_id));
                       
                }
                
            }
        
        }  */
        if($machine_select=="default_machine")
        {
			$ec_type = trim($_POST['type_select']);
			$thread_num = trim($_POST['thread_num']);	
            $newolddiff_select=trim($_POST['newolddiff_select']);
			$newdiff_select=trim($_POST['newdiff_select']);
			$olddiff_select=trim($_POST['olddiff_select']);
			$memory_select=trim($_POST['memory_select']);
			$speed_select=trim($_POST['speed_select']);
			$Valgrind_select=trim($_POST['Valgrind_select']);
            $new_code_select=trim($_POST['new_code_select']);
			$old_code_select=trim($_POST['old_code_select']);

			$new1_strategy_select=trim($_POST['new1_strategy_select']);
			$new1_strategy=trim($_POST['new1_strategy']);
			$new1_strategy = substr($new1_strategy,0,strlen($new1_strategy)-1);
			$stategies_zw_newec1=$new1_strategy_select.":".$new1_strategy;
			//var_dump("newec1:".$stategies_zw_newec1);
		
			$new2_strategy_select=trim($_POST['new2_strategy_select']);
            $new2_strategy=trim($_POST['new2_strategy']);
			$new2_strategy = substr($new2_strategy,0,strlen($new2_strategy)-1);
            $stategies_zw_newec2=$new2_strategy_select.":".$new2_strategy;	
			//var_dump("newec2:".$stategies_zw_newec2);
	
			$old1_strategy_select=trim($_POST['old1_strategy_select']);
            $old1_strategy=trim($_POST['old1_strategy']);
			$old1_strategy = substr($old1_strategy,0,strlen($old1_strategy)-1);
            $stategies_zw_oldec1=$old1_strategy_select.":".$old1_strategy;
		//	var_dump("oldec1:".$stategies_zw_oldec1);

			$old2_strategy_select=trim($_POST['old2_strategy_select']);
            $old2_strategy=trim($_POST['old2_strategy']);
			$old2_strategy = substr($old2_strategy,0,strlen($old2_strategy)-1);
            $stategies_zw_oldec2=$old2_strategy_select.":".$old2_strategy;
		//	var_dump("oldec2:".$stategies_zw_oldec2);		

			$new_strategy_select=trim($_POST['new_strategy_select']);
            $new_strategy=trim($_POST['new_strategy']);
			$new_strategy = substr($new_strategy,0,strlen($new_strategy)-1); 
			$stategies_gjh_newec=$new_strategy_select.":".$new_strategy;
			//var_dump("newec:".$stategies_gjh_newec);			

			$old_strategy_select=trim($_POST['old_strategy_select']);
            $old_strategy=trim($_POST['old_strategy']);
			$old_strategy = substr($old_strategy,0,strlen($old_strategy)-1);
            $stategies_gjh_oldec=$old_strategy_select.":".$old_strategy;
			//var_dump("oldec:".$stategies_gjh_oldec); exit;
			$user_name=Yii::app()->user->name;
			$time=date('Y-m-d_H:i:s', time());
			$des=$_POST['des'];
			
            if($new_code_select=="product_new_code"&&$old_code_select=="product_old_code")
            {
				
                $product_new_version=trim($_POST['product_new_version']);
				$product_old_version=trim($_POST['product_old_version']);
				
				$data_select=trim($_POST['data_select']);	
                if($data_select=="platform_data")
                {
					
                    $platform_data_type=trim($_POST['platform_data_type']);
                    $platform_data_num=trim($_POST['platform_data_num']);
					$pd = new LocalRun();
					$pd->USER = $user_name;
					$pd->TIME = $time;
					$pd->STATUS = "Doing";
					$pd->newolddiff = $newolddiff_select;
					$pd->newdiff = $newdiff_select;
					$pd->olddiff = $olddiff_select;
					$pd->memory = $memory_select;
					$pd->speed = $speed_select;
					$pd->Valgrind = $Valgrind_select;
					$pd->des=$des;
					$pd->EC_type = $ec_type;
					$pd->thread_num = $thread_num;
					$pd->stategies_zw_newec1 = $stategies_zw_newec1;
					$pd->stategies_zw_newec2 = $stategies_zw_newec2;
					$pd->stategies_zw_oldec1 = $stategies_zw_oldec1;
					$pd->stategies_zw_oldec2 = $stategies_zw_oldec2;
					$pd->stategies_gjh_newec = $stategies_gjh_newec;
					$pd->stategies_gjh_oldec = $stategies_gjh_oldec;
					$pd->save();
					$task_id = $pd->TASK_ID;
						
					$cmd="go $remote_dis_machine 'cd $remote_dis_machine_script;nohup sh  run_machine_default_code_product_data_default.sh  -n $product_new_version -o $product_old_version -t $platform_data_type -d $platform_data_num  -i $task_id -p $ec_type -A $newolddiff_select -B $newdiff_select -C $olddiff_select -D $memory_select -E $speed_select -F $Valgrind_select &>./log/platform_common/$task_id.log &'";
					
					$pd = LocalRun::model()->updateAll(array('CMD'=>$cmd),'TIME=:time',array(':time'=>$time));
					exec($cmd);
					$this->json(array('result' => 1,'task_id' => $task_id));
                }   
                else if($data_select=="define_data")
                {
                    $define_data_ftp_path=trim($_POST['define_data_ftp_path']);
 
					$pd = new LocalRun();
					$pd->USER = $user_name;
					$pd->TIME = $time;
					$pd->STATUS = "Doing";
					$pd->des=$des;
					$pd->newolddiff = $newolddiff_select;
					$pd->newdiff = $newdiff_select;
					$pd->olddiff = $olddiff_select;
					$pd->memory = $memory_select;
					$pd->speed = $speed_select;
					$pd->Valgrind = $Valgrind_select;
					$pd->EC_type = $ec_type;
					$pd->thread_num = $thread_num;
					$pd->stategies_zw_newec1 = $stategies_zw_newec1;
                    $pd->stategies_zw_newec2 = $stategies_zw_newec2;
                    $pd->stategies_zw_oldec1 = $stategies_zw_oldec1;
                    $pd->stategies_zw_oldec2 = $stategies_zw_oldec2;
                    $pd->stategies_gjh_newec = $stategies_gjh_newec;
                    $pd->stategies_gjh_oldec = $stategies_gjh_oldec;
					$pd->save();
					$task_id = $pd->TASK_ID;
						
					$cmd="go $remote_dis_machine 'cd $remote_dis_machine_script;nohup sh  run_machine_default_code_product_data_define.sh  -n $product_new_version -o $product_old_version  -d $define_data_ftp_path  -i $task_id  -p $ec_type -A $newolddiff_select -B $newdiff_select -C $olddiff_select -D $memory_select -E $speed_select -F $Valgrind_select &>./log/platform_common/$task_id.log &'";
					$pd = LocalRun::model()->updateAll(array('CMD'=>$cmd),'TIME=:time',array(':time'=>$time));
					exec($cmd);
					$this->json(array('result' => 1,'task_id' => $task_id));
                }
                
            }
			else if($new_code_select=="product_new_code"&&$old_code_select=="define_old_code")
			{
                $product_new_version=trim($_POST['product_new_version']);
                $define_code_old_code_path=trim($_POST['define_code_old_code_path']);
                
                $data_select=trim($_POST['data_select']);
                if($data_select=="platform_data")
                {
                    $platform_data_type=trim($_POST['platform_data_type']);
                    $platform_data_num=trim($_POST['platform_data_num']);
					
					$pd = new LocalRun();
					$pd->USER = $user_name;
					$pd->TIME = $time;
					$pd->STATUS = "Doing";
					$pd->des=$des;
					$pd->newolddiff = $newolddiff_select;
					$pd->newdiff = $newdiff_select;
					$pd->olddiff = $olddiff_select;
					$pd->memory = $memory_select;
					$pd->speed = $speed_select;
					$pd->Valgrind = $Valgrind_select;
					$pd->EC_type = $ec_type;
					$pd->thread_num = $thread_num;
					$pd->stategies_zw_newec1 = $stategies_zw_newec1;
                    $pd->stategies_zw_newec2 = $stategies_zw_newec2;
                    $pd->stategies_zw_oldec1 = $stategies_zw_oldec1;
                    $pd->stategies_zw_oldec2 = $stategies_zw_oldec2;
                    $pd->stategies_gjh_newec = $stategies_gjh_newec;
                    $pd->stategies_gjh_oldec = $stategies_gjh_oldec;
					$pd->save();
					$task_id = $pd->TASK_ID;
						
					$cmd="go $remote_dis_machine 'cd $remote_dis_machine_script;nohup sh  run_machine_default_code_newproduct_olddefine_data_default.sh  -n $product_new_version -o $define_code_old_code_path -t $platform_data_type -d $platform_data_num  -i $task_id  -p $ec_type  -A $newolddiff_select -B $newdiff_select -C $olddiff_select -D $memory_select -E $speed_select -F $Valgrind_select &>./log/platform_common/$task_id.log &'";
					$pd = LocalRun::model()->updateAll(array('CMD'=>$cmd),'TIME=:time',array(':time'=>$time));
					exec($cmd);
					$this->json(array('result' => 1,'task_id' => $task_id));
                       
                }   
                else if($data_select=="define_data")
                {
                    $define_data_ftp_path=trim($_POST['define_data_ftp_path']);
					 					
					$pd = new LocalRun();
					$pd->USER = $user_name;
					$pd->TIME = $time;
					$pd->STATUS = "Doing";
					$pd->des=$des;
					$pd->newolddiff = $newolddiff_select;
					$pd->newdiff = $newdiff_select;
					$pd->olddiff = $olddiff_select;
					$pd->memory = $memory_select;
					$pd->speed = $speed_select;
					$pd->Valgrind = $Valgrind_select;
					$pd->EC_type = $ec_type;
					$pd->thread_num = $thread_num;
					$pd->stategies_zw_newec1 = $stategies_zw_newec1;
                    $pd->stategies_zw_newec2 = $stategies_zw_newec2;
                    $pd->stategies_zw_oldec1 = $stategies_zw_oldec1;
                    $pd->stategies_zw_oldec2 = $stategies_zw_oldec2;
                    $pd->stategies_gjh_newec = $stategies_gjh_newec;
                    $pd->stategies_gjh_oldec = $stategies_gjh_oldec;
					$pd->save();
					$task_id = $pd->TASK_ID;

					
					$cmd="go $remote_dis_machine 'cd $remote_dis_machine_script;nohup sh run_machine_default_code_newproduct_olddefine_data_define.sh  -n $product_new_version -o $define_code_old_code_path  -d $define_data_ftp_path  -i $task_id -p $ec_type  -A $newolddiff_select -B $newdiff_select -C $olddiff_select -D $memory_select -E $speed_select -F $Valgrind_select &>./log/platform_common/$task_id.log &'";
					$pd = LocalRun::model()->updateAll(array('CMD'=>$cmd),'TIME=:time',array(':time'=>$time));
					exec($cmd);
					$this->json(array('result' => 1,'task_id' => $task_id));
                }
               
            
				
			}
			else if($new_code_select=="define_new_code"&&$old_code_select=="product_old_code")
			{
                $define_code_new_code_path=trim($_POST['define_code_new_code_path']);
                $product_old_version=trim($_POST['product_old_version']);
                
                $data_select=trim($_POST['data_select']);
                if($data_select=="platform_data")
                {
                    $platform_data_type=trim($_POST['platform_data_type']);
                    $platform_data_num=trim($_POST['platform_data_num']);
                  
					$pd = new LocalRun();
					$pd->USER = $user_name;
					$pd->TIME = $time;
					$pd->STATUS = "Doing";
					$pd->Valgrind = $Valgrind_select;
					$pd->newolddiff = $newolddiff_select;
					$pd->newdiff = $newdiff_select;
					$pd->olddiff = $olddiff_select;
					$pd->memory = $memory_select;
					$pd->speed = $speed_select;
					$pd->des=$des;
					$pd->EC_type = $ec_type;
					$pd->thread_num = $thread_num;
					$pd->stategies_zw_newec1 = $stategies_zw_newec1;
                    $pd->stategies_zw_newec2 = $stategies_zw_newec2;
                    $pd->stategies_zw_oldec1 = $stategies_zw_oldec1;
                    $pd->stategies_zw_oldec2 = $stategies_zw_oldec2;
                    $pd->stategies_gjh_newec = $stategies_gjh_newec;
                    $pd->stategies_gjh_oldec = $stategies_gjh_oldec;
					$pd->save();
					$task_id = $pd->TASK_ID;
					
					$cmd="go $remote_dis_machine 'cd $remote_dis_machine_script;nohup sh  run_machine_default_code_newdefine_oldproduct_data_default.sh  -n $define_code_new_code_path -o $product_old_version -t $platform_data_type -d $platform_data_num  -i $task_id  -p $ec_type  -A $newolddiff_select -B $newdiff_select -C $olddiff_select -D $memory_select -E $speed_select -F $Valgrind_select &>./log/platform_common/$task_id.log &'";
					$pd = LocalRun::model()->updateAll(array('CMD'=>$cmd),'TIME=:time',array(':time'=>$time));
					exec($cmd);
					$this->json(array('result' => 1,'task_id' => $task_id));
                       
                }   
                else if($data_select=="define_data")
                {
                    $define_data_ftp_path=trim($_POST['define_data_ftp_path']);
 
					$pd = new LocalRun();
					$pd->USER = $user_name;
					$pd->TIME = $time;
					$pd->STATUS = "Doing";
					$pd->des = $des;
					$pd->newolddiff = $newolddiff_select;
					$pd->newdiff = $newdiff_select;
					$pd->olddiff = $olddiff_select;
					$pd->memory = $memory_select;
					$pd->speed = $speed_select;
					$pd->Valgrind = $Valgrind_select;
					$pd->EC_type = $ec_type;
					$pd->thread_num = $thread_num;
					$pd->stategies_zw_newec1 = $stategies_zw_newec1;
                    $pd->stategies_zw_newec2 = $stategies_zw_newec2;
                    $pd->stategies_zw_oldec1 = $stategies_zw_oldec1;
                    $pd->stategies_zw_oldec2 = $stategies_zw_oldec2;
                    $pd->stategies_gjh_newec = $stategies_gjh_newec;
                    $pd->stategies_gjh_oldec = $stategies_gjh_oldec;
					$pd->save();
					$task_id = $pd->TASK_ID;
					
					$cmd="go $remote_dis_machine 'cd $remote_dis_machine_script;nohup sh  run_machine_default_code_newdefine_oldproduct_data_define.sh  -n $define_code_new_code_path -o $product_old_version  -d $define_data_ftp_path  -i $task_id -p $ec_type  -A $newolddiff_select -B $newdiff_select -C $olddiff_select -D $memory_select -E $speed_select -F $Valgrind_select &>./log/platform_common/$task_id.log &'";
					$pd = LocalRun::model()->updateAll(array('CMD'=>$cmd),'TIME=:time',array(':time'=>$time));
					exec($cmd);
					$this->json(array('result' => 1,'task_id' => $task_id));
                }
                
				
			}
            else if($new_code_select=="define_new_code"&&$old_code_select=="define_old_code")
            {
                $define_code_new_code_path=trim($_POST['define_code_new_code_path']);
                $define_code_old_code_path=trim($_POST['define_code_old_code_path']);
                
                $data_select=trim($_POST['data_select']);
                if($data_select=="platform_data")
                {
                    $platform_data_type=trim($_POST['platform_data_type']);
                    $platform_data_num=trim($_POST['platform_data_num']);
                    
					$pd = new LocalRun();
					$pd->USER = $user_name;
					$pd->TIME = $time;
					$pd->STATUS = "Doing";
					$pd->des=$des;
					$pd->newolddiff = $newolddiff_select;
					$pd->newdiff = $newdiff_select;
					$pd->olddiff = $olddiff_select;
					$pd->memory = $memory_select;
					$pd->Valgrind = $Valgrind_select;
					$pd->speed = $speed_select;
					$pd->EC_type = $ec_type;
					$pd->thread_num = $thread_num;
					$pd->stategies_zw_newec1 = $stategies_zw_newec1;
                    $pd->stategies_zw_newec2 = $stategies_zw_newec2;
                    $pd->stategies_zw_oldec1 = $stategies_zw_oldec1;
                    $pd->stategies_zw_oldec2 = $stategies_zw_oldec2;
                    $pd->stategies_gjh_newec = $stategies_gjh_newec;
                    $pd->stategies_gjh_oldec = $stategies_gjh_oldec;
					$pd->save();
					$task_id = $pd->TASK_ID;
					
					$cmd="go $remote_dis_machine 'cd $remote_dis_machine_script;nohup sh  run_machine_default_code_define_data_default.sh  -n $define_code_new_code_path -o $define_code_old_code_path -t $platform_data_type -d $platform_data_num  -i $task_id -p $ec_type  -A $newolddiff_select -B $newdiff_select -C $olddiff_select -D $memory_select -E $speed_select -F $Valgrind_select  &>./log/platform_common/$task_id.log &'";
					$pd = LocalRun::model()->updateAll(array('CMD'=>$cmd),'TIME=:time',array(':time'=>$time));
					exec($cmd);
					$this->json(array('result' => 1,'task_id' => $task_id));
                }   
                else if($data_select=="define_data")
                {
                    $define_data_ftp_path=trim($_POST['define_data_ftp_path']);
                    
					$pd = new LocalRun();
					$pd->USER = $user_name;
					$pd->TIME = $time;
					$pd->STATUS = "Doing";
					$pd->des=$des;
					$pd->newolddiff = $newolddiff_select;
					$pd->newdiff = $newdiff_select;
					$pd->olddiff = $olddiff_select;
					$pd->memory = $memory_select;
					$pd->speed = $speed_select;
					$pd->Valgrind = $Valgrind_select;
					$pd->EC_type = $ec_type;
					$pd->thread_num = $thread_num;
					$pd->stategies_zw_newec1 = $stategies_zw_newec1;
                    $pd->stategies_zw_newec2 = $stategies_zw_newec2;
                    $pd->stategies_zw_oldec1 = $stategies_zw_oldec1;
                    $pd->stategies_zw_oldec2 = $stategies_zw_oldec2;
                    $pd->stategies_gjh_newec = $stategies_gjh_newec;
                    $pd->stategies_gjh_oldec = $stategies_gjh_oldec;
					$pd->save();
					$task_id = $pd->TASK_ID;
					
					$cmd="go $remote_dis_machine 'cd $remote_dis_machine_script;nohup sh  run_machine_default_code_define_data_define.sh  -n $define_code_new_code_path -o $define_code_old_code_path  -d $define_data_ftp_path  -i $task_id -p $ec_type  -A $newolddiff_select -B $newdiff_select -C $olddiff_select -D $memory_select -E $speed_select -F $Valgrind_select  &>./log/platform_common/$task_id.log &'";
					$pd = LocalRun::model()->updateAll(array('CMD'=>$cmd),'TIME=:time',array(':time'=>$time));
					exec($cmd);
					$this->json(array('result' => 1,'task_id' => $task_id));
                }
                
            }
        
    
        }
        $data["task_id"]=$task_id;
        $this->renderPartial('localrun', $data);
    }

	public function actionShowLog() {
		$task_id = $_GET['task_id'];
		$command = "curl \"http://cq01-testing-ps7161.cq01.baidu.com:8911/?r=run/showLog&task_id=".strval($task_id)."\"";
		$log = shell_exec($command);
		$data["task_id"] = $task_id;
		$data["log"] = $log;
		$this->renderPartial('showLog', $data);
			
	
	}
	public function actionShowERR() {
        $task_id = $_GET['task_id'];
        $command = "curl \"http://cq01-testing-ps7161.cq01.baidu.com:8911/?r=run/showERR&task_id=".strval($task_id)."\"";
        $err = shell_exec($command);
        $data["err"] = $err; 
		$data["task_id"] = $task_id; 
        $this->renderPartial('showERR', $data); 
         
    
    }

    public function actionJekensrunAPI(){
        $remote_dis_machine="cp6076";
        $remote_dis_machine_script="/home/work/local_ecplatform/remote_dis_machine_script/enviroment";
        $data = array();
        $new_code=trim($_POST['new_code']);
        $old_code=trim($_POST['old_code']);
		$ec_type=trim($_POST['ec_type']);
        $new_old_diff=trim($_POST['new_old_diff']);
        $new_diff=trim($_POST['new_diff']);
        $old_diff=trim($_POST['old_diff']);
		$old_diff="0";
        $memory=trim($_POST['memory']);
        $speed=trim($_POST['speed']);
        #$valgrind=trim($_POST['valgrind']);
        $valgrind=0;
        $covfile=trim($_POST['covfile']);
        $thread_num=trim($_POST['thread_num']);
        
        $time=date('Y-m-d_H:i:s', time());

        $pd = new JekensRun();
        $pd->TIME = $time;
        $pd->STATUS = "Doing";
		$pd->newolddiff=$new_old_diff;
		$pd->newdiff=$new_diff;
		$pd->olddiff=$old_diff;
		$pd->memory = $memory;
		$pd->speed = $speed;
		$pd->Valgrind = $valgrind;
		$pd->EC_type = $ec_type;
		$pd->thread_num = $thread_num;
        $pd->save();
         
        $task_id = $pd->TASK_ID; 
        
        $cmd="go $remote_dis_machine 'cd $remote_dis_machine_script;nohup sh  run_jekens.sh  -n $new_code -o $old_code -t $task_id -p $ec_type -A $new_old_diff -B $new_diff -C $old_diff  -D $memory -E $speed -F $valgrind -c $covfile&>./log/jekens/$task_id.log &'";
        $pd = JekensRun::model()->updateAll(array('CMD'=>$cmd),'TIME=:time',array(':time'=>$time));
        exec($cmd);
		echo $task_id;
        #$this->json($task_id);
            
    }

    public function actionJekensrunstatusAPI(){
        $data = array();
        $task_id=trim($_POST['task_id']);
        $pd = new JekensRun();
        
        $pd = JekensRun::model()->findAll('TASK_ID=:task_id',array(':task_id'=>$task_id));
        foreach($pd as $ival){
			$status = $ival->STATUS;
		}
		echo $status;
        #$this->json($task_id);
            
    }

	public function actionGetJekensResultAPI()
	{
		$task_id = $_GET['task_id'];
		$task = JekensRun::model()->findByPk($task_id);
		if (is_null($task))
		{
		  return true;
		}
		echo $task->RUN_RESULT;
	}
	public function actionChangeTaskItemAPI()
	{
		$key = $_POST["key"];
        $value = $_POST["value"];
        $task_id = $_POST["task_id"];
        $task = EcRunTaskList::model()->findByPk($task_id);
        if (is_null($task))
            return true;
        if ($key == "status")
        {
            $task->status = $value;
        }
		else if ($key == "diff_id")
		{
			$task->diff_id = $value;
		}
        $rc = $task->save();
        return true;
	}
	public function actionRunresult(){
            $task_id = $_GET['task_id'];
            //拼接结果文件地址
			/*$fp=fopen($mem1_path, "r");
			$mem1=fread($fp, filesize($mem1_path));
			
			$r['mem1']=json_encode($mem1);*/
			$path = self::$LOCAL_RESULT_PATH.$task_id."/result.txt";
			$handle = fopen("$path","r");
			if ($handle) {
    			while (!feof($handle)) {
        			$buffer = fgets($handle);
					$str =  explode(":",$buffer);
					if(count($str)<=2)
					{
						$re=$str[1];
						$r["$str[0]"]=$re;
			
					}
					else
					{
						for($i=2;$i<count($str);$i++)
						{
							$re=$str[1].":";
							$re.=$str[$i];
							$r["$str[0]"]=$re;
						}
					}
    			}
    		fclose($handle);
			}
			//画内存图
			if( $r['run_type']=="newolddiff\n" )
			{
				$mem1_path = $task_id."/new_old.ec1.mem.html";
				$mem1 = "http://cp01-qa-spider004.cp01.baidu.com:8013/".$mem1_path;
				$r['mem1'] = $mem1;
				$mem2_path = $task_id."/new_old.ec2.mem.html";
				$mem2 = "http://cp01-qa-spider004.cp01.baidu.com:8013/".$mem2_path;
				$r['mem2'] = $mem2;
			}
			else if( $r['run_type']=="consistentdiff\n" )
            {       
                $mem1_path = $task_id."/new.ec1.mem.html";
                $mem1 = "http://cp01-qa-spider004.cp01.baidu.com:8013/".$mem1_path;
                $r['mem1'] = $mem1;
                $mem2_path = $task_id."/new.ec2.mem.html";
                $mem2 = "http://cp01-qa-spider004.cp01.baidu.com:8013/".$mem2_path;
                $r['mem2'] = $mem2;
            }
		   else if( $r['run_type']=="both\n" )
            {
                $mem1_path = $task_id."/new_old.ec1.mem.html";
                $mem1 = "http://cp01-qa-spider004.cp01.baidu.com:8013/".$mem1_path;       
                $r['mem1'] = $mem1;
                $mem2_path = $task_id."/new_old.ec2.mem.html";
                $mem2 = "http://cp01-qa-spider004.cp01.baidu.com:8013/".$mem2_path;
                $r['mem2'] = $mem2;
            }   	
			$this->renderPartial('runresult', $r);
        }
    public function actionEdit($topic ="", $id = ""){
        if(!$id){
          $is_new = 1;

          $project = new Project;
          $project->create_time = time();
          $project->act_lift_time = time();
          $project->create_user = Yii::app()->user->name;
        }else{
          $is_new = 0;
          $project = Project::model()->findByPk($id);
          if(empty($project)) throw new CHttpException('404', 'Not Found!');
        }
      
        if(isset($_POST['act'])&&$_POST['act']=='edit'){
           unset($_POST['act']);
           $project->attributes = $_POST;
           $project->update_time = time();
           $project->update_user = Yii::app()->user->name;
           ##调用邮件函数
           $ret = SendMail($topic,$project,$is_new);

          if($project->save() and $ret == true){
              $this->json(array('status' => 1));
          }else{
              $this->json(array('status' => 0));
          }
        }elseif($is_new==0){
          $r['project'] = $project;
        }

        $r['topic'] = $topic?$topic:$project->topic_id;
        $r['id'] = $id;
        $r['project'] = $project;
        $r['priority_list'] = ProjectMsg::getPriorityList();
        $r['level_list'] = ProjectMsg::getLevelList();
        $r['state_list'] = ProjectMsg::getStateList();
        $r['topic_list'] = ProjectMsg::getTopicList();
        $this->renderPartial('edit', $r);
    }


    public function actionUpload(){
        $fp = fopen("/home/work/zhanghao15/record.txt","w");
		$des = $_POST['desc'];	
		$run_type = $_POST['run_type'];
		$command = $command." --run-type \"". $run_type."\" ";
		$new_flag = $_POST['new_flag'];
		if ($new_flag == "scm")
		{
			$new_version = $_POST["new_version"];
			if (is_null($new_version) || $new_version == "")
			{
				echo "new_version is empty";
				return true;
			}
			$command=$command." --new-version \\\"".$new_version."\\\" --new-flag scm ";
		}
		else if ($new_flag = "ftp")
		{
			$new_ec1_bin=$_POST["new_ec1_bin"];
			$new_ec2_bin=$_POST["new_ec2_bin"];	
			$new_ec1_conf=$_POST["new_ec1_conf"];
			$new_ec2_conf=$_POST["new_ec2_conf"];
			$command=$command." --new-ec1-bin-path \\\"".$new_ec1_bin."\\\" --new-ec2-bin-path \\\"".$new_ec2_bin."\\\" --new-ec1-conf-path \\\"".$new_ec1_conf."\\\" --new-ec2-conf-path \\\"".$new_ec2_conf."\\\" --new-flag ftp ";
		}
		else
		{
			echo "new_flag is empty";
			return true;
		}
		if ($run_type == "both" || $run_type == "newolddiff")
		{
			$old_flag=$_POST["old_flag"];
			if ($old_flag == "scm")
			{
				$old_version = $_POST["old_version"];
				if (is_null($old_version) || $old_version == "")
				{
					echo "old_version is empty";
					return true;
				}
				$command=$command." --old-version \\\"".$old_version."\\\" --old-flag scm ";
			}
			else if ($old_flag = "ftp")
			{
				$old_ec1_bin=$_POST["old_ec1_bin"];
				$old_ec2_bin=$_POST["old_ec2_bin"];	
				$old_ec1_conf=$_POST["old_ec1_conf"];
				$old_ec2_conf=$_POST["old_ec2_conf"];
				$command=$command." --old-ec1-bin-path \\\"".$old_ec1_bin."\\\" --old-ec2-bin-path \\\"".$old_ec2_bin."\\\" --old-ec1-conf-path \\\"".$old_ec1_conf."\\\" --old-ec2-conf-path \\\"".$old_ec2_conf."\\\" --old-flag ftp ";
			}
			else
			{
				echo "old_flag is empty";
				return true;
			}
		}
		$langtype=$_POST["langtype"];
		$input_flag=$_POST["input_flag"];
		if ($input_flag == "ftp")
		{
			$pack=$_POST["pack"];
			$pack_num = 0;
		}
		else
		{
			$pack_num=$_POST["pack_num"];
			$pack="ftp://cp01-qa-spider004.cp01.baidu.com/home/work/LibPP/DATA/".$langtype."/pack.".$pack_num;
		}
		$command = $command." --langtype ".$langtype." --input-pack \\\"".$pack."\\\" ";
		$user_name=Yii::app()->user->name;
		$time=date('Y-m-d_H:i:s', time());
		if ($new_flag == "scm")
		{
			$NEW_EC_BIN_VALUE=$new_version;
		}
		else 
		{
			$NEW_EC_BIN_PATH=$new_ec1_bin."&&".$new_ec2_bin;
			$NEW_EC_CONF_PATH=$new_ec1_conf."&&".$new_ec2_conf;
		}
		if ($old_flag == "scm")
		{
			$OLD_EC_BIN_VALUE=$old_version;
		}
		else
		{
			$OLD_EC_BIN_PATH_VALUE=$old_ec1_bin."&&".$old_ec2_bin;
			$OLD_EC_BIN_CONF_VALUE=$old_ec1_conf."&&".$old_ec2_conf;
		}
    	$task = $this->saveRunTask($des,$time, $user_name, "", "", $NEW_EC_BIN_VALUE, $OLD_EC_BIN_VALUE, $lang, $NEW_EC_CONF_VALUE, $OLD_EC_CONF_VALUE, $pack, $pack_num);
		if (is_null($task))
		{
			echo "saveRunTask failed";
			return true;
		}
		$task_id = strval($task->run_task_id);
		$local_work_path=self::$LOCAL_RESULT_PATH.$task_id;
		exec("mkdir ".$local_work_path);
		$command = $command." --task-id $task_id";
		$work_path=self::$EC_RUN_PATH_DEFAULT.$task_id;
		$log_path=$work_path."/log";
		$err_path=$work_path."/err";
		$command = "mkdir ".$work_path.";sh -x ".self::$EC_RUN_BIN."/call_ec_online_start.sh ".$command." 2>".$err_path." 1>".$log_path;
		$cmd = "curl -l \"http://cq01-testing-ps7161.cq01.baidu.com:8911/?r=run/submitRunJob\" -d \"cmd=".$command."\"";
		echo $cmd;
		fwrite($fp,$cmd);
        exec($cmd);
    }

    public function saveRunTask($des,$time, $user_name, $ecrun_host_name, $ecrun_path, $bin_output_new, $bin_output_old, $ec_type, $conf_new, $conf_old, $input_path, $input_num)
    {
        $task = new EcRunTaskList();
		$task->des = $des;
        $task->time = $time;
        $task->user = $user_name;
        $task->log_path = "";
        $task->host_name = $ecrun_host_name;
        $task->run_path = $ecrun_path;
        $task->bin_output_new = $bin_output_new;
        $task->bin_output_old = $bin_output_old;
     	$task->ec_type = $ec_type;
        $task->conf_new = $conf_new;
        $task->conf_old = $conf_old;
        $task->input_path = $input_path;
        $task->input_num = $input_num;
        $rc = $task->save();
        if ($rc == true)
            return $task;
        return null;
    }

    public function actionDel()
    {
        $res = array("status" => 0, "msg" => "删除失败");

        $id = $_POST['id'];
        //先从数据表中删除该id
        $prj = Project::model()->findByPk($id);
        if($prj){
            $prj->is_del = 1;
            $ret = SendMail($prj->topic_id,$prj,3);
            if($prj->save() and $ret == true){      
                $res = array("status" => 1, "msg" => "删除成功"); 
            }
        }
   
        $this->json($res);    
    }  

    public function actionManage(){
        $res = array("status" => 0, "msg" => "更新失败"); 
        $flag = 2;

        $id = $_POST['id'];
        $prj = Project::model()->findByPk($id);
        if($prj){
            $prj->update_time = time(); 
            $prj->update_user = Yii::app()->user->name;
            $prj->topic_id = $_POST['topic'];
            $prj->state = $_POST['state'];
            $prj->qa_master = htmlentities($_POST['qa_master']);
            $prj->qa_reviewer = htmlentities($_POST['qa_reviewer']);
            $prj->act_lift_time = strtotime($_POST['act_lift_time']);
            $prj->report_time = strtotime($_POST['report_time']);
            $qa_time = $prj->report_time - $prj->act_lift_time;
            $prj->qa_time = ($qa_time>0?$qa_time:0)/86400;            
            ##调用邮件函数
            $ret = SendMail($prj->topic_id,$prj,$flag);

            if($prj->save() and $ret == 1){      
                $res = array("status" => 1, "msg" => "更新成功"); 
            }       
        }       
   
        $this->json($res); 
    }

}
?>
