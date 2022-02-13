<?php
session_start();
date_default_timezone_set("Asia/Taipei");

class DB{
    private $dsn="mysql:host=localhost;charset=utf8;dbname=wc_51_local";
    public  $pdo;
    private $table;
    private $user='root';
    private $pw='';
    private $rows;

    function __construct($table){
        $this->pdo=new PDO($this->dsn,$this->user,$this->pw);
        $this->table=$table;
    }

    function all(...$arg){
        $sql="select * from $this->table ";

        switch(count($arg)){
            case 1:
                if(is_array($arg[0])){
                    foreach($arg[0] as $key => $value){
                        $tmp[]=sprintf("`%s`='%s'",$key,$value);
                    }

                    $sql.=" where ". join(" && ",$tmp);

                }else{
                    $sql.=$arg[0];
                }
            break;
            case 2:
                foreach($arg[0] as $key => $value){
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);
                }
                $sql.=" where ".join(" && ",$tmp) . $arg[1];
            break;
        }

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function find($mix){
        $sql="select * from $this->table ";
        if(is_array($mix)){
            foreach($mix as $key => $value){
                $tmp[]=sprintf("`%s`='%s'",$key,$value);
            } 
            $sql .= " where ".join(" && ",$tmp);
        }else{

            $sql .= " where `id`='{$mix}'";

        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function save($array){

        if(isset($array['id'])){
            foreach($array as $key => $value){
                if($key!='id'){
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);
                }
            }
            $sql="update $this->table set ".join(",",$tmp)." where `id`='{$array['id']}'";
        }else{

            $sql="insert into $this->table ";
            $sql.="(`".join("`,`",array_keys($array))."`) ";
            $sql.="values('".join("','",$array)."');";
        }
        echo $sql;
        return $this->pdo->exec($sql);
    }
    
    function del($mix){
        $sql="delete from $this->table ";
        if(is_array($mix)){
            foreach($mix as $key => $value){
                $tmp[]=sprintf("`%s`='%s'",$key,$value);
            } 
            $sql .= " where ".join(" && ",$tmp);
        }else{

            $sql .= " where `id`='{$mix}'";

        }
        echo $sql;
        return $this->pdo->exec($sql);
    }

    function q($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function math($type,$col,...$arg){
        $sql="select $type($col) from $this->table ";

        switch(count($arg)){
            case 1:
                if(is_array($arg[0])){
                    foreach($arg[0] as $key => $value){
                        $tmp[]=sprintf("`%s`='%s'",$key,$value);
                    }

                    $sql.=" where ". join(" && ",$tmp);

                }else{
                    $sql.=$arg[0];
                }
            break;
            case 2:
                foreach($arg[0] as $key => $value){
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);
                }
                $sql.=" where ".join(" && ",$tmp) . $arg[1];
            break;
        }

        return $this->pdo->query($sql)->fetchColumn();
    }

}

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function to($url){
    header("location:".$url);
}

$Quiz=new DB("quizs");
$Code=new DB("inv_codes");
$Log=new DB("logs");
?>