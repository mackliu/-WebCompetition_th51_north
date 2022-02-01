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
        <h1 class="text-center" id="Topic"></h1>
        <div id="Charts"></div>
    </div>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
</body>
</html>

<script>

$.get("api/stastic.php",
      {id:<?=$_GET['id'];?>},
      (dataset)=>{

        let sets=JSON.parse(dataset)

        Object.keys(sets).forEach(idx=>{
            let dom=`<div class='w-50 m-auto'>
                        <div>${idx}. ${sets[idx].desc}</div>
                     </div>`;
            let block=document.createElement('div')
                block.classList.add('w-50')
                block.classList.add('mx-auto')
                block.classList.add('my-5')
            let subject=document.createElement('div')
                subject.appendChild(document.createTextNode(`${idx}. ${sets[idx].desc}`))
            block.appendChild(subject)
            

            let canvas = document.createElement("canvas")
                canvas.setAttribute("class", "ctx")
            let ctx = canvas.getContext('2d')
            block.appendChild(canvas)
            $("#Charts").append(block)
            switch(sets[idx].type){
                case "tof":
                case "single":
                    render('pie',sets[idx].labels,sets[idx].data,ctx)    
                break;
                case "multiple":
                    render('bar',sets[idx].labels,sets[idx].data,ctx)
                break;
            }
        })
      })

function render(type,labels,data,canvas){

    new Chart(canvas,{
        type:type,
        data:{
            labels:labels,
            datasets:[{
                label:'',
                data:data,
                borderWidth:1,
                backgroundColor:[
                    'skyblue',
                    'blue',
                    'lightblue',
                    'yellow',
                    'orange',
                    'lightgreen',
                    'green',
                ]
            }]
        },
        options:{
            plugins:{
                legend:{
                    display:true,
                },
                tooltip:{
                    enabled:false
                }
            },
            scales: {
                x: {
                  title: {
                    display: true,
                    text: 'Month'
                  }
                },
                y: {
                  title: {
                    display: true,
                    text: 'Value'
                  },
                  min: 0,
                  max: 20,
                  ticks: {
                    // forces step size to be 50 units
                    stepSize: 10
                  }
                },
            },
        },
        plugins:[{

            afterDraw(chart,args,options){
                const { ctx }= chart;
                const { type }= chart.config;
                ctx.save();

                chart.data.datasets.forEach((dataset,i)=>{
                    chart.getDatasetMeta(i).data.forEach((datapoint,idx)=>{
                        const {x,y}=datapoint.tooltipPosition()
                        /**
                         * 餅圖:標籤:數字(百分比)
                         * 條圖:數字(百分比)
                         */
                        let text=''
                        let num =0;
                        let sum =0;
                        let percentage=0;
                        let showText='';
                        if(type=='pie'){
                            //取得標籤文字
                            text=chart.data.labels[idx];
                            //取得數值資料
                            num=chart.data.datasets[i].data[idx]
                            sum=chart.data.datasets[i].data.reduce((total,n)=>total+n,0)
                            percentage=Math.round((num/sum)*100);
                            showText=`${text}:${num}(${percentage}%)`
                        }else{
                            text=chart.data.labels[idx];
                            num=chart.data.datasets[i].data[idx]
                            sum=chart.data.datasets[i].data.reduce((total,n)=>total+n,0)
                            percentage=Math.round((num/sum)*100);
                            showText=`${num}(${percentage}%)`
                        }

                        //如果計算結果為0就不畫出來
                        if(percentage>0){
                            const textWidth=ctx.measureText(showText).width
                            const textHeight=25;
                            ctx.fillStyle='rgba(0,0,0,0.8)';
                            ctx.fillRect(x-((textWidth+10) /2),y-5-textHeight,textWidth+10,textHeight);
                            
                            //外框樣式
                            ctx.beginPath();
                            ctx.moveTo(x,y);
                            ctx.lineTo(x-5,y-5);
                            ctx.lineTo(x+5,y-5);
                            ctx.fill();
                            ctx.restore();
    
                            //文字內容
                            ctx.font='16px Arial';
                            ctx.fillStyle='white';
                            ctx.fillText(showText,x - (textWidth/2),y-16)
                            ctx.restore();
                        }
                    })
                })
            }
        }]
    })
}


</script>