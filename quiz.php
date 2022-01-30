<?php include_once "base.php";

if(!isset($_SESSION['start'])){
    $_SESSION['start']=1;
    $_SESSION['ans']=[];
}

$_SESSION['code']=$_GET['code'];
$id=$Code->find(['code'=>$_GET['code']])['quiz_id'];
$quiz=$Quiz->find($id);
$_SESSION['id']=$id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問卷調查</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fontawesone.css">        
</head>
<body>
<h1 class="container text-center"><?=$quiz['name'];?></h1>
<div class="container ">
<div class='border p-3 my-3'>親愛的學員您好，感謝您幫忙完成下列的問卷調查，您的寶貴意見將對我們的課程改進有相當大的助益，謝謝您！</div>
<form action="api/submit_quiz.php" method="post">
    <div class="subjects-wrap">
        <?php
            $subjects=unserialize($quiz['subjects']);
            //dd($subjects);
            $all=count($subjects);
            $div=$quiz['paginate'];
            $pages=ceil($all/$div);
            $now=$_GET['p']??1;
            $_SESSION['p']=$now;
            $start=($now-1)*$div;
            $rows=array_slice($subjects,$start,$div);
            $_SESSION['seqs']=[];
            for($i=0;$i<$div;$i++){
                $_SESSION['seqs'][]=$start+1+$i;
            }
            $progess=round(($now-1)/$pages,2)*100;
        ?>
            <div class="position-relative border rounded w-100 my-2 text-center font-weight-bolder" 
                 style="height:2rem;line-height:2rem">
                 <div class="bg-success" style="height:100%;width:<?=$progess;?>%"></div>
                 <div class="position-absolute" style="z-index:88;left:50%;top:0"><?=$progess;?>%</div>
                 
            </div>

        <?php


            echo "<ul class='list-group'>";
            foreach($rows as $key =>$sub){
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
                                    <label class='mr-4'><input type="radio" name="ans[<?=$sub['seq'];?>]" value="1">是</label>
                                    <label><input type="radio" name="ans[<?=$sub['seq'];?>]" value="0">否</label>
                                    
                                <?php
                                break;
                                case "single":
                                    foreach($sub['opt'] as $k=>$opt){
                                ?>
                                    <label class='mr-4'>
                                        <input type="radio" name="ans[<?=$sub['seq'];?>]" value="<?=$k;?>">
                                        <?=$opt;?>
                                    </label>
                                    
                                <?php
                                    }
                                break;
                                case "multiple":
                                    foreach($sub['opt'] as $k=>$opt){
                                ?>
                                    <label class='mr-4'>
                                        <input type="checkbox" name="ans[<?=$sub['seq'];?>][]" value="<?=$k;?>">
                                        <?=$opt;?>
                                    </label>
                                   
                                <?php
                                    }
    
                                    if(isset($sub['other'])){
                                    ?>
                                    <label class='mr-4'>
                                        <input type="checkbox" name="ans[<?=$sub['seq'];?>][]" value="<?=$k+1;?>">
                                        其他
                                        <input type="text" name="ans[<?=$sub['seq'];?>][other]" value=''>
                                    </label>
    
                                    <?php
                                    }
    
                                break;
                                case "qa":
                                ?>
                                    <textarea name="ans[<?=$sub['seq'];?>]" class="w-75" style="height:100px"></textarea>
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
            <div class="d-flex paginate text-center mt-3 justify-content-around">
                <?php
                    if(($now-1)>0 && $now!=$pages){
                    ?>
                        <button class='btn btn-info' type="button" onclick="location.href='?code=<?=$_GET['code'];?>&p=<?=$now-1;?>'">
                            上一頁
                        </button>
                    <?php
                    }
                ?>
                <?php
                    if(($now+1)<=$pages){
                    ?>
                        <button class='btn btn-info' type="submit">
                            下一頁
                        </button>
                    <?php
                    }
                ?>
            </div>
            <?php
             if($now==$pages){
             ?>
                <div class="text-center my-3">
                    <input type="submit" value="交問卷" class="btn btn-primary">
                </div>
             <?php   
            }
            ?>
    </div>
</form>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>