<?php
namespace app\models;

use mvcphp\base\Model;
use mvcphp\db\Db;

class Sold extends Model
{
    protected $primary = 'SoldID';
    protected $table = 'sold';

    public function search($ItemID,$MemberID)
    {
        $sql = "select * from $this->table where ItemID=:ItemId and MemberID=:MemberID";
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [':ItemID' => "$ItemID",':MemberID' => "$MemberID"]);
        $sth->execute();
        return $sth->fetchAll();
    }
    
} 