<?php
include_once "../../base.php";

$id=$_GET['id'];
$logs=$Log->all(['quiz_id'=>$id]);
?>

<div class="modal fade" id="LogModal" tabindex="-1" role="dialog" aria-labelledby="LogModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="LogModalLabel">已填寫問卷列表</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="height:500px;overflow:auto">
      <ul class="list-group">
        <?php
        foreach ($logs as $key => $log) {
            $ans=unserialize($log['ans']);
            foreach($ans as $k=> $a){
                if(is_array($a)){
                    $ans[$k]=join(" ",$a);
                }
            }
            $ans=mb_substr(join(",",$ans),0,10);
        ?>
        <li class="list-group-item list-group-item-action">
            <span><?=$key+1;?>. </span>
            <span><?=$log['inv_code'];?> => </span>
            <span><?=$ans;?>...</span>
            <span><button class="detail-log btn btn-info" data-id="<?=$log['id'];?>">查看</button></span>
            <span><button class="del-log btn btn-danger" data-id="<?=$log['id'];?>">刪除</button></span>
        </li>
        
        <?php }  ?>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>


<script>
$(".del-log").on("click",function(){
    let logId=$(this).data('id');
    $.post("api/del_log.php",{id:logId},()=>{
        $(this).parents('li').remove();
    })
})


</script>