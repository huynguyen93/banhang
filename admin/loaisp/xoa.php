<?php

if(!isset($_GET['idLoai'])) header("location: index.php?c=loaisp&a=xem");

settype($_GET['idLoai'], "int");

if($_GET['idLoai'] == 0) header("location: index.php?c=loaisp&a=xem");

$qt->xoaloaisp($_GET['idLoai']);