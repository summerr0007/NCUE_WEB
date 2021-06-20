<?php
namespace app\controllers;

use mvcphp\base\Controller;
use app\models\Sold;

class SoldController extends Controller{
    public function soldlist()
    {
        $loginid = isset($_SESSION['loginid'])?$_SESSION['loginid']:false;
        $unlogin = true;
        $re = false;
        if($loginid){
            $unlogin =false;
            $re = (new Sold())->listall($loginid);
        }
        $this->assign('unlogin',$unlogin);
        $this->assign('result',$re);
        $this->render();
    }

    public function checkup(){
        $loginid = $_SESSION['loginid'];
        $re = (new Sold())->checkup($loginid);
        $this->render();
    }

    public function watchnow($ItemId){
        $loginid = $_SESSION['loginid'];
        $re =-1 ;
        if($loginid > 0){
            $re = (new Sold())->search($ItemId,$loginid);
            $re = empty($re)? 0:1;
        }
        echo $re;
    }
}