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
            $items = (new Item)->where()->fetchAll();
        }

        
        $this->assign('title', '全部商品');
        $this->assign('keyword', $keyword);
        $this->assign('items', $items);
        $this->assign('thisurl',THISURL);
        //group_14  8
        $this->render();
    }

    public function detail($id)
    {
        $item = (new Item())->where(["ItemId = ?"], [$id])->fetch();
        
        $this->assign('id', $id);
        $this->assign('item', $item);
        $this->assign('thisurl',THISURL);
        $this->render();
    }
}
