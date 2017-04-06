<?php
define(MAXCOUNT, 500);

class ConsoleCommand extends CConsoleCommand {
		
		protected function insertData($data, $table_name){
       $count = 0;
       echo date("Y-m-d H:i:s", time()).": ";
       if(empty($data)){
               echo "No data!\n";
         return;
           }
       $circle = ceil(count($data)/MAXCOUNT);
       $fields = array_keys($data[0]);

       $sql = "INSERT INTO {$table_name} (`".implode('`,`', $fields)."`) VALUES ";
       for($i = 0; $i < $circle; $i++){
        $values = array();
        for($m = 0; $m < MAXCOUNT; $m++){
          $index = $i*MAXCOUNT + $m;
          if(isset($data[$index])){
            $temp = array();
            foreach($fields as $fval){
              $temp[] = "'".addslashes($data[$index][$fval])."'";
            }
            $values[] = "(".implode(',', $temp).")";
          }
        }
        $insertSql = $sql.implode(',', $values).";";

        if(Yii::app()->db->createCommand($insertSql)->execute()===FALSE){
          echo "Insert Into {$table_name} Failed : line {$index}~{$m}\n";
        }else{
          echo "Insert Into {$table_name} Done with ".count($values)." Details!\n";
        }
       }
    }
 
}
