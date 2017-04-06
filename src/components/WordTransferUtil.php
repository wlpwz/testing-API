<?php

define(SECTION_STRING, "STRING");
define(SECTION_TYPE, "TYPE");
define(SECTION_RESULT, "RESULT");
define(SECTION_INFO, "INFO");
define(SECTION_RC, "RC");
define(SECTION_MESSAGE, "MESSAGE");

function s($key, $section=SECTION_STRING)
{
    return WordTransferUtil::getWrapValue($section, $key);
}

class WordTransferUtil {
	private static $WordTransferDict = null;
	public static $CURRENT_DICT_SECTION = "default";

	public static function getDict() {
		if (WordTransferUtil :: $WordTransferDict == null) {
			WordTransferUtil :: initDict();
			return WordTransferUtil :: $WordTransferDict;
		} else {
			return WordTransferUtil :: $WordTransferDict;
		}

	}

	private static function initDict() {
		//$dict_path = Yii :: app()->basePath . "/../peotected/component/WordTransfer.dict";
		$dict_path = dirname(__FILE__) . "/WordTransfer.dict";

		$handle = @ fopen($dict_path, "r");
		if ($handle) {
			while (!feof($handle)) {
				$line = fgets($handle);
				WordTransferUtil :: initLine($line);
			}
			fclose($handle);
		}
	}

	private static function initLine($line) {
		// if is blank line, return directly
		if ($line == null || trim($line) == "") {
			return;
		}
		// if is section line, change current section value
		$labelchar = substr(trim($line), 0, 1);
		if ($labelchar == "[") {
			$current_section = substr(trim($line), 1, -1);

			if ($current_section != null || trim($current_section) != "") {
				WordTransferUtil :: $CURRENT_DICT_SECTION = $current_section;
			}
		}
		// else, add the line to section dict
		else {
			list ($dict_key, $dict_value) = explode(":", $line);
			$dict_key = trim($dict_key);
			$dict_value = trim($dict_value);
			WordTransferUtil :: $WordTransferDict[WordTransferUtil :: $CURRENT_DICT_SECTION][$dict_key] = $dict_value;
		}
	}
	public static function releaseDict(){
		WordTransferUtil::$WordTransferDict=null;
	}
	public static function getWrapValue($sectionName,$keyName){
		$resultArray=WordTransferUtil::getDict();
		$value = $resultArray[$sectionName][$keyName];
		if ($value == null)
		  $value = $keyName;
		return $value;
	}
}
//var_dump(WordTransferUtil :: getDict());
//WordTransferUtil::releaseDict();
//var_dump(WordTransferUtil ::$CURRENT_DICT_SECTION);

?>
