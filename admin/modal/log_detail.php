
<?php include_once "../../base.php";
$id=$_GET['id'];
$log=$Log->find($id);
$quiz=$Quiz->find($log['quiz_id']);
$ans=unserialize($log['ans']);
?>
<div class="modal fade" id="LogDetail" tabindex="-1" role="dialog" aria-labelledby="LogDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="LogDetailLabel">問卷內容</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="height:500px;overflow:auto">
      <h1 class="container text-center"><?=$quiz['name'];?></h1>
<div class="container ">
<form action="api/submit_quiz.php" method="post">
    <div class="subjects-wrap">
        <?php
            $subjects=unserialize($quiz['subjects']);
            echo "<ul class='list-group'>";
            foreach($subjects as $key =>$sub){
            ?>
                <li class='list-group-item list-group-item-action'>
                    <div class="sub-text">
                        <span class='text-danger'>
                            <?=(isset($sub['require'])?'*':'&nbsp;');?>
                        </span>
                        <span><?=$sub['seq'];?>.</span>
                        <span class="ml-2 w-75">
                            <?=$sub['desc'];?>
                        </span>
                    </div>
                    <div class="sub-opts mt-2">
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span class="ml-3 w-75">
                        <?php
                            switch($sub['type']){
                                case "tof":
                                ?>
                                    <label class='mr-4'>
                                        <input type="radio" name="ans[<?=$sub['seq'];?>]" value="1" <?=($ans[$key]==1)?'checked':'';?>>是
                                    </label>
                                    <label>
                                        <input type="radio" name="ans[<?=$sub['seq'];?>]" value="0" <?=($ans[$key]==0)?'checked':'';?>>否
                                    </label>
                                    
                                <?php
                                break;
                                case "single":
                                    foreach($sub['opt'] as $k=>$opt){
                                ?>
                                    <label class='mr-4'>
                                        <input type="radio" name="ans[<?=$sub['seq'];?>]" value="<?=$k;?>" <?=($ans[$key]==$k)?'checked':'';?>>
                                        <?=$opt;?>
                                    </label>
                                    
                                <?php
                                    }
                                break;
                                case "multiple":
                                    foreach($sub['opt'] as $k=>$opt){
                                ?>
                                    <label class='mr-4'>
                                        <input type="checkbox" name="ans[<?=$sub['seq'];?>][]" value="<?=$k;?>"  <?=(in_array($k,$ans[$key]))?'checked':'';?>>
                                        <?=$opt;?>
                                    </label>
                                   
                                <?php
                                    }
    
                                    if(isset($sub['other'])){
                                    ?>
                                    <label class='mr-4'>
                                        <input type="checkbox" name="ans[<?=$sub['seq'];?>][]" value="<?=$k+1;?>" <?=(in_array('other',$ans[$key]))?'checked':'';?>>
                                        其他
                                        <input type="text" name="ans[<?=$sub['seq'];?>][other]" value=' <?=(isset($ans[$key]['other']))?$ans[$key]['other']:'';?>'>
                                    </label>
    
                                    <?php
                                    }
    
                                break;
                                case "qa":
                                ?>
                                    <textarea name="ans[<?=$sub['seq'];?>]" class="w-75" style="height:100px"><?=$ans[$key];?></textarea>
                                <?php
                            }
                        ?>
                    </span>
                    </div>
                </li>
            <?php
            }
            echo "</ul>";
            ?>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
      </div>
    </div>
  </div>
</div>
<script>
$("#LogDetail").on("hidden.bs.modal",()=>{
    $.get("modal/log_list.php",
    {id:<?=$quiz['id'];?>},
    (list_modal)=>{
        $("LogDetail").modal("dispose")
        $("#modal").html(list_modal)
        $("#LogModal").modal("show")
    })
})


</script>
