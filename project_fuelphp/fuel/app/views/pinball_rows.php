<table class="table table-bordered">
    <thead>
        <tr>
            期數：<?php echo $total[0]['record_id'];?>
        </tr>
    </thead>
    <tr>
        <td>玩法</td>
        <td>球道</td>
        <td>下注金額</td>
        <td>賠率</td>
    </tr>
    <?php for($i=0;$i<count($total);$i++) {?>
        <tr>

            <td><?php echo $total[$i]['play_type'];?></td>
            <td><?php echo $total[$i]['input'];?></td>
            <td><?php echo $total[$i]['bet_money'];?></td>
            <td><?php echo $total[$i]['odds'];?></td>
        </tr>
    <?php }?>
</table>