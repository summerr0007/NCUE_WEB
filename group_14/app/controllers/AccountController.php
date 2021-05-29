<?php
namespace app\controllers;

use mvcphp\base\Controller;
use app\models\Account;

class AccountController extends Controller
{
    public function login(){
        $account = isset($_POST['account']) ? $_POST['account'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $error="";
        if($account){
            $ok = (new Account())->checkaccount($account,$password);
            if($ok){   
                // session_start();             
                $_SESSION['login'] = $_POST['account'];
            }else{
                // session_start();
                $_SESSION['login'] = '';
                $error="帳號或密碼錯誤";
            }
        }      
        $this -> assign('error',$error);
        $this -> render();
    }

    public function logout(){
        // session_start();
        $_SESSION['login'] = '';
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
    public function index(){
        $this -> render(); 
    }
}