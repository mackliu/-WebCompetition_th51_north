<?php include_once "../base.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>後台管理系統</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fontawesone.css">
    <script src="../js/chart.js"></script>
</head>

<body>
    <div class='w-100 p-3 mb-3' style="box-shadow:0 0 5px #ccc">
        <div class="container text-center" style="font-size:32px;font-weight:bolder">問卷統計</div>
    </div>
    <div>
        <div class="container">
            <?php
                $quiz=$Quiz->find($_GET['id']);

            ?>
            <h1 class="text-center" id="Topic"><?=$quiz['name'];?></h1>
            <div id="Charts">
            <?php
                $subs=unserialize($quiz['subjects']);
                foreach($subs as $key => $sub){
                    if($sub['type']!='qa'){
                        echo "<div class='w-50 mx-auto my-5'>";
                        echo "<div>{$key}. {$sub['desc']}";
                        switch($sub['type']){
                            case 'tof':
                            case 'single':
                                $now="pie";
                                $switch='bar';
                                $btnStr="以長條圖顯示";
                            break;
                            case "multiple":
                                $now='bar';
                                $switch='pie';
                                $btnStr="以圓餅圖顯示";
                            break;
                        }
                        echo "<button class='btn btn-info btn-sm float-right switch-btn' data-chart='{$switch}' data-id='{$quiz['id']}' data-sub='{$key}'>";
                        echo $btnStr;
                        echo "</button>";
                        echo "</div>";
                        echo "<canvas class='ctx' id='chart{$key}' data-chart='{$now}' data-id='{$quiz['id']}' data-sub='{$key}'></canvas>";                        
                        echo "</div>";
                    }
                }
            ?>
            </div>
        </div>
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.js"></script>
</body>

</html>

<script>


//在圖上顯示資訊的外掛程式    
let plugins=[{
afterDraw(chart, args, options) {
    const { ctx } = chart;
    const { type } = chart.config;
    ctx.save();

    chart.data.datasets.forEach((dataset, i) => {
        chart.getDatasetMeta(i).data.forEach((datapoint, idx) => {
            const { x, y } = datapoint.tooltipPosition()
            /**
             * 餅圖:標籤:數字(百分比)
             * 條圖:數字(百分比)
             */
            let text = ''
            let num = 0;
            let sum = 0;
            let percentage = 0;
            let showText = '';
            if (type == 'pie') {
                //取得標籤文字
                text = chart.data.labels[idx];
                //取得數值資料
                num = chart.data.datasets[i].data[idx]
                sum = chart.data.datasets[i].data.reduce((total, n) =>
                    total + n, 0)
                percentage = Math.round((num / sum) * 100);
                showText = `${text}:${num}(${percentage}%)`
            } else {
                text = chart.data.labels[idx];
                num = chart.data.datasets[i].data[idx]
                sum = chart.data.datasets[i].data.reduce((total, n) =>
                    total + n, 0)
                percentage = Math.round((num / sum) * 100);
                showText = `${num}(${percentage}%)`
            }

            //如果計算結果為0就不畫出來
            if (percentage > 0) {
                const textWidth = ctx.measureText(showText).width
                const textHeight = 25;
                ctx.fillStyle = 'rgba(0,0,0,0.8)';
                ctx.fillRect(x - ((textWidth + 10) / 2), y - 5 - textHeight,
                    textWidth + 10, textHeight);

                //外框樣式
                ctx.beginPath();
                ctx.moveTo(x, y);
                ctx.lineTo(x - 5, y - 5);
                ctx.lineTo(x + 5, y - 5);
                ctx.fill();
                ctx.restore();

                //文字內容
                ctx.font = '16px Arial';
                ctx.fillStyle = 'white';
                ctx.fillText(showText, x - (textWidth / 2), y - 16)
                ctx.restore();
            }
        })
    })
}
}]

let charts=new Array();
$("canvas").each((idx,board)=>{
    let id=$(board).data('id')
    let sub_id=$(board).data('sub')
    let chart=$(board).data('chart')
    let ctx=board.getContext('2d')

    $.get("api/get_chart.php",{id,sub_id,chart},(settings)=>{
        let set=JSON.parse(settings)
        set.option.plugins=plugins;

        charts[sub_id]=new Chart(ctx, set.option)

    })
})
console.log(charts)
$(".switch-btn").on("click",function(){
    let id=$(this).data("id")
    let sub_id=$(this).data("sub")
    let chart=$(this).data("chart")
    let canvas=$(this).parent().next().get(0);
    let ctx=canvas.getContext('2d')

    $.get("api/get_chart.php",{id,sub_id,chart},(settings)=>{
        let set=JSON.parse(settings)
        set.option.plugins=plugins;
        console.log(set.option)
        switch(chart){
            case "pie":
                $(this).data("chart",'bar')
                $(this).text("以長條圖顯示")
            break;
            case "bar":
                $(this).data("chart",'pie')
                $(this).text("以圓餅圖顯示")
            break;
        }
        charts[sub_id].destroy()
        charts[sub_id]=new Chart(ctx, set.option)
    })
})

</script>