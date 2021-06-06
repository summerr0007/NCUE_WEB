<?php
    $rows="";
    $row="";
    $now_bill="";
    $sum = 0;
    $today = date('Ymd');
    session_start();
    // 送出編碼的MySQL指令
    include "link.php";
    //撈出當前是哪個訂單
    $sql = "select bill from members where account = '".$_SESSION['user_id']."'";
    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $now_bill = $row["bill"];
        }
        mysqli_free_result($result); // 釋放佔用的記憶體   
    }

    if(isset($_POST['item_id'])&&isset($_POST['item_order'])&&isset($_POST['item_text'])&&isset($_POST['item_star']))
    {
        if(!$_POST['item_text']=="")
        {
            $sql = "insert into reviews(pid,account,review) values('".$_POST['item_id']."','".$_SESSION['user_id']."','".$_POST['item_text']."')";
            mysqli_query($link, $sql);
        }
        $sql = "update order_form set comment = 1 where order_count = '".$_POST['item_order']."' and
                members_id = '".$_SESSION['user_id']."' and
                commodity_id = '".$_POST['item_id']."'";
        mysqli_query($link, $sql);
        $sql = "update commodity set star = star+".$_POST['item_star']." where pid = '".$_POST['item_id']."'";
        mysqli_query($link, $sql);
        $sql = "update commodity set star_count = star_count+1 where pid = '".$_POST['item_id']."'";
        mysqli_query($link, $sql);
        mysqli_close($link);        
    }

    if(isset($_POST['check_id']))
    {
        $sql = "select apply_for_return from order_form where 
                order_form.members_id = '".$_SESSION['user_id']."' and 
                order_form.commodity_id = '".$_POST['check_id']."'and
                order_form.order_count = '".$now_bill."'";
        if ($result = mysqli_query($link, $sql)) {
            $row = mysqli_fetch_assoc($result);
            $check=$row["apply_for_return"];
            mysqli_free_result($result); // 釋放佔用的記憶體
        }
        if($check==0)
            $check=1;
        else
            $check=0;
        $sql = "update order_form set apply_for_return = $check where
                order_form.members_id = '".$_SESSION['user_id']."' and 
                order_form.commodity_id = '".$_POST['check_id']."'and
                order_form.order_count = '".$now_bill."'";
        mysqli_query($link, $sql);         
    }

    // 若增加商品(收到add_num)
    if(isset($_GET['add_id'])&&isset($_GET['add_num'])&&isset($_GET['add_type']))
    {
        $sql = "select quantity,stock from order_form,members,commodity where 
                order_form.members_id = '".$_SESSION['user_id']."' and 
                order_form.commodity_id = '".$_GET['add_id']."'and
                order_form.order_count = '".$now_bill."'and
                commodity.pid = '".$_GET['add_id']."'";           
        if ($result = mysqli_query($link, $sql)) {
            $row = mysqli_fetch_assoc($result);
            if($row!=null&&(intval($_GET['add_num'])<=intval($row['stock'])||$_GET['add_type']!=3))
            {
                $rows = $row["quantity"];//此處rows變數拿來抓數量
                $new_quan=intval($_GET['add_num'])+intval($rows);
                
                $sql = "update order_form set quantity = '".$new_quan."' where 
                        order_form.members_id = '".$_SESSION['user_id']."' and 
                        order_form.order_count = '".$now_bill."' and 
                        order_form.commodity_id = '".$_GET['add_id']."'";
                mysqli_query($link, $sql);
                mysqli_free_result($result); // 釋放佔用的記憶體
                //修改庫存
                $sql = "update commodity set stock = stock - ".$_GET['add_num']." where commodity.pid = '".$_GET['add_id']."'";
                mysqli_query($link, $sql);             
            }
            else if($row!=null&&intval($_GET['add_num'])>intval($row['stock'])&&$_GET['add_type']==3)//種類三為在購物車內的加法
            {
                // header("location: shop_cart.php");
            }
            else{
                $sql = "insert into order_form(commodity_id,members_id,order_count,	quantity) 
                        values ('".$_GET['add_id']."','".$_SESSION['user_id']."',$now_bill,".$_GET['add_num'].")";
                $result = mysqli_query($link, $sql);
                //修改庫存
                $sql = "update commodity set stock = stock - ".$_GET['add_num']." where commodity.pid = '".$_GET['add_id']."'";
                mysqli_query($link, $sql);            
            }


        }
        // if($_GET['add_type']==0)
        //     echo "<script>history.back(-1)</script>";
        // else
        //     header("location: shop_cart.php");

    }
    if(isset($_GET['remove_id']))
    {
        //修改庫存
        $sql = "select quantity from order_form where 
                members_id = '".$_SESSION['user_id']."' and 
                order_count = '".$now_bill."' and 
                commodity_id = '".$_GET['remove_id']."'";
        if ($result = mysqli_query($link, $sql)) {
            $row = mysqli_fetch_assoc($result);
            $new_quan=$row["quantity"];
            mysqli_free_result($result); // 釋放佔用的記憶體
        }
        $sql = "update commodity set stock = stock + ".$new_quan." where commodity.pid = '".$_GET['remove_id']."'";
        mysqli_query($link, $sql);

        $sql = "delete from order_form where commodity_id = '".$_GET['remove_id']."' and 
                members_id = '".$_SESSION['user_id']."' and
                order_count = '".$now_bill."'";
        mysqli_query($link, $sql);
        // header("location: shop_cart.php"); 
    }



    if(isset($_GET['add_id'])&&isset($_GET['cart_icon'])&&$_GET['cart_icon']==1)
    {
        $sql = "select stock from commodity where pid = '".$_GET['add_id']."'";
        if ($result = mysqli_query($link, $sql)) {
        $row = mysqli_fetch_assoc($result);

        if($row["stock"]>0)
            echo'<i class="fa fa-cart-plus fa-lg" onclick="nav_slide();cart_1('.$_GET['add_id'].',1)"></i>';
        else{echo'<i class="fas fa-times-circle"></i>';}  
        mysqli_free_result($result); // 釋放佔用的記憶體
        }
    }
    else if(isset($_GET['cart_count'])&&$_GET['cart_count']==1)
    {
        $row="";
        $cart_count=0;
        // $link = mysqli_connect('localhost','root','root123456','group_22')
        // or die("無法開啟MySQL資料庫連結!<br>");
        // mysqli_query($link, 'SET CHARACTER SET utf8');
        // mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
        //$sql = "select commodity_id from order_form where members_id = '".$_SESSION['user_id']."' and time = 0";
        // $result = mysqli_query($link, $sql);
        // $cart_count = $result['count'];
        // if ($result = mysqli_query($link, $sql)) {
        //     while ($row = mysqli_fetch_assoc($result)) {
        //         $cart_count+=1;
        //     }
        //     echo '購物車(';echo $cart_count ; echo')';
        //      mysqli_free_result($result); // 釋放佔用的記憶體   
        // }  
        $sql = "select count(commodity_id) as total from order_form where members_id = '".$_SESSION['user_id']."' and time = 0";
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($result);
        $cart_count = $row['total'];
        echo '購物車(';echo $cart_count ; echo')';
    }

    else if(isset($_GET['add_type'])&&$_GET['add_type']==0)
    {
        $sql = "select stock from commodity where pid = '".$_GET['add_id']."'";
        if ($result = mysqli_query($link, $sql)) {
        $row = mysqli_fetch_assoc($result);
        echo'<h4>
            庫存:&ensp;';echo $row["stock"];
        echo'
        </h4> 
        <h3>
            <button class="btn btn-'; echo ($row["stock"]<=0) ? "secondary":"primary"; echo'" onClick="is_add(';
                echo "'";echo$_GET['add_id'];echo"'"; echo",  document.getElementById('num').value,";echo '1,0)"';
                 if($row["stock"]<=0) echo 'disabled="disabled"'; echo'type="button">
                <i class="fa fa-cart-plus fa-lg"></i>';
                
            echo ($row["stock"]<=0) ? "尚無庫存": "加入購物車" ;
            echo'
            </button>
            <button class="btn btn-'; echo ($row["stock"]<=0) ? "secondary":"danger"; echo'" onClick="is_add(';
                 echo "'";echo$_GET['add_id'];echo"'";echo",  document.getElementById('num').value,"; echo '1 ,1)"';
                 if($row["stock"]<=0) echo 'disabled="disabled"'; echo'type="button">';
                
                
            echo ($row["stock"]<=0) ? "尚無庫存": "直接購買" ;
            echo'
            </button>                            
        </h3>
        ';
        mysqli_free_result($result); // 釋放佔用的記憶體
        }
    }
    else
    {
        //撈出當前訂單的所有商品項目
        $sql = "select file_name, name, price, quantity, pid, apply_for_return from order_form, commodity where 
                order_count = '".$now_bill."' and order_form.commodity_id = commodity.pid
                and members_id = '".$_SESSION['user_id']."'";
        if($result = mysqli_query($link,$sql))
        {
            $disable=true;
            $sum = 0;
            $rows = "";
            while($row = mysqli_fetch_assoc($result))
            {
                if($row['apply_for_return']==0)
                {
                    $check="checked";
                    $disable=false;
                }
                else
                    $check="";
                $rows.="<tr>
                        <td><div class='form-group form-check'><input type='checkbox' class='form-check-input' id='".$row['pid']."'".$check." onChange='is_check(".$row['pid'].")' ></div></td>
                        <td><a href='item.php?item_id=".$row['pid']."'><img src='images/".$row['file_name']."'  style='height:80px;' alt='no img'/></a></td>
                        <td><a href='item.php?item_id=".$row['pid']."'>".$row['name']."</a></td>
                        <td class='text-right'>$".$row['price']."</td>
                        <td>
                            <div class='input-group col-lg-6 offset-lg-6'>
                                <button class='btn btn-outline-secondary' type='button' onclick='is_change(".$row['pid'].",-1,".$row['quantity'].")'>-</button>
                                <input type='text' class='form-control' value=".$row['quantity']." id='num' style='text-align:center'  onChange=".'"'."is_change(".$row['pid'].",document.getElementById('num').value-".$row['quantity'].",".$row['quantity'].")".'"'.">
                                <button class='btn btn-outline-secondary' type='button' onclick='is_change(".$row['pid'].",1,".$row['quantity'].")'>+</button>
                            </div>
                        </td>
                        <td class='text-right'><button class='btn btn-sm btn-danger' onClick='is_remove(".$row['pid'].")'>X</button></td>
                        </tr>";     
                $sum += $row['price'] * $row['quantity'];
            }
            mysqli_free_result($result);
        }

        mysqli_close($link); // 關閉資料庫連結
        
        echo'
        <div class="table-responsive">
        ';
        if($rows=="")
            echo "
            <div style = 'margin-top:100px'></div>
            <p Align=center><img src='images/shop_cart_none.jpg' style='height:200px;' alt='no img'></p>
                <h2 style='color:#D68B00;text-align:center;'>購物車內空空如也!!</h2>
                ";
        else
        {
            echo'
            <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">勾選</th>
                    <th scope="col">商品圖片</th>
                    <th scope="col">品名</th>
                    <th scope="col" class="text-right">價格</th>
                    <th scope="col" class="text-right">數量&emsp;</th>
                    <th scope="col" class="text-right">移除此商品</th>
                </tr>
            </thead>
            <tbody>';
                echo    $rows;
                echo'
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>加總</td>
                    <td class="text-right">$';
                            echo $sum; 
                            echo'
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>運費</td>
                    <td class="text-right">$
                        60
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>總價錢</strong></td>
                    <td class="text-right"><strong>$';
                                echo $sum + 60; echo'</strong></td>
                </tr>
            </tbody>
        </table>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <button class="btn btn-block btn-light" onClick="redir(';echo"'";echo"index','',";echo '0)">繼續購物</button>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <button class="btn btn-lg btn-block btn-success text-uppercase"';if($disable)echo'disabled="disabled"';echo'onClick="checkout('; echo $today; echo','; echo $now_bill; echo ')">送出訂單</button>
                </div>
            </div>
        </div>        
        ';
        }
    }

?>