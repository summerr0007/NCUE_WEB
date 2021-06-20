<?php
namespace app\models;

use mvcphp\base\Model;
use mvcphp\db\Db;

class Account extends Model
{
    protected $table = 'member';
    protected $primary = 'MemberId';

    public function checkaccount($account,$password){
        $sth = $this->where(["account = :account"],[':account' => $account])->fetch();
        $re = -1;
        if(!empty($sth)){
            if($password == $sth['password']){
                //return true;
                $re=$sth['MemberId'];
            }else{
                //return false;
                $re=-1;
            }
        }else{
            //return false;
            $re=-1;
        }        
        return $re;
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