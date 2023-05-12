<?php

namespace app\config;

class Model
{
 

     public function connect(){
          return (new Database())->connection();
     }

     public function makeModel($model){
          $columns = $this->columns($model);
          $values = "";
          foreach($columns as $column){
              $values .= "public $$column;".PHP_EOL;
          }
         $namespace = "namespace app\models;";
         $use = "use app\config\Model;";
         $filename = dirname(__DIR__)."/models/$model.php";
         $body = 
'<?php
'.$namespace.'
'.$use.'

class '.$model.' extends Model{
public $table_name="'.$model.'";
'.$values.'
}
?>';

if(!file_exists($filename)){
     echo "$model is successfully created";
     file_put_contents($filename,$body);
}else{
     echo "$model is already created";
}

     }

     public function columns($model){
          $statement = $this->connect()->prepare("SHOW COLUMNS FROM `$model`");
          $statement->execute();
          $columnsNames =  $statement->fetchAll();
          $columns = [];
          foreach($columnsNames as $columnsName){
               $columns[] = $columnsName["Field"];
          }
          return $columns;
          
     }

     public function create($table = "",$timezone=""){
          if($table === ""){
               $table = $this->table_name;
          }
          $table = strtolower($table);
          $date = new \DateTime();
          if($timezone === ""){
               $timezone = "Asia/Yangon";
          }
          $date->setTimezone(new \DateTimeZone($timezone));
          if($this->created_at === NULL){
               $this->created_at = $date->format("Y:m:d H:i:s");
          }
          if($this->updated_at === NULL){
               $this->updated_at = $date->format("Y:m:d H:i:s");
          }
          $insert_in = [];
          $insert_value = [];
          $values = [];
          foreach($this as $key=>$value){
               $insert_in[] = $key;
               $insert_value[] = $value;
               $values[$key] = $value;
          }
          array_shift($values);
          array_shift($insert_in);
          array_shift($insert_value);

          $insert_in_formOne = implode(",",$insert_in);
          $insert_in_formTwo = implode(",",array_map(fn($forms) => ":$forms",$insert_in));          
        
          $statement = $this->connect()->prepare("INSERT INTO `$table`($insert_in_formOne) VALUES ($insert_in_formTwo)");
          $statement->execute($values);
      }

      public function read($by="",$key="",$format=""){
          if($format === "lastfirst"){
               $statement = $this->connect()->prepare("SELECT * FROM `$this->table_name` ORDER BY id DESC");
               $statement->execute();
               return $statement->fetchAll();
          }
          if(!$by){
              $statement = $this->connect()->prepare("SELECT * FROM `$this->table_name`");
              $statement->execute();
              return $statement->fetchAll();
          }
         
          if($by && $key){
               $statement = $this->connect()->prepare("SELECT * FROM `$this->table_name` WHERE $by=$key");
              $statement->execute();
              return $statement->fetch();
          }
      }
}
