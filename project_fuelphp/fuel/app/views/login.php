<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
            <form action="<?php echo Uri::create('index/login'); ?>" method="POST">
                <table class="table table-bordered">
                    <tr>
                        <th>帳號：</th>
                        <td><input type="text" name="username" /></td>
                    </tr>

                    <tr>
                        <th>密碼：</th>
                        <td><input type="password" name="password" /></td>
                    </tr>
                    <tr>
                        <th>確認請按</th>
                        <td style="text-align:center">
                            <input type="submit" class="btn btn-primary btn-lg"  value="登錄"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap Core js -->
<script src="<?php echo Uri::base(false); ?>js/bootstrap.js"></script>
</body>
</html>
