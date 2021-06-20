<?php
namespace app\models;

use mvcphp\base\Model;
use mvcphp\db\Db;

class Comment extends Model
{
    protected $primary = 'CommentId';
    protected $table = 'comment';

    public function show($itemid)
    {
        $sql = "select comment.*,member.account from comment inner join member on comment.MemberId = member.MemberId where ItemId=:ItemId ";
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [':ItemId' => "$itemid"]);
        $sth->execute();
        return $sth->fetchAll();
    }
} 