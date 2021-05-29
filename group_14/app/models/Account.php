<?php
namespace app\models;

use mvcphp\base\Model;
use mvcphp\db\Db;

class Account extends Model
{
    protected $table = 'member';

    public function checkaccount($account,$password){
        $sth = $this->where(["account = :account"],[':account' => $account])->fetch();
        if(!empty($sth)){
            if($password == $sth['password']){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }        
    }

    public function register($data){
        $sth=$this->add($data);
        if($sth >0){
            return true;
        }else{
            return false;
        }
    }
}