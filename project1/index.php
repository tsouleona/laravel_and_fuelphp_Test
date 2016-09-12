<?php
for ($i = 0; $i < 10; $i++) {
    $data_all[$i] = $i;
}

shuffle($data_all);
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>終極密碼</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Jquery-->
    <script src="jquery/jquery.js"></script>
    <script src="jquery/jquery.blockUI.js"></script>


</head>
<body>

<br><br><br>
<div class="row" align="center">
    <input style="display:none" id="ans"
           value="<?php echo $data_all[0] . $data_all[1] . $data_all[2] . $data_all[3]; ?>"/>
    <div class="container">
        <div class="col-lg-2"></div>
        <div class="col-lg-7">
            <div class="input-group">
                <input id="usernumber" type="text" class="form-control" placeholder="輸入四個數字">
                    <span class="input-group-btn">
                        <button id="go" class="btn btn-primary" onclick="check();">Go!</button>
                    </span>
            </div>
        </div>
    </div>
</div>
<div class="row" align="center">
    <div class="container">
        <br>
        <button class="btn btn-primary btn-lg" onclick="javascript:window.location.reload();">開新局</button>
        <h3 style="color:#4adbc4"><strong>你還有</strong></h3>
        <h3 id="count" style="color:#4adbc4"><strong>10</strong></h3>
        <h3 style="color:#4adbc4"><strong>次</strong></h3>
        <div id="danger"></div>
    </div>
</div>
<br>
<hr>
<div class="row" align="center">
    <div class="container">
        <h3 style="color:#9999ff"><strong>回答紀錄</strong></h3>
        <div style="color:#99ccff" id="message"></div>
    </div>
</div>
<script>
    function check() {
        $("#danger").html('');
        x = $("#usernumber").val();
        ans = $("#ans").val();
        count = $("#count").text();
        array = [];
        arrayAns = [];
        if (isNaN(x)) {
            $("#danger").html('<img src="error.jpg">');
            count--;
            $("#count").text(count);
        }
        else if (x.length > 4 || x.length < 4) {
            $("#danger").html('<img src="error2.jpg">');
            count--;
            $("#count").text(count);
        }
        else {
            for (i = 0; i < x.length; i++) {
                array.push(x.slice(i, i + 1));
            }
            for (i = 0; i < ans.length; i++) {
                arrayAns.push(ans.slice(i, i + 1));
            }
            tag = 0;
            for (i = 0; i < x.length; i++) {
                for (j = 1; j < i; j++) {
                    if (array[i] == array[j]) {
                        tag = 1;
                    }
                }
            }
            if (tag == 0) {
                A = 0;
                B = 0;
                for (i = 0; i < array.length; i++) {
                    for (j = 0; j < arrayAns.length; j++) {
                        if (array[i] == arrayAns[j] && i == j) {
                            A++;
                        }
                        else if (array[i] == arrayAns[j] && i != j) {
                            B++;
                        }
                    }

                }
                count--;
                $("#count").text(count);
                if (count == 0 && A != 4) {
                    $("#danger").html('<img src="error4.gif">');
                    document.getElementById("go").disabled = true;
                }
                else if (A == 4) {
                    $("#message").html('<img src="win.jpg">');
                    document.getElementById("go").disabled = true;
                }
                else {
                    $("#message").append("<h4><strong>" + x + "目前為" + A + " A " + B + " B " + "</strong></h4>");
                }
            }
            else {
                $("#danger").html('<img src="error3.jpg">');
            }

        }
    }
</script>

<!-- Bootstrap Core js -->
<script src="js/bootstrap.js"></script>
</body>
</html>