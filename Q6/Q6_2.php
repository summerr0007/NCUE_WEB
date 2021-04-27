<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <!--additional method - for checkbox .. ,require_from_group method ...-->
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    <link href="post_style.css" rel="stylesheet" type="text/css" />
    <title>Q6_2</title>
    <style>
        textarea {
            overflow-y: scroll;
        }

        td {
            border: 1px solid #000;
        }
    </style>
    <script>
        // $.validator.setDefaults({
        //     submitHandler: function () {
        //         alert("提交!");
        //     }
        // });
        $().ready(
            function () {
                $("form").validate({
                    rules: {
                        name: {
                            required: true
                        },
                        date: {
                            required: true
                        },
                        what: {
                            required: true
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        "hobby[]": {
                            minlength: 2
                        }
                    },
                    messages: {

                    }

                })


            }
        );
    </script>
</head>

<body>
    <div>
        <form name="f1" action="" method="POST" >
            <table>
                <caption>
                    會員基本資料填寫
                </caption>
                <tr>
                    <td>姓名:</td>
                    <td>
                        <input type="text" name="name" value = <?php if(!empty($_POST['name'])){echo $_POST['name'];} ?> >
                    </td>
                </tr>
                <tr>
                    <td>
                        生日:
                    </td>
                    <td>
                        <input id="date" type="date" name="date" value = <?php if(isset($_POST['date'])){echo  $_POST['date'];}?>>
                    </td>
                </tr>
                <tr>
                    <td>性別:</td>
                    <td>
                        <input type="radio" name="what" value="1" <?php if(isset($_POST['what'])){if($_POST['what'] == 1){echo "checked";}}?> >男
                        <input type="radio" name="what" value="2" <?php if(isset($_POST['what'])){if($_POST['what'] == 2){echo "checked";}}?> >女

                    </td>
                </tr>
                <tr>
                    <td>興趣:</td>
                    <td>
                        <input type="checkbox" name="hobby[]" value="1" <?php if(!empty($_POST['hobby'])){if(in_array("1",$_POST['hobby'])){ echo "checked";}} ?> >游泳
                        <input type="checkbox" name="hobby[]" value="2" <?php if(!empty($_POST['hobby'])){if(in_array("2",$_POST['hobby'])){ echo "checked";}} ?> >慢跑
                        <input type="checkbox" name="hobby[]" value="3" <?php if(!empty($_POST['hobby'])){if(in_array("3",$_POST['hobby'])){ echo "checked";}} ?> >打網球
                        <input type="checkbox" name="hobby[]" value="4" <?php if(!empty($_POST['hobby'])){if(in_array("4",$_POST['hobby'])){ echo "checked";}} ?> >打籃球
                        <input type="checkbox" name="hobby[]" value="5" <?php if(!empty($_POST['hobby'])){if(in_array("5",$_POST['hobby'])){ echo "checked";}} ?> >爬山
                    </td>
                </tr>
                <tr>
                    <td>
                        email:
                    </td>
                    <td>
                        <input type="text" name="email" value = <?php if(!empty($_POST['email'])){echo $_POST['email'];} ?> >
                    </td>
                </tr>
                <tr>
                    <td>
                        照片上傳:
                    </td>
                    <td>
                        <input type="file">
                    </td>
                </tr>
                <tr>
                    <td>
                        自我介紹:
                    </td>
                    <td>
                        <textarea name="content" rows="10" cols="40"><?php if(!empty($_POST['email'])){echo $_POST['email'];} ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center">
                        <input type="submit" value="確定送出" class="c_button">

                    </td>
                </tr>
            </table>
        </form>
    </div>
    
    <div <?php if(empty($_POST['name'])){ echo "style = 'display:none';";}?> >
        <table>
            <caption>
                會員基本資料填寫
            </caption>
            <tr>
                <td>姓名:</td>
                <td>
                    <?php echo $_POST['name'] ?>
                </td>
            </tr>
            <tr>
                <td>
                    生日:
                </td>
                <td>
                    <?php 
                        $date = strtotime($_POST['date']);
                        $newDate = date('Y年m月d日',$date);
                        echo $newDate;
                    ?>
                </td>
            </tr>
            <tr>
                <td>性別:</td>
                <td>
                    <?php if($_POST['what'] == 1){echo "男"; }?>
                    <?php if($_POST['what'] == 2){echo "女"; }?>
                </td>
            </tr>
            <tr>
                <td>興趣:</td>
                <td>
                    <?php
                        // echo implode(",",$_POST['hobby']);
                        foreach( $_POST['hobby'] as $i){
                            switch($i){
                                case 1:
                                    echo "游泳 ";
                                    break;
                                case 2:
                                    echo "慢跑 ";
                                    break;
                                case 3:
                                    echo "打網球 ";
                                    break;
                                case 4:
                                    echo "打籃球 ";
                                    break;
                                case 5:
                                    echo "爬山 ";
                                    break;

                            }
                        }
                    ?>
                    
                    <!-- <input type="checkbox" name="hobby[]" value="游泳">游泳
                    <input type="checkbox" name="hobby[]" value="慢跑">慢跑
                    <input type="checkbox" name="hobby[]" value="打網球">打網球
                    <input type="checkbox" name="hobby[]" value="打籃球">打籃球
                    <input type="checkbox" name="hobby[]" value="爬山">爬山 -->
                </td>
            </tr>
            <tr>
                <td>
                    email:
                </td>
                <td>
                    <?php echo $_POST['email'] ?>
                </td>
            </tr>
            <tr>
                <td>
                    自我介紹:
                </td>
                <td>

                    <?php echo $_POST['content'] ?>
                </td>
            </tr>

        </table>
    </div>
</body>

</html>