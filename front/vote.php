<?php
$id=$_GET['id'];
$subject=$Que->find($id);
$option=$Que->all(['subject'=>$id]);

?>
<fieldset>
    <form action="api/vote.php" method="post">
    <legend>目前位置：首頁 > 問卷調查 > <?=$subject['text'];?></legend>
    <h3 style="margin: 1rem 0;"><?=$subject['text'];?></h3>
    <?php
    foreach($option as $key=>$op){
    ?>
    <div><input type="radio" name="vote" value="<?=$op['id'];?>"><?=$op['text'];?></div>
    <?php
    }
    ?>
    <input type="hidden" name="subject" value="<?=$subject['id'];?>">
    <div class="ct"><input type="submit" value="我要投票"></div>
    </form>
</fieldset>