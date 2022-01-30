<?php
$name=$_POST['name'];
$qt=$_POST['qt'];

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
            <form action="api/add_quiz.php" method="post" id="QuizForm">
            <input type="hidden" name="name" value="<?=$name;?>">
            <div>
                設定邀請碼:<input type="text" name='code'>
                <input type="radio" name="inv_type" value="sigle" checked>單組 <input type="radio" name="codetype" value="many">多組
            </div>
            <div>
                問卷份數:<input type="number" name='qt' value="1">
            </div>
            <div>
                問卷鎖定:<input type="checkbox" name='locked' >
            </div>
            <div>
                問卷分頁:每頁顯示<input type="number" name='paginate' value="0">題
            </div>

            <?php
        for($i=1;$i<=$qt;$i++){
        ?>
            <div class="row align-items-center my-2 mx-3">
                <div class="seq col-1"><?=$i;?></div>
                <div class="item col-10">
                    <section>
                        <input type="checkbox" name="subjects[<?=$i;?>][require]">本題必填
                    </section>
                    <section class="row" data-seq="<?=$i;?>">
                        <label class='col-2'>問卷題型</label>
                        <div class="col-6 d-flex justify-content-around select-type">
                            <label>
                                <input class="type-items" 
                                       type="radio" 
                                       name="subjects[<?=$i;?>][type]" 
                                       value="none" checked>
                                       未設定
                            </label>
                            <label>
                                <input class="type-items" 
                                       type="radio" 
                                       name="subjects[<?=$i;?>][type]" 
                                       value="tof">
                                       是非題
                                    </label>
                            <label>
                                <input class="type-items" 
                                       type="radio" 
                                       name="subjects[<?=$i;?>][type]" 
                                       value="single">
                                       單選題
                                    </label>
                            <label>
                                <input class="type-items" 
                                       type="radio" 
                                       name="subjects[<?=$i;?>][type]" 
                                       value="multiple">
                                       多選題
                                    </label>
                            <label>
                                <input class="type-items" 
                                       type="radio" 
                                       name="subjects[<?=$i;?>][type]" 
                                       value="qa">
                                       問答題
                                    </label>
                        </div>
                        <input type="hidden" name="subjects[<?=$i;?>][seq]" value="<?=$i;?>">
                    </section>
                    <section class="row">
                        <label class='col-2'>題目說明</label>
                        <div class="col-10">
                            <input class="w-100" type="text" name="subjects[<?=$i;?>][desc]">
                        </div>
                    </section>
                    <section class="options row">

                    </section>
                </div>
                <button type="button" class="del col-1 btn btn-danger" data-del="<?=$i;?>">刪除</button>
            </div>
            <?php
        }
        ?>
            <input id="quizSubmit" type="submit" class='btn btn-primary' value="確定新增">
            </form>
        </div>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
</body>

</html>
<script>
$("#quizSubmit").on("click",(e)=>{
    e.preventDefault()
    let chk=new Array()
    $(".select-type").each((idx,items)=>{
        let type=$(items).find('.type-items:checked').val();
        if(type=='none'){
            chk.push($(items).parents('section').data('seq'))
        }
    })

    if(chk.length>0){
    alert("題目"+chk.toString()+"未選擇題型")

    }else{

        $(".option-text").each((idx,item)=>{
            if($(item).val()==''){
                $(item).remove()
            }
        });
        $("#QuizForm").submit()
    }
})

$(".type-items").on("click", function() {
    let type = $(this).val()
    let seq = $(this).parents('section').data('seq')
    let options

    switch (type) {
        case "none":
            $(this).parents('section').siblings(".options").html("");
            break;
        case "tof":
            options = `
                <label class='col-2'> 題目選項</label>
                <div class="col-8">
                     <label ><input type="radio" disabled> 是</label>
                     <label ><input type="radio" disabled> 否</label>
                </div> `
            $(this).parents('section').siblings(".options").html(options);
            break;
        case "single":
            options = `
                <label class='col-2'>題目選項</label>
                <div class="col-8">
                    <label class="d-block">1. <input class="w-75 option-text" type="text" name="subjects[${seq}][opt][]"></label>
                    <label class="d-block">2. <input class="w-75 option-text" type="text" name="subjects[${seq}][opt][]"></label>
                    <label class="d-block">3. <input class="w-75 option-text" type="text" name="subjects[${seq}][opt][]"></label>
                    <label class="d-block">4. <input class="w-75 option-text" type="text" name="subjects[${seq}][opt][]"></label>
                    <label class="d-block">5. <input class="w-75 option-text" type="text" name="subjects[${seq}][opt][]"></label>
                    <label class="d-block">6. <input class="w-75 option-text" type="text" name="subjects[${seq}][opt][]"></label>
                </div> `
            $(this).parents('section').siblings(".options").html(options);
            break;
        case "multiple":
            options = `
                <label class='col-2'>題目選項</label>
                <div class="col-8">
                    <label class="d-block">1. <input class="w-75 option-text" type="text" name="subjects[${seq}][opt][]"></label>
                    <label class="d-block">2. <input class="w-75 option-text" type="text" name="subjects[${seq}][opt][]"></label>
                    <label class="d-block">3. <input class="w-75 option-text" type="text" name="subjects[${seq}][opt][]"></label>
                    <label class="d-block">4. <input class="w-75 option-text" type="text" name="subjects[${seq}][opt][]"></label>
                    <label class="d-block">5. <input class="w-75 option-text" type="text" name="subjects[${seq}][opt][]"></label>
                    <label class="d-block">6. <input class="w-75 option-text" type="text" name="subjects[${seq}][opt][]"></label>
                    <label class="d-block"><input type="checkbox" name="subjects[${seq}][other]">其他選項</label>
                </div> `
            $(this).parents('section').siblings(".options").html(options);
            break;
        case "qa":
            options = `
                <label class='col-2'>題目選項</label>
                <div class="col-8">
                    <label class="d-block"><input class="w-75" type="text" disabled placeholder="回答填寫於此"></label>  
                </div> `
            $(this).parents('section').siblings(".options").html(options);
            break;
    }
})
</script>