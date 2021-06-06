<?php
namespace app\controllers;

use mvcphp\base\Controller;
use app\models\Shopcar;

class ShopcarController extends Controller
{
    public function shopcar()
    {
        $this->assign('ttt','aaa');
        $this->render();
    }
}