<hr>
<table class="table table-bordered">
    <thead>
    <tr>
        <h4>期數：<?php echo $total[0]['ans_id'];?>&nbsp;&nbsp;(一般/牛奶)</h4>
    </tr>
    </thead>

    <tr>
        <?php for($i = 1 ; $i < 11 ; $i++) {?>
            <td>第<?php echo $i;?>道</td>
        <?php }?>
    </tr>
        <tr>
            <?php for($j = 1 ; $j < 11 ; $j++) {?>
                <td><?php echo $total[0]["$j"];?></td>
            <?php }?>

        </tr>
</table>