<?php
$id=$_GET['id'];
$subject=$Que->find($id);
$option=$Que->all(['subject'=>$id]);

?>
<fieldset>
    <legend>目前位置：首頁 > 問卷調查 > <?=$subject['text'];?></legend>
    <h3 style="margin: 1rem 0;"><?=$subject['text'];?></h3>
    <table>
        <?php
    foreach($option as $key=>$op){
        ?>
    <tr>
    <td style="width: 50%;"><?=$op['text'];?></td>
    <td>
    <div style="display:inline-block;width: <?=round(($op['count']/$subject['count'])*100);?>%;background:#333;height:1.5rem;"></div>
    <?=$op['count']?>票(<?=round(($op['count']/$subject['count'])*100);?>%)
    </td>
    </tr>
    <?php
    }
    ?>
    </table>
    <div class="ct">
        <a href="index.php?do=que"><button>返回</button></a>
    </div>
</fieldset>