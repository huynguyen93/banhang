<?php
settype($_GET['idSP'], "int");

if(!isset($_GET['idSP']) || $_GET['idSP'] < 1) header("location: index.php?a=sanpham-xem");

$qt->xoasanpham($_GET['idSP']);