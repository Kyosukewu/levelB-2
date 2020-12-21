<fieldset>
    <legend>
        目前位置：首頁 > 人氣文章區</legend>
    <table>
        <tr class="clo">
            <td style="width: 30%;">標題</td>
            <td style="width: 50%;">內容</td>
            <td style="width: 20%;">人氣</td>
        </tr>
        <?php
        $count = $News->count(['sh'=>1]);
        $div = 5;
        $pages = ceil($count / $div);
        $now = (isset($_GET['p'])) ? $_GET['p'] : 1;
        $start = ($now - 1) * $div;

        $all = $News->all(['sh' => 1]," order by good desc limit $start,$div");
        foreach ($all as $news) {
        ?>
            <tr>
                <td class="header" style="cursor: pointer;" id="t<?= $news['id']; ?>"><?= $news['title']; ?></td>
                <td class="tt" style="position: relative;">
                    <div class="title"><?= mb_substr($news['text'], 0, 30, 'utf8'); ?>...</div>
                    <div class="text" style="display: none; background:rgba(51,51,51,0.8); color:#FFF; height:400px; width:500px; position:absolute;z-index:9999; overflow:auto;"><h3><?=$typeStr[$news['type']];?></h3><?= nl2br($news['text']); ?></div>
                </td>
                <td>
                <span id="vie<?=$news['id'];?>"><?=$news['good'];?></span>
                個人說
                <img src="icon/02B03.jpg" style="width:20px;height:20px">
                <?php
                if(!empty($_SESSION['login'])){
                    $chk=$Log->count(['acc'=>$_SESSION['login'],'news'=>$news['id']]);
                    if($chk){
                ?>
                    <a id="good<?=$news['id'];?>" href='#' onclick="good('<?=$news['id'];?>','<?=$_SESSION['login'];?>','2')">收回讚</a>
                <?php
                    }else{
                ?>
                    <a id="good<?=$news['id'];?>" href='#' onclick="good('<?=$news['id'];?>','<?=$_SESSION['login'];?>','1')">讚</a>
                <?php
                    }
                }
                ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div class="ct">
        <?php
        if (($now - 1) > 0) {
            echo "<a href='index.php?do=pop&p=" . ($now - 1) . "'> &lt; </a>";
        }
        for ($i = 1; $i <= $pages; $i++) {
            $fonsize = ($i == $now) ? "28px" : "18px";
            echo "<a href='index.php?do=pop&p=$i' style='font-size:$fonsize;'>$i</a>";
        }
        if (($now + 1) <= $pages) {
            echo "<a href='index.php?do=pop&p=" . ($now + 1) . "'> &gt; </a>";
        }
        ?>
    </div>
</fieldset>
<script>
    $(".header").hover(function(e){
        $(this).next('td').children('.text').toggle();
    })
    $(".tt").hover(function(e){
        $(this).children('.text').toggle();
    })
</script>