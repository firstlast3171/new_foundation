<?php

namespace app\config;

use app\config\View;

class Controller extends View
{
    
    public function render(string $view,string $layout="main",array $params = []){
        $renderView = $this->renderView($view,$params);
        $renderLayout = $this->renderLayout($layout);

        return str_replace("{{content}}",$renderView,$renderLayout);
    }



    public function MakeController(string $controllerName){
        $controller_name = $controllerName."Controller";
        $namespace = "namespace app\controllers;";

        $use = "use app\config\Controller;";
        $get_controllerFile = dirname(__DIR__)."/controllers/$controller_name.php";

        $content =
            '<?php
'.$namespace.'
'.$use.'
   
class  '.$controller_name.' extends Controller
{
     public function index(){
      return $this->render("index");
     }
}
   
 
        ';
if(!file_exists($get_controllerFile)){
    file_put_contents($get_controllerFile,$content);
    echo "$controller_name is successfully created";
}else{
    echo "$controller_name is already created";
}



    }

    public array $errors = [];

    public function validate($tovalidate,$rules){

        // var_dump($tovalidate);
     
        foreach($rules as $key=>$rule){
            $value = $tovalidate[$key];
         
            foreach($rule as $ruleName){
                 $rule_name =   $ruleName ;
         
                if(is_array($rule_name )){
                    $rule_name  = $ruleName[0];
                }
              
                if($rule_name  === "required" && !$value){
                    $this->addMessage($key,"required");
                    
                 }

                 if($rule_name  === "email" && !filter_var($value,FILTER_VALIDATE_EMAIL)){
                    $this->addMessage($key,"email");
                 }

                 if($rule_name  === "min" && strlen($value) < $ruleName["min"]){
                    $this->addMessage($key,"min",$ruleName);
                 }
                 if($rule_name  === "max" && strlen($value) > $ruleName["max"]){
                    $this->addMessage($key,"max",$ruleName);
                 }

                 if($rule_name === "match" && $value !== $tovalidate[$ruleName["match"]] ){
                    $this->addMessage($key,"match",$ruleName); 
                 }
             


              
            }
          
          
            // var_dump($rule);
            // var_dump($key);
            // var_dump($tovalidate[$key]);
          
           
        }
        return empty($this->errors);
    }

    public function addMessage($attr,$rule,$params = []){
        $message = $this->errorMessage()[$rule] ?? "";
        foreach($params as $key=>$value){
            $message = str_replace("{{$key}}",$value,$message);
        }

        $this->errors[$attr][] = $message;
    }

    public function errorMessage(){
        return [
            "required" => "This Field is required",
            "email" => "This Field must be valid email address",
            "min" => "Min Length of this Field must be {min}",
            "max" =>  "Max Length of this Field must be {max}",
            "match" => "This Field must be same as {match}"
        ];
    
    
    }

    public function hasError($key){
        return $this->errors[$key] ?? false;
        }

    public function getFirstError($key){
        return $this->errors[$key][0] ?? false;
    }
}