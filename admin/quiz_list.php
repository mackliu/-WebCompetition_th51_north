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
            <button class="btn btn-success btn-lg my-2">問卷輸入</button>
            <?php
        $quizs=$Quiz->all();
    ?>
            <ul class="list-group">
                <?php
        foreach($quizs as $key => $quiz){
    ?>
                <li class="d-flex list-group-item list-group-item-action ">
                    <div class="name col-md-5"><?=$quiz['name'];?></div>
                    <div class="col-md-1">
                        <?php
                    echo $Code->math('sum','used',['quiz_id'=>$quiz['id']]);
                    echo "/" . $quiz['qt'];
                ?>
                    </div>
                    <div class="btns col-md-6" data-id="<?=$quiz['id'];?>">
                        <button class="stastic-quiz btn btn-sm btn-primary">統計結果</button>
                        <button class="detail-quiz btn btn-sm btn-info">查看問卷</button>
                        <button class="double-quiz btn btn-sm btn-warning">複製問卷</button>
                        <button class="output-quiz btn btn-sm btn-success">問卷輸出</button>
                        <button class="del-quiz btn btn-sm btn-danger">刪除問卷</button>
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
$(".del-quiz").on('click', (e) => {
    let name = $(e.target).parent().siblings('.name').text();
    let chk = confirm(`確定刪除${name}問卷?`);
    if (chk) {
        $.post("api/del_quiz.php", {
            id: $(e.target).parent().data("id")
        }, () => {
            $(e.target).parents("li").remove()
        })
    }
})

//問卷輸出功能
$(".output-quiz").on('click',(e)=>{
    $.get("api/output_quiz.php",
          {id:$(e.target).parent().data('id')},
          (res)=>{
              alert("已輸出問卷完成")
          })
})
</script>