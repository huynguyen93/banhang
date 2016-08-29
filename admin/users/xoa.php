<?php
if(!isset($_GET['idSP'])) header("location: index.php?c=sanpham&a=xem");

settype($_GET['idSP'], "int");

if($_GET['idSP'] == 0) header("location: index.php?c=sanpham&a=xem");

$qt->xoasanpham($_GET['idSP']);