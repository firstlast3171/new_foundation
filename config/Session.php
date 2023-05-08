<?php

namespace app\config;

class Session
{
 public static function set($wanttoset,$value){
     session_start();
     $_SESSION[$wanttoset] = $value;
 }

 public static function unset($wanttounset){
     session_start();
     unset($_SESSION[$wanttounset]);
 }
}
