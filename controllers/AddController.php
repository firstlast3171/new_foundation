<?php
namespace app\controllers;
use app\config\Controller;
use app\config\Request;
use app\config\Response;
use app\models\Add;

class  AddController extends Controller
{
     public function index(Request $request){
          if($request->isGet()){
               $errors = $this;
               $values = $request->getBody();
               return $this->render("add","main",[
                    "errors" => $errors,
                    "values" => $values
               ]);
          }
          if($request->isPost()){
               $validate = $this->validate($request->getBody(),[
                    "add" => ["required",["max","max"=>300]],
                    "category"=>["required"]
               ]);
               if($validate){
                $addModel = new Add();
                $addModel->body = $request->getBody()["add"];
                $addModel->category = $request->getBody()["category"];
                $addModel->create("Add");
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
}
   
 
        