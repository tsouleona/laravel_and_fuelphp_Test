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
                    <th>[1] 牛奶球在哪？</th>
                    </thead>
                    <tr>
                        <td>球道：<input id="milk_number" type="number" min="1" max="10" step="1" /></td>
                        <td>下注：<input id="milk_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                    </tr>

                </table>
            </div>
            <div class="row">
                <table class="table table-bordered">
                    <thead>

                    <th>[2-1] 1-5 球道的球數是單還是雙？</th>

                    </thead>
                    <thead>
                    <tr>
                        <th>第1道</th>
                        <th>第2道</th>
                        <th>第3道</th>
                        <th>第4道</th>
                        <th>第5道</th>
                    </tr>
                    </thead>
                    <tr>
                        <td>第1道 單 價錢：<input id="one_odd_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>第2道 單 價錢：<input id="two_odd_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>第3道 單 價錢：<input id="three_odd_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>第4道 單 價錢：<input id="four_odd_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>第5道 單 價錢：<input id="five_odd_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>

                    </tr>
                    <tr>
                        <td>第1道 雙 價錢：<input id="one_even_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>第2道 雙 價錢：<input id="two_even_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>第3道 雙 價錢：<input id="three_even_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>第4道 雙 價錢：<input id="four_even_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>第5道 雙 價錢：<input id="five_even_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <table class="table table-bordered">
                    <thead>

                    <th>[2-2] 6-10 球道的球數是單還是雙？</th>

                    </thead>
                    <thead>
                    <tr>
                        <th>第6道</th>
                        <th>第7道</th>
                        <th>第8道</th>
                        <th>第9道</th>
                        <th>第10道</th>
                    </tr>
                    </thead>
                    <tr>
                        <td>第6道 單 價錢：<input id="six_odd_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>第7道 單 價錢：<input id="seven_odd_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>第8道 單 價錢：<input id="eight_odd_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>第9道 單 價錢：<input id="nine_odd_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>第10道 單 價錢：<input id="ten_odd_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>

                    </tr>
                    <tr>
                        <td>第6道 雙 價錢：<input id="six_even_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>第7道 雙 價錢：<input id="seven_even_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>第8道 雙 價錢：<input id="eight_even_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>第9道 雙 價錢：<input id="nine_even_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>第10道 雙 價錢：<input id="ten_even_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                    </tr>
                </table>
            </div>
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
                        <td>價錢：<input id="1234_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>價錢：<input id="2345_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>價錢：<input id="3456_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>價錢：<input id="4567_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>價錢：<input id="5678_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>價錢：<input id="6789_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>
                        <td>價錢：<input id="78910_money" type="number" min="1000" max="1000000" step="1000" value="0"/></td>

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
                    $.ajax({
                       url:'<?php echo Uri::create('record/getRecord'); ?>',
                       type:'POST',
                       data:{
                           milk_number:$("#milk_number").val(),
                           milk_money:$("#milk_money").val(),
                           one_odd_money:$("#one_odd_money").val(),
                           two_odd_money:$("#two_odd_money").val(),
                           three_odd_money:$("#three_odd_money").val(),
                           four_odd_money:$("#four_odd_money").val(),
                           five_odd_money:$("#five_odd_money").val(),
                           one_even_money:$("#one_even_money").val(),
                           two_even_money:$("#two_even_money").val(),
                           three_even_money:$("#three_even_money").val(),
                           four_even_money:$("#four_even_money").val(),
                           five_even_money:$("#five_even_money").val(),
                           six_odd_money:$("#six_odd_money").val(),
                           seven_odd_money:$("#seven_odd_money").val(),
                           eight_odd_money:$("#eight_odd_money").val(),
                           nine_odd_money:$("#nine_odd_money").val(),
                           ten_odd_money:$("#ten_odd_money").val(),
                           six_even_money:$("#six_even_money").val(),
                           seven_even_money:$("#seven_even_money").val(),
                           eight_even_money:$("#eight_even_money").val(),
                           nine_even_money:$("#nine_even_money").val(),
                           ten_even_money:$("#ten_even_money").val(),
                           money1:$("#1234_money").val(),
                           money2:$("#2345_money").val(),
                           money3:$("#3456_money").val(),
                           money4:$("#4567_money").val(),
                           money5:$("#5678_money").val(),
                           money6:$("#6789_money").val(),
                           money7:$("#78910_money").val()
                       },
                       datatype:'html',
                        success:function(data){
                            $("#record").html(data);
                        }
                    });
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
