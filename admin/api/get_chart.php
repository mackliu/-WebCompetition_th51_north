<?php include_once "../../base.php";

$quiz = $Quiz->find($_GET['id']);
$logs = $Log->all(["quiz_id" => $_GET['id']]);
$sub_id = $_GET['sub_id'];
$subject = unserialize($quiz['subjects'])[$sub_id];
$type = $subject['type'];
//dd($subject);
$labels=[];
switch($type){
    case "tof":
        $labels=['否','是'];
    break;
    case "single":
        $labels=$subject['opt'];
    break;
    case "multiple":
        $labels=$subject['opt'];
        if(isset($subject['other'])){
            array_push($labels,'其他');
        }
    break;
}


foreach($subject as $k => $sub){
    if($k==$_GET['sub_id']){

    }
}

//根據不同的題型建立統計陣列基本變數
$stastics = [];
switch ($type) {
    case "tof":
        $stastics['0'] = 0;
        $stastics['1'] = 0;
        break;
    case "single":
        foreach ($subject['opt'] as $k => $opt) {
            $stastics[$k] = 0;
        }
        break;
    case "multiple":
        foreach ($subject['opt'] as $k => $opt) {
            $stastics[$k] = 0;
        }
        if (isset($subject['other']) && $subject['other'] == 'on') {
            $stastics[$k + 1] = 0;
        }
        break;
}

//從每份問卷中計算特定主題的統計結果
foreach ($logs as $key => $log) {
    $ans = unserialize($log['ans']);
    foreach ($ans as $k => $l) {
        if ($k == $sub_id) {
            switch ($type) {
                case "tof":
                    if ($l == 1) {
                        $stastics['1']++;
                    } else {
                        $stastics['0']++;
                    }
                    break;
                case "single":
                    if (!empty($l)) {
                        $stastics[$l]++;
                    }
                    break;
                case "multiple":
                    foreach ($l as $lk => $opt) {
                        if (is_numeric($opt)) {
                            $stastics[$opt]++;
                        }
                    }
                    break;
            }
        }
    }
}

$info['topic'] = $quiz['name'];
$info['subject'] = $_GET['sub_id'] . ". " . $subject['desc'];
$info['option']['type'] = $_GET['chart'];
$info['option']['data'] = [
    'labels' => $labels,
    'datasets' => [[
        'label' => "",
        'data' => $stastics,
        'borderWidth' => 1,
        'backgroundColor' => [
            'skyblue',
            'blue',
            'lightblue',
            'yellow',
            'orange',
            'lightgreen',
            'green',
        ],
    ]],
];
if ($_GET['chart'] == 'pie') {
    $info['option']['options'] = [
        'plugins' => [
            'legend' => [
                'display' => true,
            ],
            'tooltip' => [
                'enabled' => false,
            ],
        ],
    ];
} else {
    $info['option']['options'] = [
        'plugins' => [
            'legend' => [
                'display' => true,
            ],
            'tooltip' => [
                'enabled' => false,
            ],
        ],
        'scales' => [
            'y' => [
                'min' => 0,
                'max' => 20,
                'ticks' => [
                    'stepSize' => 10,
                ],
            ],
        ],
    ];
}
//dd($info);
echo json_encode($info);
