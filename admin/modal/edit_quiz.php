<?php include_once "../../base.php";
$id=$_GET['id'];
$quiz=$Quiz->find($id);
$subjects=unserialize($quiz['subjects']);
$subs=count($subjects);
$code=$Code->find(['quiz_id'=>$quiz['id']]);
?>

<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditModalLabel">編輯問卷</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="height:500px;overflow:auto">
      <div class='w-100 p-3 mb-3' style="box-shadow:0 0 5px #ccc">
        <div class="container text-center" style="font-size:32px;font-weight:bolder"><?=$quiz['name'];?></div>
    </div>
    <div>
        <div class="container">
            <form action="api/add_quiz.php" method="post" id="QuizForm">
            <input type="hidden" name="name" value="<?=$name;?>">
            <div>
                設定邀請碼:<input type="text" name='code' value="<?=$code['code'];?>">
                          <input type="radio" name="inv_type" value="single" <?=($quiz['inv_type']=='single')?'checked':'';?>>單組 
                          <input type="radio" name="codetype" value="many" <?=($quiz['inv_type']=='many')?'checked':'';?>>多組
            </div>
            <div>
                問卷份數:<input type="number" name='qt' value="<?=$quiz['qt'];?>">
            </div>
            <div>
                問卷鎖定:<input type="checkbox" name='locked'  <?=($quiz['locked']=='on')?'checked':'';?>>
            </div>
            <div>
                問卷分頁:每頁顯示<input type="number" name='paginate' value="<?=$quiz['paginate'];?>">題
            </div>

            <?php
        foreach($subjects as $key => $subject){
        ?>
            <div class="row align-items-center my-2 mx-3">
                <div class="seq col-1"><?=$subject['seq'];?></div>
                <div class="item col-10">
                    <section>
                        <input type="checkbox" 
                               name="subjects[<?=$subject['seq'];?>][require]" 
                               <?=(isset($subject['require']))?'checked':'';?>>本題必填
                    </section>
                    <section class="row" data-seq="<?=$subject['seq'];?>">
                        <label class='col-2'>問卷題型</label>
                        <div class="col-6 d-flex justify-content-around select-type">
                            <label>
                                <input class="type-items" 
                                       type="radio" 
                                       name="subjects[<?=$subject['seq'];?>][type]" 
                                       value="none"  <?=($subject['type']=='none')?'checked':'';?>>
                                       未設定
                            </label>
                            <label>
                                <input class="type-items" 
                                       type="radio" 
                                       name="subjects[<?=$subject['seq'];?>][type]" 
                                       value="tof" <?=($subject['type']=='tof')?'checked':'';?>>
                                       是非題
                                    </label>
                            <label>
                                <input class="type-items" 
                                       type="radio" 
                                       name="subjects[<?=$subject['seq'];?>][type]" 
                                       value="single" <?=($subject['type']=='single')?'checked':'';?>>
                                       單選題
                                    </label>
                            <label>
                                <input class="type-items" 
                                       type="radio" 
                                       name="subjects[<?=$subject['seq'];?>][type]" 
                                       value="multiple" <?=($subject['type']=='multiple')?'checked':'';?>>
                                       多選題
                                    </label>
                            <label>
                                <input class="type-items" 
                                       type="radio" 
                                       name="subjects[<?=$subject['seq'];?>][type]" 
                                       value="qa" <?=($subject['type']=='qa')?'checked':'';?>>
                                       問答題
                                    </label>
                        </div>
                        <input type="hidden" name="subjects[<?=$subject['seq'];?>][seq]" value="<?=$subject['seq'];?>">
                    </section>
                    <section class="row">
                        <label class='col-2'>題目說明</label>
                        <div class="col-10">
                            <input class="w-100" 
                                   type="text" 
                                   name="subjects[<?=$subject['seq'];?>][desc]" 
                                   value="<?=$subject['desc'];?>">
                        </div>
                    </section>
                    <section class="options row">
                    <?php
                      switch ($subject['type']) {
                        case "tof":
                          echo "<label class='col-2'> 題目選項</label>";
                          echo "<div class='col-8'>";
                          echo "     <label ><input type='radio' disabled> 是</label>";
                          echo "     <label ><input type='radio' disabled> 否</label>";
                          echo "</div>";
                        break;
                        case "single":
                          echo "<label class='col-2'>題目選項</label>";
                          echo "<div class='col-8'>";
                          echo "    <label class='d-block'>1. <input class='w-75 option-text' type='text' name='subjects[{$subject['seq']}][opt][]'></label>";
                          echo "    <label class='d-block'>2. <input class='w-75 option-text' type='text' name='subjects[{$subject['seq']}][opt][]'></label>";
                          echo "    <label class='d-block'>3. <input class='w-75 option-text' type='text' name='subjects[{$subject['seq']}][opt][]'></label>";
                          echo "    <label class='d-block'>4. <input class='w-75 option-text' type='text' name='subjects[{$subject['seq']}][opt][]'></label>";
                          echo "    <label class='d-block'>5. <input class='w-75 option-text' type='text' name='subjects[{$subject['seq']}][opt][]'></label>";
                          echo "    <label class='d-block'>6. <input class='w-75 option-text' type='text' name='subjects[{$subject['seq']}][opt][]'></label>";
                          echo "</div>";
                        break;
                        case "multiple":
                          echo "<label class='col-2'>題目選項</label>";
                          echo "<div class='col-8'>";
                          echo "    <label class='d-block'>1. <input class='w-75 option-text' type='text' name='subjects[{$subject['seq']}][opt][]'></label>";
                          echo "    <label class='d-block'>2. <input class='w-75 option-text' type='text' name='subjects[{$subject['seq']}][opt][]'></label>";
                          echo "    <label class='d-block'>3. <input class='w-75 option-text' type='text' name='subjects[{$subject['seq']}][opt][]'></label>";
                          echo "    <label class='d-block'>4. <input class='w-75 option-text' type='text' name='subjects[{$subject['seq']}][opt][]'></label>";
                          echo "    <label class='d-block'>5. <input class='w-75 option-text' type='text' name='subjects[{$subject['seq']}][opt][]'></label>";
                          echo "    <label class='d-block'>6. <input class='w-75 option-text' type='text' name='subjects[{$subject['seq']}][opt][]'></label>";
                          echo "    <label class='d-block'><input type='checkbox' name='subjects[{$subject['seq']}][other]'>其他選項</label>";
                          echo "</div>";
                        break;
                        case "qa":
                          echo "<label class='col-2'>題目選項</label>";
                          echo "<div class='col-8'>";
                          echo "    <label class='d-block'>";
                          echo "        <input class='w-75' type='text' disabled placeholder='回答填寫於此'>";
                          echo "    </label>";
                          echo "</div>";

                        break;
                        }
                      ?>
                    </section>
                </div>
                <button type="button" class="del col-1 btn btn-danger" data-del="<?=$subject['seq'];?>">刪除</button>
            </div>
            <?php
        }
        ?>
            <input id="quizSubmit" type="submit" class='btn btn-primary' value="確定新增">
            </form>
        </div>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="save-quiz btn btn-primary">儲存</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
      </div>
    </div>
  </div>
</div>

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
                    <label class="d-block">
                        <input class="w-75" type="text" disabled placeholder="回答填寫於此">
                    </label>  
                </div> `
            $(this).parents('section').siblings(".options").html(options);
            break;
    }
})
</script>