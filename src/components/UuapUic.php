<?php
/**
 * 封装uuap用户中心信息获取方法
 */
class UuapUic extends CApplicationComponent
{
    public $service;
		public $auth;
		public $appKey;

    /**
     * 返回一个用户是否属于邮件组
     * @param string $emailGroup 邮件组
     * @param null|用户id $user
     * @return bool
     */

		public function getSuperiorByUsername($username, $deep=1){
			 $result = $this->call('UserRemoteService', 'getSuperiorByUsername', array($username, $deep));		

			 return $result->username;
		}

		public function getUserByUsername($username){
				$result = $this->call('UserRemoteService', 'getUserByUsername', array($username));
				return $result;
		}

		public function getAllProductlinesByUsername($username){
				$result = $this->call('ProductRemoteService', 'getAllProductlinesByUsername', array($username));

				$products = array();
				if($result){
						foreach($result as $rev){
								$products[$rev->name] = $rev->name;
						}
				}
	
				return implode(",", $products);	
		}

    public function call($interface, $method, $param)
    {
				$argv = array();
				if(is_array($param)){
						$i = 0;
						foreach($param as $value){
								$key = "arg".$i;
								$argv[$key] = $value;
								$i ++;
						}
				}

        $client = new SoapClient("{$this->service}/ws/$interface?wsdl");
				$soapheader = new SoapHeader($this->auth,"appKey",$this->appKey,false);
				$client->__setSoapHeaders(array($soapheader));

        $return = $client->{$method}($argv)->return;
        return $return;
    }
}
