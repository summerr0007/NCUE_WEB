<?php
    $string = file_get_contents("acc.json");
    $oj = json_decode($string);
    $ar = array('status' => 'success');
    $ok = true; 
    foreach ($oj->acc as $value)
    {
        if($value->name == $_POST["name"]){
            $ar['status'] = 'duplicate_account';
            $ok = false; 
            break;
        }       
    } 
    if($ok){
        $new = [
            'name'=>$_POST["name"],
            'passwd'=>$_POST["passwd"]
        ];
        array_push($oj->acc,$new);
        file_put_contents("acc.json", json_encode($oj));
    }
    echo json_encode($ar);   
?>