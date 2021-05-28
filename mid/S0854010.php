<?php
//姓名：鐘子敬(S0854010)
//作答情形:
//1: 沒有美化
//2： 基本都有
//3： 不會在最下面顯示
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/localization/messages_zh_TW.js "></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <title>S0854010</title>

    <script>
        $(function () {
            $('[name="know"]').change(function () {
                if ($('[name="know"][value="1"]').prop("checked"))
                    $(".two").hide();
                else
                    $(".two").show();
            });

        });

        $().ready(
            function () {
                $("form").validate(
                    {
                        submitHandler: function (Form1) {
                            if ($('[name="type"][value="2"]').prop("checked") && $('.typetext').value() !="") {
                                if ($('[name="hobby[]"][value="2"]').prop("checked") && $('.typetext').value() != "") {
                                    Form1.submit();
                                } else {
                                    $('[for="hobby[]"]').append("(請輸入說明文字!!)");
                                }

                            } else {
                                $('[for="type"]').append("(請輸入說明文字!!)");
                            }

                        }
                    ,
                        rules: {
                            know: {
                                required: true
                            },
                            type: {
                                required: true
                            },
                            "hobby[]": {
                                required: true,
                                minlength: 1,
                                maxlength: 3
                            }
                        }
                    ,
                        messages: {
                            know: {
                                required: "(此題為必填!!)"
                            },
                            type: {
                                required: "(此題為必填!!)"
                            },
                            "hobby[]": {
                                required: "(請選擇 1個 至 3個 選項)",
                                minlength: "",
                                maxlength: "(請選擇 1個 至 3個 選項)"
                            }
                        }
                    }
                );
            }
        );
    </script>
</head>

<body>
    <div>
        <form name="Form1" action="" method="POST">
            <div>
                <select name="year">
                    <?php 
                for($i = 90 ;$i < date("Y")-1910;$i++){
                    echo " <option value='".$i."'";
                    if(!empty($_POST['year'])){
                        if($_POST['year'] == $i){
                            echo " selected ";
                        }
                    }else{
                        if($i == date("Y") -1911){
                            echo " selected ";
                        }
                    }                                
                    echo ">".$i."</option>";
                }
                ?>
                </select>年 學年度教師多元升等線上問卷
            </div>
            <div>* 1. 學校教師對本校多元升等制度了解程度：</div>
            <div>
                <input type="radio" name="know" value="1"
                    <?php if(!empty($_POST['know'])){if($_POST['know'] == 1){echo " checked";}}?>>非常不了解
                <input type="radio" name="know" value="2"
                    <?php if(!empty($_POST['know'])){if($_POST['know'] == 2){echo " checked";}}?>>不了解
                <input type="radio" name="know" value="3"
                    <?php if(!empty($_POST['know'])){if($_POST['know'] == 3){echo " checked";}}?>>普通
                <input type="radio" name="know" value="4"
                    <?php if(!empty($_POST['know'])){if($_POST['know'] == 4){echo " checked";}}?>>了解
                <input type="radio" name="know" value="5"
                    <?php if(!empty($_POST['know'])){if($_POST['know'] == 5){echo " checked";}}?>>非常了解
                <label for="know" class="error">
            </div>
            <div class="two">* 2. 教師如欲進行升等，會優先選擇：</div>
            <div class="two">
                <input type="radio" name="type" value="1"
                    <?php if(!empty($_POST['type'])){if($_POST['type'] == 1){echo " checked";}}?>>新制
                <input type="radio" name="type" value="2"
                    <?php if(!empty($_POST['type'])){if($_POST['type'] == 2){echo " checked";}}?>>舊制，請說明原因:
                <input type="text" name="typetext" size="20" maxlength="20"
                    value=<?php if(!empty($_POST['typetext'])){echo '"'. $_POST['typetext'].'"'; }?>>(限 20 字以內)
                <label for="type" class="error">
            </div>

            <div>* 3. 教師希望本校辦理哪些關於多元升等制度的活動（可複選）：</div>
            <div>
                <input type="checkbox" name="hobby[]" value="1"
                    <?php if(!empty($_POST['hobby'])){if(in_array("1",$_POST['hobby'])){ echo "checked";}} ?>>說明會
                <input type="checkbox" name="hobby[]" value="2"
                    <?php if(!empty($_POST['hobby'])){if(in_array("2",$_POST['hobby'])){ echo "checked";}} ?>>分享會
                <input type="checkbox" name="hobby[]" value="3"
                    <?php if(!empty($_POST['hobby'])){if(in_array("3",$_POST['hobby'])){ echo "checked";}} ?>>研討會
                <input type="checkbox" name="hobby[]" value="4"
                    <?php if(!empty($_POST['hobby'])){if(in_array("4",$_POST['hobby'])){ echo "checked";}} ?>>其他:
                <input type="text" name="hobbytext" size="20" maxlength="20"
                    value=<?php if(!empty($_POST['hobbytext'])){echo '"'. $_POST['hobbytext'].'"'; }?>>(限 20 字以內)
                <label for="hobby[]" class="error">
                    <!-- <div>(請選擇 1個 至 3個 選項)</div> -->

            </div>
            <div>4. 教師對於本校多元升等制度有哪些建議：</div>
            <div>
                <textarea name="content" rows="5" cols="40"
                    maxlength="20"><?php if(!empty($_POST['content'])){echo $_POST['content']; }?></textarea>
                <div>(限 20 字以內)</div>
                <label for="content" class="error">
            </div>
            <div>
                <button type="submit" class="c_button">送出問卷</button>
            </div>

        </form>
    </div>
    <?php
        //
    ?>
</body>

</html>