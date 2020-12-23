<style>
    .nav{
        cursor: pointer;
        margin: 10px 0;
    }
    .nav:hover{
        color: #fff;
        background: #333;
    }
</style>

<div class="">目前位置：首頁 > 分類網誌 > <span id="nav"></span></div>
<fieldset style="display: inline-block;vertical-align:top;width:12%;">
    <legend>分類網誌</legend>
    <div id="t1" class="nav" onclick="nav(this)">健康新知</div>
    <div id="t2" class="nav" onclick="nav(this)">菸害防治</div>
    <div id="t3" class="nav" onclick="nav(this)">癌症防治</div>
    <div id="t4" class="nav" onclick="nav(this)">慢性病防治</div>
</fieldset>
<fieldset style="display: inline-block;width:75%;">
    <legend>文章列表</legend>
        <div class="titles"></div>
</fieldset>
<script>
    $("#nav").text($("#t1").text())
    getTitle(1)

    function nav(type){
        let str=$(type).text()
        $("#nav").text(str);
        let t=$(type).attr('id').replace("t",""); //attr 取得屬性
        getTitle(t)
    }

    function getTitle(type){
        $.get("api/get_title.php",{type},function(titles){
            $(".titles").html(titles)
        })
    }
    function getNews(id){
        $.get("api/get_news.php",{id},function(text){
            $(".titles").html(text)
        })
    }
</script>