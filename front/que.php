
<fieldset>
    <legend>目前位置：首頁 > 問卷調查</legend>
    <table>
        <tr>
            <td style="width:10%; text-align:center;">編號</td>
            <td style="width:60%;">問卷題目</td>
            <td style="width:10%;text-align:center;">投票總數</td>
            <td style="width:10%;text-align:center;">結果</td>
            <td style="width:10%;text-align:center;">狀態</td>
        </tr>
        <?php
        $ques=$Que->all(['subject'=>0]);
        foreach($ques as $key=>$que){
        ?>
        <tr>
            <td style="text-align:center;"><?=$key+1;?>.</td>
            <td><?=$que['text'];?></td>
            <td style="text-align:center;"><?=$que['count'];?></td>
            <td style="text-align:center;">
                <a href="?do=res">結果</a>
            </td>
            <td style='text-align:center;'>
        <?php
        if(!empty($_SESSION['login'])){
            echo "<a href='?do=vote&id={$que['id']}'>參與投票</a>";
        }else{
            echo "<a href='index.php?do=login'>請先登入</a>";
        }
        ?>
        </td>
        </tr>
        <?php
        }
        ?>
    </table>
</fieldset>