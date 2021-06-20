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
        $this->assign('loginid',$_SESSION['loginid']);
        $this->render();
    }

    public function itemedit(){
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

        if ($keyword) {
            $items = (new Item())->search($keyword);
        } else {
            $items = (new Item)->where()->fetchAll();
        }

        $this->assign('loginid', $_SESSION['loginid']);
        $this->assign('title', '全部商品');
        $this->assign('keyword', $keyword);
        $this->assign('items', $items);
        $this->assign('thisurl',THISURL);
        //group_14  8
        $this->render();
    }

    public function additem(){
        $name = $_POST['name'];  
        $IMDb = $_POST['IMDb'];      
        $uploaddir = '/static/images/';
        $uploadfile = $uploaddir . $_FILES['pic']['name'];
        $filetemp = $_FILES['pic']['tmp_name'];
        $src = "images/".$_FILES['pic']['name'];
        $sthpic = (new Item())->addpic($filetemp,$uploadfile);
        $sth = (new Item())->add(["name"=>$name,"src"=>$src,"IMDb"=>$IMDb]);
        $this->assign("result",$sth);
        $this->render();        
    }

    public function delitem($id){
        $o = (new Item())->delete($id);
        $this->assign("result",$o);
        $this->render(); 
    }

    public function edititem(){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $IMDb = $_POST['IMDb']; 
        if($_FILES['pic']){
            $uploaddir = '/static/images/';
            $uploadfile = $uploaddir . $_FILES['pic']['name'];
            $filetemp = $_FILES['pic']['tmp_name'];
            $src = "images/".$_FILES['pic']['name'];
            $sthpic = (new Item())->addpic($filetemp,$uploadfile);
            $ok = (new Item())->where(['ItemId = :ItemId'],[':ItemId' => $id])->update(['name' => $name,"src"=>$src,"IMDb"=>$IMDb]);
        }else{
            $ok = (new Item())->where(['ItemId = :ItemId'],[':ItemId' => $id])->update(['name' => $name]);
        }        
        $this->assign("result",$ok);
        $this->render(); 
    }
}
