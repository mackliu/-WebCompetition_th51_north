<?php include_once "../base.php";
$quiz=$Quiz->find($_SESSION['id']);
$p=$_SESSION['p'];

$subs=count(unserialize($quiz['subjects']));

if($quiz['paginate']*$p<$subs){
    $_SESSION['ans']=$_SESSION['ans']+$_POST['ans'];

to("../quiz.php?code={$_SESSION['code']}&p=".($p+1));
}else{
    $_SESSION['ans']=$_SESSION['ans']+$_POST['ans'];
   // dd($_SESSION);
    $Log->save([
        'inv_code'=>$_SESSION['code'],
        'quiz_id'=>$_SESSION['id'],
        'ans'=>serialize($_SESSION['ans'])
    ]);
    $code=$Code->find(['code'=>$_SESSION['code'],'quiz_id'=>$_SESSION['id']]);
    $code['used']++;
    $Code->save($code);
    unset($_SESSION['start']);
to("../index.php");
}