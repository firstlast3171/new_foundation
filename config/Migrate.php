<?php

namespace app\config;
use DateTime;
use PDOException;

class Migrate
{
   public static function dbname(){
     return (new Database())->db_name;
   }

    public static function connect(){
      return (new Database())->connection();
    }


     public static function create(string $table,array $data){

          try{
               $data = implode(",",$data);
               $table = strtolower($table);
             
               $tables = self::exist(self::dbname());
               
               if(!in_array($table,$tables)){
                    echo "$table is successfully migrated".PHP_EOL;
               $statement = self::connect()->prepare("CREATE TABLE IF NOT EXISTS `$table`($data)");
               return $statement->execute();
               
               }else{
                   echo "$table is already migrated".PHP_EOL;
               }
           
          }
          catch(PDOException $e){
               print_r($e->getMessage());
          }
     }

     public static function drop(string $table){
          $dltb =$table;
          $table = strtolower($table);

             
          $tables = self::exist(self::dbname());
          $files = array_diff(scandir("migrate"),array(".",".."));
          
          if(in_array($table,$tables)){
               echo "$table is successfully droped".PHP_EOL;
               $statement = self::connect()->prepare("DROP TABLE IF EXISTS `$table`");
               return $statement->execute();
               // foreach($files as $file){
               //      $file = explode("_",$file);
                   
               //      if(in_array("$dltb.php",$file)){
                         
               //      }
               // }
          
          }else{
              echo "$table does not exist".PHP_EOL;
          }
          
          
     }

     public static function exist($db){
          $statement = self::connect()->prepare("SHOW TABLES");
          $statement->execute();
          $tables = $statement->fetchAll();
          $tocheckArr = [];
          foreach($tables as $table){
               $tocheck= "Tables_in_$db";
               $tocheckArr[] .= $table[$tocheck];
              
          }
          return $tocheckArr;
     }

     public function makeMigrate($migrate){
   
         $namespace = "namespace app\migrate;";
         $use = "use app\config\Migrate;";
         $year = (new DateTime())->format('Y');
         $month = (new DateTime())->format('m');
         $day = (new DateTime())->format('d');
         $migrateFileName = $year."_".$month."_".$day."_".$migrate;
          $filename = dirname(__DIR__)."/migrate/$migrateFileName.php";


         $body = 
'<?php
'.$namespace.'
'.$use.'

class '.$migrate.' extends Migrate{
     public static function up(){
          Migrate::create("'.$migrate.'",[
               "id int AUTO_INCREMENT PRIMARY KEY",
               "body text",
               "created_at DATETIME NULL DEFAULT NULL",
               "updated_at DATETIME NULL DEFAULT NULL"
          ]);
     }

     public static function down(){
          Migrate::drop("'.$migrate.'");
     }


};

'.$migrate.'::up();

?>';
if(!file_exists($filename)){
     echo "$migrate is successfully created";
     file_put_contents($filename,$body);
}else{
     echo "$migrate is already created";
}





     }
}
