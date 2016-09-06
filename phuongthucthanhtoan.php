<?php require_once("classSP.php"); $sp = new sp;
if(isset($_GET['pttt'])){
    echo $sp->layformthanhtoan($_GET['pttt']);
}