<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link href="styles.css" rel="stylesheet" type="text/css" />
    <title>register</title>
    <script>
        $(document).ready(function () {          
            $("#mybtn").click(function(){
                // Cookies.set('login_name','you');
                if($("#user_name").val().length != 0 && $("#user_passwd").val().length != 0 && $("#user_passwd2").val().length != 0){
                    if($("#user_passwd").val() == $("#user_passwd2").val()){
                        $.ajax({
                            type: 'POST',
                            url: "addacc.php",
                            data: {
                                name:$("#user_name").val(),
                                passwd:$("#user_passwd").val()
                            },
                            dataType: "json",
                            async: true,　
                            success: function(response) {
                                if(response.status == "success"){                                    
                                    alert("success register pls login");
                                    location.href = 'login.php';
                                }else{
                                    alert(response.status);
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                $("#error").append(jqXHR);
                            }
                        })
                    }else{
                        $("#error").append("password not equal");
                    }
                }else{
                    $("#error").append("all require pls check");
                }                
            });                     
        });
    </script>
</head>
<body>
    <div id="register">        
        <form >
            <div>account<div>
            <input type="text" name="user_name" id="user_name"> 
            <div>password<div>
            <input type="password" name="user_passwd" id="user_passwd">
            <div>re-enter password<div>
            <input type="password" name="user_passwd2" id="user_passwd2">
            <br>
            <input type="button" value="register" id="mybtn">
        </from>
        <div id="error"></div>
        <div>account admin <br/>password admin</div>
    </div>
</body>
</html>

