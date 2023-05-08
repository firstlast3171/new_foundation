<?php

namespace app\config;

class View
{
  
  public function renderView($view,$params){
     foreach($params as $key=>$param){
          $$key = $param;
     }

     ob_start();
     require_once Application::$ROOTPATH."/views/$view.php";
     return ob_get_clean();
  }

  public function renderLayout($layout){
     ob_start();
     require_once Application::$ROOTPATH."/views/layouts/$layout.php";
     return ob_get_clean();
  }
}
