<?php
session_start();
if($_POST['acc']=='admin' && $_POST['pw']=='1234'){
    $_SESSION['login']=1;
    header('location:../index.php');    
    exit();
}
?>
<script>
    alert("帳號或密碼錯誤");
    location.href='../index.php';
</script>