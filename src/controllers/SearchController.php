<?php
    
class SearchController extends Controller
{
	public $layout = "1";

	public static $g_servers = array(
    	"cq01-wd-knowledge3-ky1.cq01.baidu.com:8093/2"
	);

	public function actionIndex(){
		$this->render('1', $r);
	}

	public function actionSubmit(){
		$this->render('submit',$r);
	}

	//print_r(api_search($_GET["key"]));
	public static $black_dict = array("_id","_type","_score","image");

	public function api_search($keyword, $serverid = 0) {
    
    	$gremlin = "g.has('name',MATCH,'$keyword').limit(10).with('*')";
    	$query = array(
        	"method" => "gremlinQuery", 
        	"params" => array(
            	$gremlin,
            	"autotest3"
        	)
    	);
    
    	$data_string = json_encode($query);
    
    	if ($serverid >= count(self::$g_servers)) {
        	return null;
    	}
    
    	$url = self::$g_servers[$serverid];
    	//echo $keyword;
    	//echo $data_string;
    	$result = $this->api_curlPost($url, $data_string);
    	if ($result) {
        	$result_array = json_decode($result);
        	//print_r($result_array);
        	//print_r($result_array->result);
        	if (!empty($result_array->result->_ret)) {
            	return $result_array->result->_ret;
        	}
    	}
    
    	return null;
	}

