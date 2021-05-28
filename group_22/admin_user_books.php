<?php
    $page=7;
    include "admin_check.php";
?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="description" content=""> 
<meta name="author" content="">
<title>管理者頁面-關於退貨</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src = "https://code.jquery.com/jquery-3.6.0.min.js"> </script>
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/localization/messages_zh_TW.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script src="js/datatable_user_books.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="css/style.css">
<script> 
        var top1 = 0;
        $(document).ready(function(){
            let t1 = 0;
            let t2 = 0;
            let timer = null; // 定時器
            $(window).on("touchstart", function(){
                // 觸控開始
            })
            $(window).on("scroll", function(){
                // 滾動
                clearTimeout(timer)
                timer = setTimeout(isScrollEnd, 100)
                t1 = $(this).scrollTop()
            })
            function isScrollEnd() {
                t2 = $(window).scrollTop();
                if(t2 == t1){
                    if(t2>top1)
                    {
                        top1=t2;
                        $("nav").slideUp();
                    }
                    else if(t2<top1)
                    {
                        top1=t2;
                        $("nav").slideDown();
                    }
                    clearTimeout(timer)
                }
            }
        })
    </script>        
<style>
    .error {
        color: #D82424;
        font-weight: normal;
        display: inline;
        padding: 1px;
    }
</style>
</head>

<body>
    <?php include "header.php"; ?>
    <div style = "margin-top:50px"></div>
    <div class="container" >
    <div class="row">
    <?php include "left_side_admin.php"; ?>
        <div class="col-lg-10 text-center">
            <form class="form-horizontal form-inline" name="form_user_books" id="form_user_books" method="POST">
                <input type="hidden" name="oper" id="oper" value="insert">
                <input type="hidden" name="account_del" id="account_del" value="">
                <input type="hidden" name="g_id_del" id="g_id_del" value="">
                <input type="hidden" name="tmdorder_count" id="tmdorder_count" value="">
                <input type="hidden" name="quantity" id="quantity" value="">
                <div class="col-lg-12">
                    <table id="edit" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">購買者</th>
                                <th class="text-center">書籍ID</th>
                                <th class="text-center">申請退貨</th>
                                <th class="text-center">訂單編號</th>
                                <th class="text-center">存檔/取消</th>
                            </tr>
                        </thead>
                        <tbody>  
                            <tr>
                                <td class="text-center">
                                    <input type="text" id="account" name="account">
                                </td>
                                <td class="text-center">
                                    <input type="text" id="pid" name="pid">
                                </td>
                                <td class="text-center">
                                    <input type="text" id="apply_for_return" name="apply_for_return">
                                </td>
                                <td class="text-center">
                                    <input type="text" id="order_count" name="order_count">
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary btn-xs" id="btn-save">存檔</button><button type="reset" class="btn btn-danger btn-xs" id="btn-cancel">取消</button>
                                </td>
                            </tr>
                        </tbody>  
                    </table>
                </div>
                <div class="col-lg-12">
                    <table id="user_books" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">購買者</th>
                                <th class="text-center">書籍ID</th>
                                <th class="text-center">申請退貨</th>
                                <th class="text-center">訂單編號</th>
                                <th class="text-center">存檔/取消</th>  
                            </tr>
                        </thead>
                    </table>
                </div>
            </form>
        </div>
    </div>
    </div>
    
    <?php include "footer.php"; ?>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
</body>

</html>