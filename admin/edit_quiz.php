<?php
$name=$_POST['name'];
$num=$_POST['num'];

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

</head>
<body>
    <div class='w-100 p-3 mb-3' style="box-shadow:0 0 5px #ccc">
        <div class="container text-center" style="font-size:32px;font-weight:bolder"><?=$name;?></div>
    </div>
    <div>
        <div class="container">
        <div>
            設定邀請碼:<input type="text" name='code'>
        </div>
        <div>
            問卷份數:<input type="number" name='num' value="<?=$num;?>">
        </div>

        <?php
        for($i=1;$i<=$num;$i++){
        ?>
        <div class="row">
            <div class="seq col-1"><?=$i;?></div>
            <div class="item col-11">
                <section>
                    <input type="checkbox" name="must" value="off">本題必填
                </section>
                <section class="row">
                    <label class='col-2'>問卷題型</label>
                    <div class="col-6 d-flex justify-content-around">
                        <label><input type="radio" name="type<?=$i;?>" value="0" checked>未設定</label>
                        <label><input type="radio" name="type<?=$i;?>" value="1">是非題</label>
                        <label><input type="radio" name="type<?=$i;?>" value="2">單選題</label>
                        <label><input type="radio" name="type<?=$i;?>" value="3">多選題</label>
                        <label><input type="radio" name="type<?=$i;?>" value="4">問答題</label>
                    </div>
                </section>
                <section class="row">
                    <label class='col-2'>題目說明</label>
                    <div class="col-10">
                        <input class="w-100" type="text" name="description">
                    </div>
                </section>
                <section class="row">
                    <label class='col-2'>題目選項</label>
                    <div class="col-8">
                        <label class="d-block">1. <input class="w-75" type="text" name="opt[]"></label>
                        <label class="d-block">2. <input class="w-75" type="text" name="opt[]"></label>
                        <label class="d-block">3. <input class="w-75" type="text" name="opt[]"></label>
                        <label class="d-block">4. <input class="w-75" type="text" name="opt[]"></label>
                        <label class="d-block">5. <input class="w-75" type="text" name="opt[]"></label>
                        <label class="d-block">6. <input class="w-75" type="text" name="opt[]"></label>
                        <label class="d-block"><input type="checkbox" name="other">其他選項</label>
                    </div>
                </section>
            </div>
        </div>
        <?php
        }
        ?>
        <button>確定新增問卷</button>
        </div>
    </div>
 
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
</body>
</html>
<script>

</script>