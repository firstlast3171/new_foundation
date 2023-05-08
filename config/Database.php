<?php
namespace app\config;

use Dotenv\Dotenv;
use PDO;
use PDOException;

class Database
{
     public $db_host;
     public $db_user;
     public $db_pass;
     public $db_name;
     public $db;

     public function __construct(){
          $dotenv = Dotenv::createImmutable(__DIR__."/../");
          $dotenv->load();
          $this->db_host = $_ENV["DB_HOST"];
          $this->db_user = $_ENV["DB_USER"];
          $this->db_pass = $_ENV["DB_PASS"];
          $this->db_name = $_ENV["DB_NAME"];
          $this->db = null;

          
     }

     public function connection(){
          try{
               $this->db = new PDO("mysql:dbhost=$this->db_host;dbname=$this->db_name",$this->db_user,$this->db_pass,[
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
               ]);

               return $this->db;
          }
          catch(PDOException $e){
               print_r($e->getMessage());
          }
     }

    
}
