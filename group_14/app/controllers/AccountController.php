<?php
namespace app\controllers;

use mvcphp\base\Controller;
use app\models\Account;

class AccountController extends Controller
{
    public function login(){
        $account = isset($_POST['account']) ? $_POST['account'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $unlogin = !empty($_SESSION['login'])? false : true;
        $error="";

        if($unlogin){
            if($account){
                $ok = (new Account())->checkaccount($account,$password);
                if($ok > 0){   
                    // session_start();             
                    $_SESSION['login'] = $_POST['account'];
                    $_SESSION['loginid'] = $ok;
                    $unlogin=false;
                }else{
                    // session_start();
                    $_SESSION['login'] = '';
                    $_SESSION['loginid'] = '';
                    $error="帳號或密碼錯誤";
                }
            }
        }
        $this -> assign('unlogin',$unlogin);
        $this -> assign('error',$error);
        $this -> render();
    }

    public function logout(){
        // session_start();
        $_SESSION['login'] = '';
        $_SESSION['loginid'] = '';
        $this -> assign('logout','byd bye');
        $this -> render();
    }

    public function register(){
        $account = isset($_POST['account']) ? $_POST['account'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $oktext="";
        if($account && $password){
            $data['account'] = $account;
            $data['password'] = $password;
            $sth = (new Account)->register($data);
            if($sth){
                $oktext = '註冊成功';
            }
            else{
                $oktext = '註冊失敗';
            }
        }

        $this->assign('oktext',$oktext);
        $this -> render();      
    }

    public function edit(){
        $unlogin = true;
        $ok ='';
        if(!empty($_SESSION['loginid'])){
            $unlogin = false;
            $loginid = $_SESSION['loginid'];
            if(!empty($_POST['passwd'])){
                $data = array('password' => $_POST['passwd']);
                $re = (new Account())->where(['MemberId = :MemberId'],[':MemberId' => $loginid])->update($data);
                $ok = "修改成功";
            }
        }else{
            $unlogin = true;
        }
        $this->assign('ok',$ok);
        $this->assign('unlogin',$unlogin);
        $this -> render(); 
    }

    public function index(){
        $this -> render(); 
    }

    public function admin(){
        $items = (new Account)->where()->fetchAll();
        $this->assign('items', $items);
        $this -> render(); 
    }

    public function delacc($id){
        $o = (new Account())->delete($id);
        $this->assign("result",$o);
        $this->render(); 
    }

    public function addacc(){
        $account = isset($_POST['account']) ? $_POST['account'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $data['account'] = $account;
        $data['password'] = $password;
        $sth = (new Account)->register($data);
        $this->assign("result",$sth);
        $this->render(); 
    }
}