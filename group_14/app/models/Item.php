<?php
namespace app\models;

use mvcphp\base\Model;
use mvcphp\db\Db;

/**
 * 用户Model
 */
class Item extends Model
{
    protected $table = 'item';
    protected $primary = 'ItemId';
    
    public function search($keyword)
    {
        $sql = "select * from `$this->table` where `item_name` like :keyword";
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [':keyword' => "%$keyword%"]);
        $sth->execute();

        return $sth->fetchAll();
    }

    

    public function addpic($filetemp,$uploadfile){
        if(move_uploaded_file($filetemp, getcwd().$uploadfile)){
            return true;
        }else{
            print_r($_FILES);
            return false;
        }
    }
}