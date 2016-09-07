<html>
<head>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo Uri::base(false); ?>css/bootstrap.css" rel="stylesheet">

    <!-- Jquery-->
    <script src="<?php echo Uri::base(false); ?>jquery/jquery.js"></script>
</head>
<body>
    <div class="container">
        <div class="col-lg-8">
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                    <th>[1] 1-5球道 猜牛奶球在哪？</th>
                    </thead>

                    <tr>
                        <?php for($i=1;$i<6;$i++){?>
                            <td>第<?php echo $i;?>道 下注：<input id="milk_money<?php echo $i;?>" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <?php }?>
                    </tr>

                </table>
            </div>
            <div class="row">
                <table class="table table-bordered">
                    <tr>
                        <?php for($i=6;$i<11;$i++){?>
                            <td>第<?php echo $i;?>道 下注：<input id="milk_money<?php echo $i;?>" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
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
                            <td>第<?php echo $i;?>道 單 下注：<input id="odd_money<?php echo $i;?>" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <?php }?>
                    </tr>
                    <tr>
                        <?php for($i=6;$i<11;$i++){?>
                            <td>第<?php echo $i;?>道 單 下注：<input id="odd_money<?php echo $i;?>" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
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
                            <td>第<?php echo $i;?>道 雙 下注：<input id="even_money<?php echo $i;?>" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <?php }?>
                    </tr>
                    <tr>
                        <?php for($i=6;$i<11;$i++){?>
                            <td>第<?php echo $i;?>道 雙 下注：<input id="even_money<?php echo $i;?>" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
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
                            <td>下注：<input id="continue_money<?php echo $i;?>" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <?php }?>
                    </tr>

                </table>
            </div>
            <div align="center">
                <button class="btn btn-primary btn-lg" id="go">送出</button>
            </div>
            <script>
