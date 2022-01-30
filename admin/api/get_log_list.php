<?php
include_once "../../base.php";

$id=$_GET['id'];
$logs=$Log->all(['quiz_id'=>$id]);
?>
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
    <span><button class="del-log btn btn-danger" data-id="<?=$log['id'];?>">刪除</button></span>
    
</li>

<?php
}
?>
</ul>

<script>
$(".del-log").on("click",function(){
    let logId=$(this).data('id');
    $.post("api/del_log.php",{id:logId},()=>{
        $(this).parents('li').remove();
    })
})


</script>