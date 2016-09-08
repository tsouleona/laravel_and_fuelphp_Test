<?php
    for($i=1;$i<11;$i++)
    {
        $ball[$i]= explode('/',$ans[0][$i]);
    }
?>

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
    <tr>
        <td><?php echo $ans[0]['ans_id'];?></td>
        <?php for($i=1;$i<11;$i++){?>
        <td>一般：<?php echo $ball["$i"][0];?> 牛奶：<?php echo $ball["$i"][1];?></td>
        <?php }?>
    </tr>
</table>