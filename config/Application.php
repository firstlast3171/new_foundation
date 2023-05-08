<?php

namespace app\config;



class Application
{
 public static $ROOTPATH;

 public static $app;
 public Route $route;
 public Request $request;
 public Controller $controller;
 public Auth $auth;

 public View $view;


 public function __construct($rootpath)
 {
     self::$ROOTPATH = $rootpath;
     self::$app = $this;
     $this->request = new Request();
     $this->view = new View();
     $this->auth = new Auth();
     $this->controller = new Controller();
     $this->route = new Route($this->request);
  


 }

 public function run(){
    return $this->route->reslove();
 }
}