	public function api_curlPost($url, $data_string) {
		// Initialize cURL
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);    
    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    	curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        	'Content-Type: application/json',
        	'Content-Length: ' . strlen($data_string))
    	);
    
		// Get the target contents
		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
	
		if (!$response || $httpCode != 200) {
			//echo "httpErr:" . $httpCode;
        	//echo "response:" . $response; 
			return false;
		}

		return $response;
	}

	public function actionSearch()
	{
		$key_map = array(		   "age"=>iconv("UTF-8","gb18030","年龄")
								  ,"aword"=>iconv("UTF-8","gb18030","荣誉")
                                  ,"birthDate"=>iconv("UTF-8","gb18030","出生日期")
								  ,"birthPlace"=>iconv("UTF-8","gb18030","出生地")
								  ,"height"=>iconv("UTF-8","gb18030","身高")
								  ,"nationality"=>iconv("UTF-8","gb18030","国籍")
								  ,"numberInClub"=>iconv("UTF-8","gb18030","俱乐部球衣号")
								  ,"numberInNationalTeam"=>iconv("UTF-8","gb18030","国际队球衣号")
								  ,"speciality"=>iconv("UTF-8","gb18030","特点")
								  ,"tempPosition"=>iconv("UTF-8","gb18030","位置")
								  ,"weight"=>iconv("UTF-8","gb18030","体重")
								  ,"zodiacSign"=>iconv("UTF-8","gb18030","星座")
								  ,"awards"=>iconv("UTF-8","gb18030","荣誉")
					   			  ,"stars"=>iconv("UTF-8","gb18030","球星")
							      ,"speciality"=>iconv("UTF-8","gb18030","简介")
									);
		$key_map_1 = array("age"=>"年龄"
								  ,"aword"=>"荣誉"
                                  ,"birthDate"=>"出生日期"
								  ,"birthPlace"=>"出生地"
								  ,"height"=>"身高"
								  ,"nationality"=>"国籍"
								  ,"numberInClub"=>"俱乐部球衣号"
								  ,"numberInNationalTeam"=>"国际队球衣号"
								  ,"speciality"=>"特点"
								  ,"tempPosition"=>"位置"
								  ,"weight"=>"体重"
								  ,"zodiacSign"=>"星座"
								  ,"awards"=>"荣誉"
								  ,"stars"=>"球星"
								  ,"speciality"=>"特点"
									);
		$key_word = $_GET['keyword'];
		$code = strtolower($_GET['lang']);
		if (is_null($key_word) || $key_word == "")
		{
			echo "none1";
			return true;
		}
		$result = $this->api_search($key_word);
		if (is_null($result))
		{
			if ($code != "utf-8" && $code != "UTF-8")
				$key_word = iconv("gb18030","UTF-8",$key_word);
			return $this->searchSelfData($code, $key_word);
		}
		$topic="";
		$html_code = "";
		$baike_link = "";
		if (count($result) > 0)
		{
			$person = $result[0];
			$html_code = $html_code . "<table>";
			$html_code = $html_code . "<tbody>";
			while(list($k,$v) = each($person))
			{
				if (count($v) >= 1)
				{
					$html_code = $html_code."<tr>";
					//echo $k."=".$v[0]."<br>";
					if (array_key_exists($k,$key_map) == true)
					{	
						if ($code == "utf-8")
						{
							$html_code = $html_code . "<th>".$key_map_1[$k]."</th>";
							$html_code = $html_code . "<td>".$v[0]."</td>";
						}
						else
						{
							$html_code = $html_code . "<th>".$key_map_1[$k]."</th>";
							$html_code = $html_code . "<td>".$v[0]."</td>";
						}
					}
					$html_code = $html_code."</tr>";
					if ($k == "name")
					{
						if ($code == "utf-8")
							$topic = $v[0];
						else
							$topic = $v[0];
					}
					else if($k == "url")
					{
						if ($code == "utf-8")
                            $baike_link = $v[0];
                        else
                            $baike_link = $v[0];
					}
				}
			}
			$html_code = $html_code . "</tbody>";
			$html_code = $html_code . "</table>";
		}
		$link = $link."<ul>";
		if ($baike_link != "")
		{
			$link = $link."<li align=\"left\"><a href=\"".$baike_link."\" target=\"_blank\">"."<img src=\"http://cp01-qa-spider004.cp01.baidu.com:8900/baidu.png\">&nbsp;百科词条</a></li>";
		}
		$link = $link."<li align=\"left\"><a href=\"http://www.baidu.com/s?tn=monline_5_dg&wd=".$key_word."&ie=utf-8\" target=\"_blank\"><img src=\"http://cp01-qa-spider004.cp01.baidu.com:8900/baidu.png\">&nbsp;百度搜索</a></li>";
		$link = $link."</ul>";
		if ($topic == "")
			echo "none";
		else
			echo $topic."&&".$html_code."&&".$link;
	}

	public function actionSearch_mobile()
	{
		$key_map = array(		   "age"=>iconv("UTF-8","gb18030","年龄")
								  ,"aword"=>iconv("UTF-8","gb18030","荣誉")
                                  ,"birthDate"=>iconv("UTF-8","gb18030","出生日期")
								  ,"birthPlace"=>iconv("UTF-8","gb18030","出生地")
								  ,"height"=>iconv("UTF-8","gb18030","身高")
								  ,"nationality"=>iconv("UTF-8","gb18030","国籍")
								  ,"numberInClub"=>iconv("UTF-8","gb18030","俱乐部球衣号")
								  ,"numberInNationalTeam"=>iconv("UTF-8","gb18030","国际队球衣号")
								  ,"speciality"=>iconv("UTF-8","gb18030","特点")
								  ,"tempPosition"=>iconv("UTF-8","gb18030","位置")
								  ,"weight"=>iconv("UTF-8","gb18030","体重")
								  ,"zodiacSign"=>iconv("UTF-8","gb18030","星座")
								  ,"awards"=>iconv("UTF-8","gb18030","荣誉")
					   			  ,"stars"=>iconv("UTF-8","gb18030","球星")
							      ,"speciality"=>iconv("UTF-8","gb18030","简介")
									);
		$key_map_1 = array("age"=>"年龄"
								  ,"aword"=>"荣誉"
                                  ,"birthDate"=>"出生日期"
								  ,"birthPlace"=>"出生地"
								  ,"height"=>"身高"
								  ,"nationality"=>"国籍"
								  ,"numberInClub"=>"俱乐部球衣号"
								  ,"numberInNationalTeam"=>"国际队球衣号"
								  ,"speciality"=>"特点"
								  ,"tempPosition"=>"位置"
								  ,"weight"=>"体重"
								  ,"zodiacSign"=>"星座"
								  ,"awards"=>"荣誉"
								  ,"stars"=>"球星"
								  ,"speciality"=>"特点"
									);
		$key_word = $_GET['keyword'];
		$code = strtolower($_GET['lang']);
		if (is_null($key_word) || $key_word == "")
		{
			echo "none1";
			return true;
		}
		$result = $this->api_search($key_word);
		if (is_null($result))
		{
			if ($code != "utf-8" && $code != "UTF-8")
				$key_word = iconv("gb18030","UTF-8",$key_word);
			return $this->searchSelfData_mobile($code, $key_word);
		}
		$topic="";
		$html_code = "";
		$baike_link = "";
		if (count($result) > 0)
		{
			$person = $result[0];
			$html_code = $html_code . "<table>";
			$html_code = $html_code . "<tbody>";
			while(list($k,$v) = each($person))
			{
				if (count($v) >= 1)
				{
					$html_code = $html_code."<tr>";
					//echo $k."=".$v[0]."<br>";
					if (array_key_exists($k,$key_map) == true)
					{	
						if ($code == "utf-8")
						{
							$html_code = $html_code . "<th>".$key_map_1[$k]."</th>";
							$html_code = $html_code . "<td>".$v[0]."</td>";
						}
						else
						{
							$html_code = $html_code . "<th>".$key_map_1[$k]."</th>";
							$html_code = $html_code . "<td>".$v[0]."</td>";
						}
					}
					$html_code = $html_code."</tr>";
					if ($k == "name")
					{
						if ($code == "utf-8")
							$topic = $v[0];
						else
							$topic = $v[0];
					}
					else if($k == "url")
					{
						if ($code == "utf-8")
                            $baike_link = $v[0];
                        else
                            $baike_link = $v[0];
					}
				}
			}
			$html_code = $html_code . "</tbody>";
			$html_code = $html_code . "</table>";
		}
		$link = $link."<ul>";
		if ($baike_link != "")
		{
			$link = $link."<li align=\"left\"><a href=\"".$baike_link."\" target=\"_blank\">"."<img src=\"http://cp01-qa-spider004.cp01.baidu.com:8900/baidu.png\">&nbsp;百科词条</a></li>";
		}
		$link = $link."<li align=\"left\"><a href=\"http://www.baidu.com/s?tn=monline_5_dg&wd=".$key_word."&ie=utf-8\" target=\"_blank\"><img src=\"http://cp01-qa-spider004.cp01.baidu.com:8900/baidu.png\">&nbsp;百度搜索</a></li>";
		$link = $link."</ul>";
		if ($topic == "")
		{
			$array = Array();
			echo json_encode($array);
		}	
		else
		{
			echo $topic."&&".$html_code."&&".$link;
		}
	}

	public function actionSearchProduct()
	{
		$code = strtolower($_GET['lang']);
		$key_word = urldecode($_GET['keyword']);
		return $this->searchSelfData($code, $key_word);
	}

	public function actionSearchProduct_mobile()
	{
		$code = strtolower($_GET['lang']);
		$key_word = urldecode($_GET['keyword']);
		return $this->searchSelfData_mobile($code, $key_word);
	}

	public function searchSelfData_mobile($code, $key_word)
	{
		if (is_null($key_word) || $key_word == "")
        {
            echo "none";
            return true;
        }
        global $key_word_map;
        include_once("dict.php");
		if(array_key_exists($key_word, $key_word_map) == true)
		{
			$html_code = "<table ><tbody>";			
	/*		if (array_key_exists("picture",$key_word_map[$key_word]))
			{
				$result = $key_word_map[$key_word];*/
			/*	$html_code = $html_code."<tr>";
				$html_code = $html_code . "<th><img width=60 height=70 src=\"".$result["picture"]."\"/></th>";
				$html_code = $html_code."</tr>";*/
			/*	$topic = $topic . "<img width=60 height=70 src=\"".$result["picture"]."\"/>";
				
			}*/
			while(list($k,$v) = each($key_word_map[$key_word]))
			{
				$html_code = $html_code ."<tr>";
				if ($code == "utf-8")
				{
					if ($k != "link" && $k != "anchor" && $k != "picture")
					{
						$html_code = $html_code . "<th>".$k."</th>";
						$html_code = $html_code . "<td>".$v."</td>";
					}
				}		
				else
				{
					if ($k != "link" && $k != "anchor" && $k != "picture")
					{
						$html_code = $html_code . "<th>".$k."</th>";
						$html_code = $html_code . "<td>".$v."</td>";
					}	
				}
				$html_code = $html_code."</tr>";
			}
			$html_code = $html_code."</tbody></table>";
			$topic=$topic.$key_word;
			$item = $key_word_map[$key_word];
			$link = $item["link"];
			//"<li align=\"left\"><a href=\"".$item["link"]."\">"."<font color=\"blue\">".$item["anchor"]."</font>"."</a></li>";
			$result_array = array("topic"=>$topic,
								  "content"=>$key_word_map[$key_word]
								 );
			echo json_encode($result_array);
		}
		else
		{
			$topic = $key_word; 
			$html_code = "暂无实体结果。";
			$link="<a target=\"_blank\" href=\"http://www.baidu.com/s?wd=".$topic."&rsv_bp=0&tn=baidu&rsv_spt=3&ie=utf-8&rsv_sug3=5&rsv_sug4=79&rsv_sug1=5&rsv_sug2=0&inputT=1838\" ><img src=\"http://cp01-qa-spider004.cp01.baidu.com:8900/baidu.png\"/>&nbsp;去百度搜索</a>";
			$result_array = array("topic"=>$topic,
								  "content"=>$key_word_map[$key_word]
								 )	;
			echo json_encode($result_array);
		}
		
	}

	public function searchSelfData($code, $key_word)
	{
		if (is_null($key_word) || $key_word == "")
        {
            echo "none";
            return true;
        }

        global $key_word_map;
        include_once("dict.php");
		if(array_key_exists($key_word, $key_word_map) == true)
		{
			$html_code = "<table ><tbody>";			
	/*		if (array_key_exists("picture",$key_word_map[$key_word]))
			{
				$result = $key_word_map[$key_word];*/
			/*	$html_code = $html_code."<tr>";
				$html_code = $html_code . "<th><img width=60 height=70 src=\"".$result["picture"]."\"/></th>";
				$html_code = $html_code."</tr>";*/
			/*	$topic = $topic . "<img width=60 height=70 src=\"".$result["picture"]."\"/>";
				
			}*/
			while(list($k,$v) = each($key_word_map[$key_word]))
			{
				$html_code = $html_code ."<tr>";
				if ($code == "utf-8")
				{
					if ($k != "link" && $k != "anchor" && $k != "picture")
					{
						$html_code = $html_code . "<th>".$k."</th>";
						$html_code = $html_code . "<td>".$v."</td>";
					}
				}		
				else
				{
					if ($k != "link" && $k != "anchor" && $k != "picture")
					{
						$html_code = $html_code . "<th>".$k."</th>";
						$html_code = $html_code . "<td>".$v."</td>";
					}	
				}
				$html_code = $html_code."</tr>";
			}
			$html_code = $html_code."</tbody></table>";
			$topic=$topic.$key_word;
			$item = $key_word_map[$key_word];
			$link = $item["link"];
			echo $topic."&&".$html_code."&&".$link;
			//"<li align=\"left\"><a href=\"".$item["link"]."\">"."<font color=\"blue\">".$item["anchor"]."</font>"."</a></li>";
		}
		else
		{
			$topic = $key_word; 
			$html_code = "暂无实体结果。";
			$link="<a target=\"_blank\" href=\"http://www.baidu.com/s?wd=".$topic."&rsv_bp=0&tn=baidu&rsv_spt=3&ie=utf-8&rsv_sug3=5&rsv_sug4=79&rsv_sug1=5&rsv_sug2=0&inputT=1838\" ><img src=\"http://cp01-qa-spider004.cp01.baidu.com:8900/baidu.png\"/>&nbsp;去百度搜索</a>";
			echo $topic."&&".$html_code."&&".$link;
		}
		
	}

}
