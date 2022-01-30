<?php
include_once "../../base.php";

$log=$Log->find($_POST['id']);
$Log->del($_POST['id']);
$code=$Code->find(['code'=>$log['inv_code']]);
$code['used']--;
$Code->save($code);