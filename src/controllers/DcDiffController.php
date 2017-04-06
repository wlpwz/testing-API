<?php

class DcDiffController extends Controller
{
	public $layout = "main";
	public static $PATH_PREFIX = "/home/work/platform_dc/diff/";
	public static $DIV_SCRIPT = "/home/work/platform_dc/script/div.sh";	

    public function actionIndex($dt='', $id){
		if('' === $dt){
			$dt = date('Y-m-d', strtotime('now'));
		}
		$pack1 = self::$PATH_PREFIX . "/$dt/$id/diffcache/logdiff/Pack1.diff";	
		$pack2 = self::$PATH_PREFIX . "/$dt/$id/diffcache/logdiff/Pack2.diff";	
		$lostitem = $this->getResult($pack1);
		$newitem = $this->getResult($pack2);		
		$r['data'] = ['lostitem' => $lostitem, 'newitem' => $newitem];
		//var_dump($r);exit;
		$this->render('index', $r);
	}

	public function getResult($filename){
		exec("sh " . self::$DIV_SCRIPT . " $filename", $ret);
		$data = [];
		if($ret){
			foreach($ret as $rv){
				$item = explode("\t", $rv);
				$data[] = $item;
			}
		}	
		return $data;
	}

}
