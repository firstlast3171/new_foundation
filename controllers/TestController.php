<?php
   
  
   namespace app\controllers;

use app\config\Auth;
use app\config\Request;
use app\config\Controller;
use app\config\Application;
use app\config\Response;
use app\models\Test;

   class  TestController extends Controller{
     public function index(Request $request){
      if($request->isGet()){
     
         if(Auth::check("/login","user")){
         
            $errors = $this;
            return $this->render("index","main",[
               "errors"=>$errors
            ]);

         }
    
      };
     if($request->isPost()){
      $validate = $this->validate($request->getBody(),[
         "test" => ["required",["min","min"=>32]],
      ]);
      if($validate){
        $testModel = new Test();
         $testModel->body = $request->getBody()["test"];
         $testModel->create();
      //   Response::redirect("/test");
      }
     
     }

     $errors = $this;
     $values = $request->getBody();
     return $this->render("index","main",[
        "errors"=>$errors,
        "values" => $values
     ]);



   
   
      


     }
   }
   
 
        