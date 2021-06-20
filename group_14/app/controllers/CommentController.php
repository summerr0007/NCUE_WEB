<?php

namespace app\controllers;


use mvcphp\base\Controller;
use app\models\Comment;

class CommentController extends Controller
{
    public function show($id){
        $re = (new Comment())->show($id);
        foreach ($re as $ex) {
            echo json_encode($ex) . ",,";
        }
    }

    public function add(){
        $ItemId = $_POST['itemid'];
        $MemberId = $_POST['memberid'];
        $Comment = $_POST['comment'];
        $re = (new Comment())->add(["ItemId"=> $ItemId,"MemberId"=>$MemberId,"Comment"=>$Comment]);
        $re = (new Comment())->show($ItemId);
        foreach ($re as $ex) {
            echo json_encode($ex) . ",,";
        }
    }
}