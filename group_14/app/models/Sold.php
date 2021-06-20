<?php
namespace app\models;

use mvcphp\base\Model;
use mvcphp\db\Db;

class Sold extends Model
{
    protected $primary = 'Soldid';
    protected $table = 'sold';

    public function search($ItemId,$MemberId)
    {
        $sql = "select * from $this->table where ItemId=:ItemId and MemberId=:MemberId";
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [':ItemId' => "$ItemId",':MemberId' => "$MemberId"]);
        $sth->execute();
        return $sth->fetchAll();
    }

    public function listall($MemberId){
        $sql = "select sold.*,item.name from sold inner join item on sold.ItemId  = item.ItemId where MemberId=:MemberId ";
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [':MemberId' => "$MemberId"]);
        $sth->execute();
        return $sth->fetchAll();
    }
    
    public function checkup($MemberId){
        $sql = "insert into sold(MemberId,ItemId) (select MemberId,ItemId from shopcar where MemberId = :MemberId)";
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [':MemberId' => "$MemberId"]);
        $sth->execute();
        return $sth->rowCount();
    }
    
} 