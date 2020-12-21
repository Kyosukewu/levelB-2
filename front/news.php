<fieldset>
    <legend>
        目前位置：首頁 > 最新文章區</legend>
    <table>
        <tr>
            <td style="width: 30%;">標題</td>
            <td style="width: 60%;">內容</td>
            <td style="width: 10%;"></td>
        </tr>
        <?php
        $all=$News->all(['sh'=>1]);
        foreach($all as $news){
        ?>
        <tr>
            <td id="<?=$news['id'];?>"><?=$news['title'];?></td>
            <!-- <td><pre><?=$news['text'];?></pre></td> -->
            <td>
                <span class="title"><?=mb_substr($news['text'],0,30,'utf8');?>...</span>
                <span class="text" style="display: none;"><?=nl2br($news['text']);?></span>
            </td>
            <td></td>
        </tr>
        <?php
        }
        ?>
    </table>
</fieldset>