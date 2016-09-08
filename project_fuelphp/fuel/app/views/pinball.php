<?php date_default_timezone_set('America/New_York');?>
<html>
<head>
    <title>彈珠台</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo Uri::base(false); ?>css/bootstrap.css" rel="stylesheet">

    <!-- Jquery-->
    <script src="<?php echo Uri::base(false); ?>jquery-3.1.0.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <a class="navbar-brand" >彈珠台</a>
        <a class="navbar-brand" ><?php echo \Session::get('username');?> 歡迎光臨</a>
        <a class="navbar-brand" >餘額: &nbsp;<?php echo \Session::get('balance');?></a>
        <a class="navbar-brand" href="<?php echo Uri::create('index/logout'); ?>">登出</a>

    </nav>
    <div class="col-lg-8">
        <div class="row" style="text-align:center">
            <h4><strong>離結束時間還有</strong></h4>
            <div id="time"></div>
        </div>
        <hr>
        <script>
            get_time();

            function showAns()
            {
                $.ajax({
                    url: '<?php echo Uri::create('Pinball/getBall'); ?>',
                    datatype: 'html',
                    success: function (data) {
                        $("#lists").append(data);
                    }
                });
            }

            function get_time()
            {
                //document.getElementById("go").disabled = false;
                $.ajax({
                   url:'<?php echo Uri::create('pinball/getTime'); ?>',
                   datatype:'html',
                   success:function(data){
                       var all_s = (data);

                       if(all_s == 0)
                       {
                           //showAns();
                           setTimeout(get_time,10000);//10秒後去重新要秒數
                       }
                        else{
                           all_s = all_s - 1;
                           var m = Math.floor(all_s / 60);//分
                           var s = all_s % 60;//秒
                           $("#time").html('<h4>'+ m + '分' + s + '秒' + '</h4>');

                           setTimeout(get_time,1000);
                       }

                   }
                });
            }
        </script>
        <form>
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                    <th>[1] 1-5球道 猜牛奶球在哪？</th>
                    </thead>

                    <tr>
                        <?php for($i=1;$i<6;$i++){?>
                            <td>第<?php echo $i;?>道 下注：<input name="milk_money<?php echo $i;?>" id="milk_money<?php echo $i;?>" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <?php }?>
                    </tr>

                </table>
            </div>
            <div class="row">
                <table class="table table-bordered">
                    <tr>
                        <?php for($i=6;$i<11;$i++){?>
                            <td>第<?php echo $i;?>道 下注：<input name="milk_money<?php echo $i;?>" id="milk_money<?php echo $i;?>" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <?php }?>
                    </tr>

                </table>
            </div>
<!--            -----------------------------------單數區---------------------------------------------->
            <div class="row">
                <table class="table table-bordered">
                    <thead>

                    <th>[2]球道的球數是單還是雙？</th>

                    </thead>
                    <thead>
                    <tr>
                        <th>單數區</th>
                    </tr>
                    </thead>
                    <tr>
                        <?php for($i=1;$i<6;$i++){?>
                            <td>第<?php echo $i;?>道 單 下注：<input name="odd_money<?php echo $i;?>" id="odd_money<?php echo $i;?>" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <?php }?>
                    </tr>
                    <tr>
                        <?php for($i=6;$i<11;$i++){?>
                            <td>第<?php echo $i;?>道 單 下注：<input name="odd_money<?php echo $i;?>" id="odd_money<?php echo $i;?>" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <?php }?>
                    </tr>
                </table>
            </div>
<!--            -----------------------------------雙數區---------------------------------------------->
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>雙數區</th>
                    </tr>
                    </thead>
                    <tr>
                        <?php for($i=1;$i<6;$i++){?>
                            <td>第<?php echo $i;?>道 雙 下注：<input name="even_money<?php echo $i;?>" id="even_money<?php echo $i;?>" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <?php }?>
                    </tr>
                    <tr>
                        <?php for($i=6;$i<11;$i++){?>
                            <td>第<?php echo $i;?>道 雙 下注：<input name="even_money<?php echo $i;?>" id="even_money<?php echo $i;?>" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <?php }?>
                    </tr>
                </table>
            </div>
<!--            -----------------------------------連續區---------------------------------------------->
            <div class="row">
                <table class="table table-bordered">
                    <thead>

                    <th>[3] 有可能連續進球喔！！</th>

                    </thead>
                    <thead>
                    <tr>
                        <th>1、2、3、4</th>
                        <th>2、3、4、5</th>
                        <th>3、4、5、6</th>
                        <th>4、5、6、7</th>
                        <th>5、6、7、8</th>
                        <th>6、7、8、9</th>
                        <th>7、8、9、10</th>
                    </tr>
                    </thead>
                    <tr>
                        <?php for($i=1;$i<8;$i++){?>
                            <td>下注：<input name="continue_money<?php echo $i;?>" id="continue_money<?php echo $i;?>" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <?php }?>
                    </tr>

                </table>
            </div>
        </form>
        <div align="center">
            <button class="btn btn-primary btn-lg" id="go">送出</button>
        </div>
        <script>
            $.fn.toObject = function()
            {
                var o = {};
                var a = this.serializeArray();
                $.each(a, function() {
                    if (o['aaa'] !== undefined) {
                        if (!o[this.name].push) {
                            o[this.name] = [o[this.name]];
                        }
                        o[this.name].push(this.value || '');
                    } else {
                        o[this.name] = this.value || '';
                    }
                });
                return o;
            };

            $("#go").on("click",function(){
                document.getElementById("go").disabled = true;
                var isPass = false;
                $("input[id*='money']").each(function(){
                   if($(this).val() != 0){
                       isPass = true;
                   }
                });

                if(!isPass)
                {
                    $("#record").html('<h3 style="color:red"><strong>未下任何注!!!</strong><h3>');
                }
                else
                {

                    $.ajax({
                        url:'<?php echo Uri::create('record/getRecord'); ?>',
                        type:'POST',
                        data:
                            $("form").toObject()
                        ,
                        datatype:'html',
                        success:function(data){
                            $("#record").html(data);
                        }
                    });
                }

            });

        </script>
        <br>
        <div class="row">
            <div id="lists"></div>
        </div>
    </div>
    <br>
    <div class="col-lg-3" style="border:2px #6fbceb solid;border-radius:10px;margin-left: 80px">
        <h4><strong>下注紀錄</strong><h4><hr>
            <div id="record"></div>
    </div>

<!-- Bootstrap Core js -->
<script src="<?php echo Uri::base(false); ?>js/bootstrap.js"></script>
</body>
</html>
