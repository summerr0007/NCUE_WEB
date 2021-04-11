<?php
    $string = file_get_contents("acc.json");
    $oj = json_decode($string);
    $ar = array('status' => 'account error');
    foreach ($oj->acc as $value)
    {
        if($value->name == $_POST["name"]){
            if($value->passwd == $_POST["passwd"]){
                $ar['status'] = 'success';
                break;
            }else{
                $ar['status'] = 'passwd_error';                
            }
        }
    } 
    echo json_encode($ar);   
?>