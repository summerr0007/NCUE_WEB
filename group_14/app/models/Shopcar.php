<?php
namespace app\models;

use mvcphp\base\Model;
use mvcphp\db\Db;

class Shopcar extends Model
{
    protected $primary = 'ShopcarID';
    protected $table = 'shopcar';

    public function search($keyword)
    {
        $sql = "select shopcar.ShopcarID,item.name from shopcar inner join item on shopcar.ItemID  = item.ItemId where (select MemberId from member where account = :keyword)";
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [':keyword' => "$keyword"]);
        $sth->execute();
        return $sth->fetchAll();
    }
    
} 