<?php

date_default_timezone_set("Asia/Taipei");
session_start();

/**判斷瀏灠人次 */

$Total=new DB('total');
$Mem=new DB('mem');
$News=new DB('news');
$Log=new DB('log');
$chk=$Total->find(['date'=>date("Y-m-d")]);

if(empty($chk) && empty($_SESSION['total'])){
    //沒有今天的資料,也沒有session  今天頭香 需要新增今日資料,
    $Total->save(["date"=>date("Y-m-d"),"total"=>1]);
    $_SESSION['total']=1;

}else if(empty($chk) && !empty($_SESSION['total'])){
    //沒有今天的資料,但是有session 異常情形..需要新增今日資料
    $Total->save(["date"=>date("Y-m-d"),"total"=>1]);

}else if(!empty($chk) && empty($_SESSION['total'])){
    //有今天的資料,沒有session  表示是新來 需要加1
    $chk['total']++;
    $Total->save($chk);
    $_SESSION['total']=1;
}



class DB{
    private $dsn="mysql:host=localhost;dbname=db212;charset=utf8";
    private $table;
    private $pdo;


    function __construct($table)
    {
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,'root','');
    }

    function all(...$arg){
        $sql="select * from $this->table ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                foreach($arg[0] as $key=>$value){
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);
                }
                $sql .=" where ".implode(" && ",$tmp);
            }else{
                $sql .= $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .=$arg[1];
        }
        return $this->pdo->query($sql)->fetchAll();
    }

    function count(...$arg){
        $sql="select count(*) from $this->table ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                foreach($arg[0] as $key=>$value){
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);
                }
                $sql .=" where ".implode(" && ",$tmp);
            }else{
                $sql .= $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .=$arg[1];
        }
        return $this->pdo->query($sql)->fetchColumn();
    }

    function find($arg){
        $sql="select * from $this->table ";
            if(is_array($arg)){
                foreach($arg as $key=>$value){
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);
                }
                $sql .=" where ".implode(" && ",$tmp);
            }else{
                $sql .= " where `id`='$arg'";
            }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function save($arg){
        if(!empty($arg['id'])){
            foreach($arg as $key=>$value){
                $tmp[]=sprintf("`%s`='%s'",$key,$value);
            }
            $sql =" update $this->table set ".implode(" , ",$tmp) . " where `id`='{$arg['id']}'";
        }else{
            $sql="insert into $this->table (`".implode("`,`",array_keys($arg))."`) value ('".implode("','",$arg)."')";
        }
        return $this->pdo->exec($sql);
    }

    function q($arg){
        return $this->pdo->query($arg)->fetchAll();
    }

    function del($arg){
        $sql="delete from $this->table ";
            if(is_array($arg)){
                foreach($arg as $key=>$value){
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);
                }
                $sql .=" where ".implode(" && ",$tmp);
            }else{
                $sql .= " where `id`='$arg'";
            }
        return $this->pdo->exec($sql);
    } 
}
function to($url){
    header("location:".$url);
}
// 測試
// $datetotal=['date'=>date('Y-m-d'),"total"=>1];
// $db=new DB('total');
// $db->save($datetotal);
// $total=$db->find(['date'=>date('Y-m-d')]);

// print_r($total);

// $total['total']=5;
// print_r($total);
// $db->del($total);

?>