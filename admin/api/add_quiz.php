<?php
include_once "../../base.php";

dd($_POST);
$_POST['subjects']=serialize($_POST['subjects']);
$inv_codes['code']=$_POST['code'];

unset($_POST['code']);
$Quiz->save($_POST);

$inv_codes['quiz_id']=$Quiz->pdo->lastInsertId();
$Code->save($inv_codes);

//to("../index.php");