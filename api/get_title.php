<?php

include_once "../base.php";

$type=$_GET['type'];

$news=$News->all(['type'=>$type]);

foreach($news as $n){
    echo "<a href='' style='display:block;'>{$n['title']}</a>";
}

?>