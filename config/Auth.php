<?php

namespace app\config;

use app\config\Response;

class Auth
{
 
 public static function check(string $wanttochecck = "user",string $redirect = ""){
  session_start();
    if(isset($_SESSION[$wanttochecck])){
       return $_SESSION[$wanttochecck];
    }else{
      Response::redirect($redirect);
    }
 }
 
   
}
