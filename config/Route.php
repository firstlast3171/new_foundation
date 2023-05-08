<?php

namespace app\config;

class Route
{
    public array $routes = [];
    public Request $request;

 public function __construct(Request $request)
 {
     $this->request = $request;
 }

    public function get($path,$callback){
        
        $this->routes["get"][$path] = $callback;
    }

    public function post($path,$callback){
        
        $this->routes["post"][$path] = $callback;
    }

    public function reslove()
    {
        $method = $this->request->method();
        $path = $this->request->path();

        $callback = $this->routes[$method][$path] ?? false;
    if($callback === false){
        http_response_code(404);
        require_once Application::$ROOTPATH."/views/statusPages/_404.php";
    }
        if(is_string($callback)){
            echo $callback;
        }

        if(is_callable($callback)){
            echo call_user_func($callback);
        }

        if(is_array($callback)){
            [$class,$method] = $callback;
            $class = new $class;
            echo call_user_func_array([$class,$method],[$this->request]);
        }

    }
}