<table class="table table-bordered">
    <thead>
    <tr>
        <th>期數</th>
        <th>玩法</th>
        <th>球道</th>
        <th>輸贏</th>
        <th>所得</th>
        <th>倍率</th>
    </tr>
    </thead>
    <?php for($j=0;$j<count($total);$j++){?>
        <tr>
            <td><?php echo $total[$j]['record_id'];?></td>
            <td><?php echo $total[$j]['play_type'];?></td>
            <td><?php echo $total[$j]['input'];?></td>
            <td><?php echo $total[$j]['answer'];?></td>
            <td><?php echo $total[$j]['get_money'];?></td>
            <td><?php echo $total[$j]['odds'];?></td>
        </tr>
    <?php }?>
</table>