<?php   
namespace app\controllers;

use mvcphp\base\Controller;
use app\models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

        if ($keyword) {
            $items = (new Item())->search($keyword);
        } else {
            // 查询所有内容，并按倒序排列输出
            // where()方法可不传入参数，或者省略
            $items = (new Item)->where()->fetchAll();
        }

        $thisurl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

        $this->assign('title', '全部商品');
        $this->assign('keyword', $keyword);
        $this->assign('items', $items);
        $this->assign('thisurl',substr($thisurl,0,strpos($thisurl,"group_14")+9));
        //group_14  8
        $this->render();
    }

    public function detail($id)
    {
        // 通过?占位符传入$id参数
        $item = (new Item())->where(["id = ?"], [$id])->fetch();

        $thisurl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        
        $this->assign('title', '条目详情');
        $this->assign('item', $item);
        $this->assign('thisurl',substr($thisurl,0,strpos($thisurl,"group_14")+9));
        $this->render();
    }
}
