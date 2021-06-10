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
}