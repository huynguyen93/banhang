<?php

if(!isset($_GET['idCL'])) header("location: index.php?c=chungloai&a=xem");

settype($_GET['idCL'], "int");

if($_GET['idCL'] == 0) header("location: index.php?c=chungloai&a=xem");

$qt->xoachungloai($_GET['idCL']);