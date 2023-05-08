<?php
namespace app\migrate;
use app\config\Migrate;

class Add extends Migrate{
     public static function up(){
          Migrate::create("Add",[
               "id int AUTO_INCREMENT PRIMARY KEY",
               "body text",
               "category varchar(255)",
               "created_at DATETIME NULL DEFAULT NULL",
               "updated_at DATETIME NULL DEFAULT NULL"
          ]);
     }

     public static function down(){
          Migrate::drop("Add");
     }


};

Add::up();

?>