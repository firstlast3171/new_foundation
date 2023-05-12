<?php
namespace app\controllers;

use app\config\Auth;
use app\config\Controller;
use app\config\Request;
use app\config\Response;
use app\models\Add;

class  AddController extends Controller
{
     public function index(Request $request){
      if($request->isGet()){
          $auth = Auth::check("user","/login");
          if($auth){
               $errors = $this;
               $values = $request->getBody();
               $model = new Add;
               $items = $model->read("","","lastfirst");
               return $this->render("add","main",[
                    "errors" => $errors,
                    "values" => $values,
                    "items" => $items,
                    "auth" => $auth
               ]);
          }
        
      }

      if($request->isPost()){
          $validate = $this->validate($request->getBody(),[
               "add" => ["required",["max","max"=>255]],
               "category"=>["required"]
          ]);
          if($validate){
               $model = new Add();
               $model->body = $request->getBody()["add"];
               $model->category = $request->getBody()["category"];
               $model->create();
               Response::redirect("/add");
          }
      }
      $errors = $this;
      $values = $request->getBody();
      return $this->render("add","main",[
           "errors" => $errors,
           "values" => $values
      ]);
     }


     public function post(Request $request){
          $model = new Add();
          
          $item =  $model->read("id",$request->getBody()["id"]);
          return $this->render("post","main",[
               "item"=>$item,
          ]);
     }
}
   
 
        