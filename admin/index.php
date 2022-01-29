<?php
session_start();
if(!isset($_SESSION['login'])){
    header("location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>後台管理系統</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fontawesone.css">
    <style>
        #modal{
            width:100vw;
            height:100vh;
            position:absolute;
            top:0;
            left:0;
            overflow:hidden;
            display:flex;
            justify-content:center;
            align-items:center;
            background:rgba(150,150,150,0.7);
        }

        #modal form{
            width:300px;
            padding:2rem;
        }
    </style>
</head>
<body>
    <div class='w-100 p-3 mb-3' style="box-shadow:0 0 5px #ccc">
        <div class="container text-center" style="font-size:32px;font-weight:bolder">後台問卷管理系統</div>
    </div>
    <div>
        <div class="container">
            <button id="addQuiz" class="btn btn-primary m-3">新增問卷</button>
            <button id="addQuiz" class="btn btn-primary m-3" onclick="location.href='quiz_list.php'">問卷統計</button>





            <!--隱藏-->
            <div id="modal" class="d-none">
                <form action="edit_quiz.php" method='post' class='bg-light' style="width:30%;min-width:300px;">
                    <label for="subject" class="row">
                        <span class='col-4 text-right'>問卷名稱：</span>
                        <input class='col-8' type="text" name="name" id="name">
                    </label>
                    <label for="num" class="row">
                        <span class='col-4 text-right'>題目數：</span>
                        <input class='col-8' type="number" name="qt" id="qt">
                    </label>
                    <div class="text-center p-3">
                        <input type="submit" value="確定">
                        <input type="reset" value="重置">
                    </div>
                </form>
            </div>
        </div>
    </div>
 
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
</body>
</html>
<script>

$("#addQuiz").on("click",()=>{
    console.log("HI")
    $("#modal").removeClass("d-none");
    $("#modal").addClass("d-flex");
})


</script>