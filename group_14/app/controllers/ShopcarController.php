<?php

namespace app\controllers;


use mvcphp\base\Controller;
use app\models\Shopcar;


class ShopcarController extends Controller
{
    public function shopcar()
    {

        if (!empty($_SESSION['login'])) {
            $account = $_SESSION['login'];
            $itemsInCar = (new Shopcar())->search($account);
            $this->assign("itemsInCar", json_encode($itemsInCar));
        } else {
            $this->assign("unlogin", true);
        }
        $this->render();
    }

    public function remove($shopcarid)
    {
        $account = $_SESSION['login'];
        $o = new Shopcar();
        $o->delete($shopcarid);
        $e = $o->search($account);
        foreach ($e as $ex) {
            echo json_encode($ex) . ",,";
        }
    }

    public function AddCar($itemID)
    {
        $loginid = $_SESSION['loginid'];
        $data['MemberId'] = $loginid;
        $data['ItemID'] = $itemID;
        if ($loginid > 0) {
            $a = (new Shopcar())->add($data);
            if ($a) {
                $oktext = '成功加入購物車';
            } else {
                $oktext = '加入購物車失敗';
            }
        }else{
            $oktext = '請先登入';
        }

        echo $oktext;
    }
}
