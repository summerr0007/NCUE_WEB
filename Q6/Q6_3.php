<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> 公告張貼 </title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/localization/messages_zh_TW.js "></script>
    <script src="//jqueryvalidation.org/files/dist/additional-methods.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <link href="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"/>
    
    <script>
        $(document).ready(function ($) {
            $("#form1").validate({
                submitHandler: function (form) {
                    form.submit();
                },
                rules: {
                    to_1: {
                        require_from_group: [1, ".to_group"]
                    },
                    to_2: {
                        require_from_group: [1, ".to_group"]
                    },
                    to_3: {
                        require_from_group: [1, ".to_group"]
                    },
                    type: {
                        required: true
                    },
                    abstract: {
                        required: true
                    },
                    link: {
                        required: true,
                        url: true
                    },
                    content: {
                        required: true
                    },
                },
                messages: {
                    to_1: {
                        require_from_group: ""
                    },
                    to_2: {
                        require_from_group: ""
                    },
                    to_3: {
                        require_from_group: "請至少選擇1項"
                    }

                }
            });
        });
    </script>
    <style type="text/css">
        .error {
            color: red;
            font-weight: normal;
        }

        table {
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <form name="form1" id="form1" action="" method="POST">
        <table>
            <tr>
                <td class="c_title" width="110">公告對象：</td>
                <td class="c_content" width="420">
                    <input type="checkbox" class="to_group" name="to_1" <?php if(!empty($_POST['to_1'])){echo " checked";} ?> >教職員
                    <input type="checkbox" class="to_group" name="to_2" <?php if(!empty($_POST['to_2'])){echo " checked";} ?> >學生
                    <input type="checkbox" class="to_group" name="to_3" <?php if(!empty($_POST['to_3'])){echo " checked";} ?> >學校首頁
                    <label for="to_3" class="error">
                </td>
            </tr>
            <tr>
                <td class="c_title">公告類型：</td>
                <td class="c_content">
                    <input type="radio" name="type" value="1" <?php if(!empty($_POST['type'])){if($_POST['type'] == 1){echo " checked";}}?> >演講
                    <input type="radio" name="type" value="2" <?php if(!empty($_POST['type'])){if($_POST['type'] == 2){echo " checked";}}?> >研討會
                    <input type="radio" name="type" value="3" <?php if(!empty($_POST['type'])){if($_POST['type'] == 3){echo " checked";}}?> >徵才
                    <input type="radio" name="type" value="4" <?php if(!empty($_POST['type'])){if($_POST['type'] == 4){echo " checked";}}?> >招生、進修教育訓練
                    <input type="radio" name="type" value="5" <?php if(!empty($_POST['type'])){if($_POST['type'] == 5){echo " checked";}}?>>其他
                    <label for="type" class="error">
                </td>
            </tr>
            <tr>
                <td class="c_title">主旨：</td>
                <td class="c_content">
                    <input type="text" name="abstract" size="30" maxlength="30" value= <?php if(!empty($_POST['abstract'])){echo '"'. $_POST['abstract'].'"'; }?> >
                </td>
            </tr>
            <tr>
                <td class="c_title">公告截止日期：</td>
                <td class="c_content">
                    <select name="year">
                        <?php 
                            for($i = 101 ;$i <131;$i++){
                                echo " <option value='".$i."'";
                                if(!empty($_POST['year'])){
                                    if($_POST['year'] == $i+1911){
                                        echo " selected ";
                                    }
                                }else{
                                    if($i+1911 == date("Y")){
                                        echo " selected ";
                                    }
                                }                                
                                echo ">".$i."</option>";
                            }
                        ?>

                    </select>年
                    <select name="month">
                        <?php 
                            for($i = 1 ;$i <= 12;$i++){
                                echo " <option value='".$i."'";
                                if(!empty($_POST['month'])){
                                    if($i == $_POST['month']){
                                        echo " selected ";
                                    }
                                }else{
                                    if($i == date("m")){
                                        echo " selected ";
                                    }
                                }                                
                                echo ">".$i."</option>";
                            }
                        ?>

                    </select>月
                    <select name="day">
                        <?php 
                            for($i = 1 ;$i <= 31;$i++){
                                echo " <option value='".$i."'";
                                if(!empty($_POST['day'])){
                                    if($i == $_POST['day']){
                                        echo " selected ";
                                    }
                                }else{
                                    if($i == date("d")){
                                        echo " selected ";
                                    }
                                }                                
                                echo ">".$i."</option>";
                            }
                        ?>

                    </select>日
                </td>
            </tr>
            <tr>
                <td class="c_title">連接網址：</td>
                <td class="c_content">
                    <input type="text" name="link" size="20" value=<?php if(!empty($_POST['link'])){echo '"'. $_POST['link'].'"'; }?> >
                </td>
            </tr>
            <tr>
                <td class="c_title">公告內容：</td>
                <td class="c_content">
                    <textarea name="content" rows="5" cols="40"><?php if(!empty($_POST['content'])){echo $_POST['content']; }?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <button type="submit" class="c_button">確定送出</button>
                    <button type="reset" class="c_button">重新填寫</button>
                </td>
            </tr>
        </table>

    </form>
    <div <?php if(empty($_POST['abstract'])){ echo "style = 'display:none';";}?>>
        <table>
            <tr>
                <td class="c_title" width="110">公告對象：</td>
                <td class="c_content" width="420">
                    <?php 
                        if(!empty($_POST['to_1'])){
                            echo "教職員 ";
                        }
                        if(!empty($_POST['to_2'])){
                            echo "學生 ";
                        }
                        if(!empty($_POST['to_3'])){
                            echo "學校首頁 ";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="c_title">公告類型：</td>
                <td class="c_content">
                    <?php 
                        switch($_POST['type']){
                            case 1:
                                echo '演講';
                                break;
                            case 2:
                                echo '研討會';
                                break;
                            case 3:
                                echo '徵才';
                                break;
                            case 4:
                                echo '招生、進修教育訓練';
                                break;
                            case 5:
                                echo '其他';
                                break;

                        }
                    ?>
                    <label for="type" class="error">
                </td>
            </tr>
            <tr>
                <td class="c_title">主旨：</td>
                <td class="c_content">
                    <?php echo $_POST['abstract'] ?>
                </td>
            </tr>
            <tr>
                <td class="c_title">公告截止日期：</td>
                <td class="c_content">
                    <?php 
                        echo $_POST['year']." 年";
                        echo $_POST['month']." 月";
                        echo $_POST['day']." 日";
                    ?>
                </td>
            </tr>
            <tr>
                <td class="c_title">連接網址：</td>
                <td class="c_content">
                    <a href = <?php echo '"'. $_POST['link'].'"' ?> ><?php echo $_POST['link'] ?> </a>
                    
                </td>
            </tr>
            <tr>
                <td class="c_title">公告內容：</td>
                <td class="c_content">
                    <?php echo $_POST['content'] ?>
                </td>
            </tr>

        </table>
    </div>

</body>

</html>