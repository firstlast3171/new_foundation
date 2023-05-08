<?php

namespace app\config;

use app\config\Response;

class Auth
{
 
 public static function check(string $redirect = "",string $wanttochecck = "user"){
  session_start();
    if(isset($_SESSION[$wanttochecck])){
       return $_SESSION[$wanttochecck];
    }else{
      Response::redirect($redirect);
    }
 }
 
   
}
