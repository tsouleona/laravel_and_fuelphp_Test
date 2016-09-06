<html>
<head>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo Uri::base(false); ?>css/bootstrap.css" rel="stylesheet">

    <!-- Jquery-->
    <script src="<?php echo Uri::base(false); ?>jquery/jquery.js"></script>
</head>
<body>
<br><br>
<div class="container">
    <div class="row" >
        <div class="col-lg-4"></div>
        <div class="col-lg-4" style="border:2px #6fbceb solid;border-radius:10px;">
            <h3 align="center"><strong>會員登錄</strong></h3>
            <table class="table table-bordered">
                <tr>
                    <th>帳號：</th>
                    <td><input type="text" id="username" /></td>
                </tr>

                <tr>
                    <th>密碼：</th>
                    <td><input type="password" id="password" /></td>
                </tr>
            </table>
            <div id="bug"></div>
            <div style="text-align:right;">
                <button id="login" style="text-align:right;" class="btn btn-primary btn-lg">登錄</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#login").on("click",function(){
        if($("#username").val() == "" || $("#password").val() == "")
        {
            $("#bug").html('<h4 style="color: #fb0404;">尚未輸入完整</h4>')
        }
        else{
            $.ajax({
                url:'<?php echo Uri::base(false);?>index/login',
                data:{
                    username:$("#username").val(),
                    password:$("#password").val()
                },
                datatype:'html',
                success:function(data){
                    $("#bug").html('<h4 style="color: #fb0404;">'+data+'</h4>');
                }
            });
        }
    });
</script>
<!-- Bootstrap Core js -->
<script src="<?php echo Uri::base(false); ?>js/bootstrap.js"></script>
</body>
</html>
