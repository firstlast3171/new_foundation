<?php
namespace app\migrate;
use app\config\Migrate;

class Test extends Migrate{
     public static function up(){
          Migrate::create("Test",[
               "id int AUTO_INCREMENT PRIMARY KEY",
               "body text",
               "created_at DATETIME NULL DEFAULT NULL",
               "updated_at DATETIME NULL DEFAULT NULL"
          ]);
     }

     public static function down(){
          Migrate::drop("Test");
     }


};

Test::up();

?>