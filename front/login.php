<form>
<fieldset style="width: 50%;margin:20px auto;">
    <legend>會員登入</legend>
    <table style="text-align:center;margin:auto;">
        <tr>
            <td style="background: #eee;">帳號</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td style="background: #eee;">密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td><input type="button" onclick="login()"  name="" id="" value="登入">
            <input type="reset" name="" id="" value="清除">
            </td>
            <td>
            <a href="?do=forget">忘記密碼</a>|<a href="?do=reg">尚未註冊</a>    
            </td>
        </tr>
    </table>
</fieldset>
</form>

<script>
function login(){
    let acc=$("#acc").val()
    let pw=$("#pw").val()

    $.post("api/chkacc.php",{acc},function(res){
        if(res==1){
            $.post('api/chkpw.php',{acc,pw},function(r){
                if(r=='1'){
                    if(acc=='admin'){
                        location.href="backend.php";
                    }else{
                        location.href="index.php";
                    }
                }else{
                    alert("密碼錯誤");
                    $('#acc,#pw').val("");
                }
            })
        }else{
            alert("查無帳號")
            $('#acc,#pw').val("");
        }
    })
}

</script>