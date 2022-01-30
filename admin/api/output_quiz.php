<?php
include_once "../../base.php";

$id=$_GET['id'];
$quiz=$Quiz->find($id);
$logs=$Log->all(['quiz_id'=>$id]);

$file=fopen("../output/output_{$id}.csv","w+");

fwrite($file,"<Question>\r\n");
fwrite($file,$quiz['name']."\r\n");
$subjects=unserialize($quiz['subjects']);
$types=[];
foreach ($subjects as $key => $sub) {
    $types[$key]=$sub['type'];
    switch($sub['type']){
        case "tof":
            fwrite($file,'是,');
        break;
        case "single":
            fwrite($file,'單,');
        break;
        case "multiple":
            fwrite($file,'多,');
        break;
        case "qa":
            fwrite($file,'自,');
        break;
    }
    fwrite($file,$sub['desc']);
    if(isset($sub['opt'])){
        fwrite($file,",".join(",",$sub['opt']));
    }
    fwrite($file,"\r\n");
}

fwrite($file,"</Question>\r\n");
fwrite($file,"\r\n");
fwrite($file,"<Ans>\r\n");
foreach ($logs as $key => $log) {
    $ans=unserialize($log['ans']);
    foreach($types as $k => $type){
        if($type=='multiple'){
            $ans[$k]=join(" ",$ans[$k]);
        }
        if($type=='qa'){
            $ans[$k]=preg_replace('/[\s+]/', '', $ans[$k]);
        }
    }
    fwrite($file,join(",",$ans));
    fwrite($file,"\r\n");
}

fwrite($file,"</Ans>\r\n");


fclose($file);