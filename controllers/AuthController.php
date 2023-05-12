<?php
   
namespace app\controllers;
use app\config\Controller;
use app\config\Request;
use app\config\Response;
use app\config\Session;

   class  AuthController extends Controller{
     public function login(Request $request){
 
      if($request->isGet()){
        $errors = $this;
        $values = $request->getBody();
        return $this->render("login","main",[
          "errors" => $errors,
          "values" => $values
        ]);
      }

      if($request->isPost()){
        $validate = $this->validate($request->getBody(),[
          "name" => ["required"],
          "email"=> ["required","email"],
          "password" => ["required",["min","min"=>8],["max","max"=>32]],
          "confirmpassword" => ["required",["match","match"=>"password"]],
        ]);
 
       if($validate){
         $user = $request->getBody();
        Session::set("user",$user);
        Response::redirect("/add");
       }
     
        // $name = $request->getBody()["name"];

        // var_dump($name);
        // if($name === ""){
        //   Response::redirect("/login","input=needed");
        // }
        // Session::set("user",$name);
        $errors = $this;
        $values = $request->getBody();
        return $this->render("login","main",[
          "errors" => $errors,
          "values" => $values
        ]);
      }
     
     }

     public function logout(Request $request){
      if($request->isPost()){
        Session::unset("user");
        Response::redirect("/login");
      }
     }
   }
   
 
        