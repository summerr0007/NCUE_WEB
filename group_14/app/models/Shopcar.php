<?php
namespace app\models;

use mvcphp\base\Model;
use mvcphp\db\Db;

class Shopcar extends Model
{
    protected $primary = 'ShopcarId';
    protected $table = 'shopcar';

    public function search($MemberId)
    {
        $sql = "select shopcar.ShopcarId,item.name from shopcar inner join item on shopcar.ItemId  = item.ItemId where MemberId = :MemberId";
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [':MemberId' => $MemberId]);
        $sth->execute();
        return $sth->fetchAll();
    }
    
} 