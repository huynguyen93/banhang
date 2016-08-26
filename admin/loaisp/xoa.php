<?php

if(!isset($_GET['idCL']) || $_GET['idCL'] < 1) header("location: index.php?c=chungloai&a=xem");

$qt->xoachungloai($_GET['idCL']);