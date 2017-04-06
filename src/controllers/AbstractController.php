<?php
	class AbstractController extends Controller{

		public $layout = "main";
		
		
		 public function actionIndex(){
			$r=array();
			$connection = Yii::app()->db;
			$sql = "truncate versionpic ;";
			$command = $connection->createCommand($sql);
			$rowCount=	$command->execute();
			
			$handle = fopen('/home/work/LibPP/DATA/chineseec/ec1.topo.txt', 'r');
			if($handle){
				while (!feof($handle)) {
					$buffer = fgets($handle);
					$str =  explode(":",$buffer);
					$pd = new Versionpic();
					$pd->nodename = $str[0];
					$pd->linknode = $str[1];
					$pd->tooltip = $str[0];
					$pd->save();
				}
				fclose($handle);
			}
		
			$result = Versionpic::model()->findAll();
			$i=0;
			foreach($result as $node)
			{
				$model[$i]=array("name"=>$node['nodename'],"url"=>$node['url'],"linknode"=>$node['linknode'],"health"=>$i%3-1,"tooltip"=>$node['tooltip']);
                $i+=1;
			}
			$r['result']=json_encode($model);
			//$this->json($r);
			$this->render('index', $r);
		}
}

?>
