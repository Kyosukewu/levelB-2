<form action="api/editnews.php" method="post">
<table style="width: 100%;text-align:center; margin:auto;">
    <tr  class="clo">
        <td style="width: 10%;">標號</td>
        <td style="width: 70%;">標題</td>
        <td style="width: 10%;">顯示</td>
        <td style="width: 10%;">刪除</td>
    </tr>
    <?php
    $count=$News->count();
    $div=3;
    $pages=ceil($count/$div);
    $now=(isset($_GET['p']))?$_GET['p']:1;
    $start=($now-1)*$div;

    $all=$News->all("limit $start,$div");
    foreach($all as $key=>$news){
    ?>
    <tr>
        <td><?=$start+1+$key;?>.</td>
        <td style="text-align: left;"><?=$news['title'];?></td>
        <td><input type="checkbox" name="sh[]" value="<?=$news['id'];?>" <?=($news['sh']==1)?"checked":"";?>></td>
        <td><input type="checkbox" name="del[]" value="<?=$news['id'];?>"></td>
        <input type="hidden" name="id[]" value="<?=$news['id'];?>">
    </tr>
    <?php
    }
    ?>
</table>
<div class="ct">
    <?php
    if(($now-1)>0){
        echo "<a href='backend.php?do=news&p=".($now-1)."'> &lt; </a>";
    }
        for($i=1;$i<=$pages;$i++){
            $fonsize=($i==$now)?"28px":"18px";
            echo "<a href='backend.php?do=news&p=$i' style='font-size:$fonsize;'>$i</a>";
        }
        if(($now+1)<=$pages){
            echo "<a href='backend.php?do=news&p=".($now+1)."'> &gt; </a>";
        }
    ?>
</div>
<div class="ct"><input type="submit" value="確定修改"></div>
</form>