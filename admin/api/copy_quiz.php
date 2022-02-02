<?php
include "../../base.php";

$quiz=$Quiz->find($_POST['id']);
unset($quiz['id']);
$Quiz->save($quiz);
$id=$Quiz->pdo->lastInsertId();
$code=$Code->find(['quiz_id'=>$_POST['id']]);
unset($code['id']);
$code['quiz_id']=$id;
$code['code']=rand(10000,99999);
$Code->save($code);

if($_POST['type']=='log'){
    $logs=$Log->all(['quiz_id'=>$_POST['id']]);
    foreach($logs as $log){
        unset($log['id']);
        $log['quiz_id']=$id;
        $Log->save($log);
    }
}


to("../quiz_list.php");