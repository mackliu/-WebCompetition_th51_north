<?php include_once "../../base.php";

$quiz=$Quiz->find($_GET['id']);
$logs=$Log->all(['quiz_id'=>$_GET['id']]);

$subjects=unserialize($quiz['subjects']);

$stastics=[];
//dd($subjects);
foreach($subjects as $key => $sub){
    switch($sub['type']){
        case "tof":
            $stastics[$key]['0']=0;
            $stastics[$key]['1']=0;
        break;
        case "single":
            foreach($sub['opt'] as $k=>$opt){
                $stastics[$key][$k]=0;
            }
        break;
        case "multiple":
            foreach($sub['opt'] as $k=>$opt){
                $stastics[$key][$k]=0;
            }
            if(isset($sub['other']) && $sub['other']=='on'){
                $stastics[$key][$k+1]=0;
            }
        break;
    }  
}
/* dd($stastics);*/

//dd(unserialize($logs[0]['ans'])); 
foreach ($logs as $key => $log) {
    $ans=unserialize($log['ans']);
    foreach($ans as $k => $l){
        switch($subjects[$k]['type']){
            case "tof":
                if($l==1){
                    $stastics[$k]['1']++;
                }else{
                    $stastics[$k]['0']++;
                }
            break;
            case "single":
                if(!empty($l)){
                    $stastics[$k][$l]++;
                }
            break;
            case "multiple":
                foreach($l as $lk => $opt){
                    if(is_numeric($opt)){
                        $stastics[$k][$opt]++;
                    }
                }
            break;
        }
    }
}

//dd($stastics);
$dataset=[];
foreach($subjects as $key => $sub){
    if($sub['type']!='qa'){
        $dataset[$key]['desc']=$sub['desc'];
        $dataset[$key]['type']=$sub['type'];
        switch($sub['type']){
            case "tof":
                $dataset[$key]['labels']=['否','是'];
            break;
            case "single":
                $dataset[$key]['labels']=$sub['opt'];
            break;
            case "multiple":
                $dataset[$key]['labels']=$sub['opt'];
                if(isset($sub['other'])){
                    array_push($dataset[$key]['labels'],'其他');
                }
            break;
        }
        $dataset[$key]['data']=$stastics[$key];
    }
}

//dd($dataset);
echo json_encode($dataset);