//                $("#go").on("click",function(){
//
//                    if($("#milk_money").val() != '0' && $("#milk_number").val()!= "")
//                    {
//                            $("#record").append('[1]牛奶球'+$("#milk_money").val()+'<br>');
//                    }
//
//                    one = parseInt($("#one_even_money").val()) + parseInt($("#one_odd_money").val());
//                    two= parseInt($("#two_even_money").val()) + parseInt($("#two_odd_money").val());
//                    three= parseInt($("#three_even_money").val()) + parseInt($("#three_odd_money").val());
//                    four= parseInt($("#four_even_money").val()) + parseInt($("#four_odd_money").val());
//                    five= parseInt($("#five_even_money").val()) + parseInt($("#five_odd_money").val());
//                    six= parseInt($("#six_even_money").val()) + parseInt($("#six_odd_money").val());
//                    seven= parseInt($("#seven_even_money").val()) + parseInt($("#seven_odd_money").val());
//                    eight= parseInt($("#eight_even_money").val()) + parseInt($("#eight_odd_money").val());
//                    nine= parseInt($("#nine_even_money").val()) + parseInt($("#nine_odd_money").val());
//                    ten= parseInt($("#ten_even_money").val()) + parseInt($("#ten_odd_money").val());
//                    total = parseInt(one)+parseInt(two)+parseInt(three)+parseInt(four)+parseInt(five)+parseInt(six)+parseInt(seven)+parseInt(eight)+parseInt(nine)+parseInt(ten);
//                    if(total != 0)
//                    {
//                        $("#record").append('[2]球道單雙'+total+'<br>');
//                    }
//                    total_continue1 = parseInt($("#1234_money").val()) + parseInt($("#2345_money").val()) + parseInt($("#3456_money").val()) + parseInt($("#4567_money").val());
//                    total_continue2 = total_continue1 + parseInt($("#5678_money").val()) + parseInt($("#6789_money").val()) + parseInt($("#78910_money").val());
//                    if(total_continue2 != 0)
//                    {
//                        $("#record").append('[3]連續進球'+total_continue2+'<br>');
//                    }
//                    if(($("#milk_money").val() != '0' &&$("#milk_number").val()!= "") || total != 0 || total_continue2 != 0)
//                    {
//                        document.getElementById("go").disabled = true;
//                        $("#record").append('<hr>');
//                    }
//                });
                $("#go").on("click",function(){
                    if($("#milk_money1").val()=='0' && $("#milk_money2").val()=='0' &&  $("#milk_money3").val()=='0' &&
                        $("#milk_money4").val()=='0' && $("#milk_money5").val()=='0' && $("#milk_money6").val()=='0' &&
                        $("#milk_money7").val()=='0' && $("#milk_money8").val()=='0' && $("#milk_money9").val()=='0' &&
                        $("#milk_money10").val()=='0' && $("#odd_money1").val()=='0' && $("#odd_money2").val()=='0' &&
                        $("#odd_money3").val()=='0' && $("#odd_money4").val()=='0' && $("#odd_money5").val()=='0' &&
                        $("#odd_money6").val()=='0' && $("#odd_money7").val()=='0' && $("#odd_money8").val()=='0' &&
                        $("#odd_money9").val()=='0' && $("#odd_money10").val()=='0' && $("#even_money1").val()=='0' &&
                        $("#even_money2").val()=='0' && $("#even_money3").val()=='0' && $("#even_money4").val()=='0' &&
                        $("#even_money5").val()=='0' && $("#even_money6").val()=='0' && $("#even_money7").val()=='0' &&
                        $("#even_money8").val()=='0' && $("#even_money9").val()=='0' && $("#even_money10").val()=='0' &&
                        $("#continue_money1").val()=='0' && $("#continue_money2").val()=='0' && $("#continue_money3").val()=='0' &&
                        $("#continue_money4").val()=='0' && $("#continue_money5").val()=='0' && $("#continue_money6").val()=='0' &&
                        $("#continue_money7").val()=='0')
                    {
                        $("#record").html('<h3 style="color:red"><strong>未下任何注!!!</strong><h3>');
                    }
                    else
                    {
                        document.getElementById("go").disabled = true;
                        $.ajax({
                            url:'<?php echo Uri::create('record/getRecord'); ?>',
                            type:'POST',
                            data:{
                                milk_money1:$("#milk_money1").val(),
                                milk_money2:$("#milk_money2").val(),
                                milk_money3:$("#milk_money3").val(),
                                milk_money4:$("#milk_money4").val(),
                                milk_money5:$("#milk_money5").val(),
                                milk_money6:$("#milk_money6").val(),
                                milk_money7:$("#milk_money7").val(),
                                milk_money8:$("#milk_money8").val(),
                                milk_money9:$("#milk_money9").val(),
                                milk_money10:$("#milk_money10").val(),
                                odd_money1:$("#odd_money1").val(),
                                odd_money2:$("#odd_money2").val(),
                                odd_money3:$("#odd_money3").val(),
                                odd_money4:$("#odd_money4").val(),
                                odd_money5:$("#odd_money5").val(),
                                even_money1:$("#even_money1").val(),
                                even_money2:$("#even_money2").val(),
                                even_money3:$("#even_money3").val(),
                                even_money4:$("#even_money4").val(),
                                even_money5:$("#even_money5").val(),
                                odd_money6:$("#odd_money6").val(),
                                odd_money7:$("#odd_money7").val(),
                                odd_money8:$("#odd_money8").val(),
                                odd_money9:$("#odd_money9").val(),
                                odd_money10:$("#odd_money10").val(),
                                even_money6:$("#even_money6").val(),
                                even_money7:$("#even_money7").val(),
                                even_money8:$("#even_money8").val(),
                                even_money9:$("#even_money9").val(),
                                even_money10:$("#even_money10").val(),
                                continue_money1:$("#continue_money1").val(),
                                continue_money2:$("#continue_money2").val(),
                                continue_money3:$("#continue_money3").val(),
                                continue_money4:$("#continue_money4").val(),
                                continue_money5:$("#continue_money5").val(),
                                continue_money6:$("#continue_money6").val(),
                                continue_money7:$("#continue_money7").val()
                            },
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
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>期數</th>
                        <th>第1道</th>
                        <th>第2道</th>
                        <th>第3道</th>
                        <th>第4道</th>
                        <th>第5道</th>
                        <th>第6道</th>
                        <th>第7道</th>
                        <th>第8道</th>
                        <th>第9道</th>
                        <th>第10道</th>
                    </tr>
                    </thead>
                    <div id="lists"></div>
                </table>
            </div>

        </div>
        <br>
        <div class="col-lg-3" style="border:2px #6fbceb solid;border-radius:10px;margin-left: 90px">
            <h4><strong>下注紀錄</strong><h4><hr>
                <div id="record"></div>
        </div>

    </div>

    <script>
    //    $.ajax({
    //        url: 'pinball/',
    //        datatype: 'html',
    //        success: function (data) {
    //        $("#lists").append(data);
    //        }
    //    });
    </script>
<!-- Bootstrap Core js -->
<script src="<?php echo Uri::base(false); ?>js/bootstrap.js"></script>
</body>
</html>
