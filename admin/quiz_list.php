<?php include_once "../base.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問卷系統後台</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fontawesone.css">
</head>
<body>
<div class='w-100 p-3 mb-3' style="box-shadow:0 0 5px #ccc">
        <div class="container text-center" style="font-size:32px;font-weight:bolder">
        後台問卷管理系統
    </div>
</div>
<div>
    <div class="container">
    <?php
        $quizs=$Quiz->all();
    ?>
    <ul class="list-group">
    <?php
        foreach($quizs as $key => $quiz){
    ?>
        <li class="d-flex list-group-item list-group-item-action ">
            <div class="col-md-5"><?=$quiz['name'];?></div>
            <div class="col-md-1">
                <?php
                    echo $Code->math('sum','used',['quiz_id'=>$quiz['id']]);
                    echo "/" . $quiz['qt'];
                ?>  
            </div>
            <div class="btns col-md-6">
                <button  class="btn btn-sm btn-primary">統計結果</button>
                <button  class="btn btn-sm btn-info">查看問卷</button>
                <button  class="btn btn-sm btn-warning">複製問卷</button>
                <button  class="btn btn-sm btn-success">問卷輸出</button>
                <button  data-id="<?=$quiz['id'];?>" class="btn btn-sm btn-danger">刪除問卷</button>
            </div>
        </li>
    <?php
        }
    ?>
    </ul>
    </div>
</div>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>    
</body>
</html>

<script>

//刪除問卷功能
$(".btn-danger").on('click',(e)=>{
 $.post("api/del_quiz.php",{id:$(e.target).data("id")},()=>{
    $(e.target).parents("li").remove()
 })
})


</script>
