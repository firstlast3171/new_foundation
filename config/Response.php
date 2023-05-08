<?php

namespace app\config;

class Response
{
 public static function redirect($url,$query=""){
     if($query) $url = $url . "?$query";

     header("location: $url");
     exit();
 }
}
