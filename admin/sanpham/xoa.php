<?php

if(!isset($_GET['idLoai']) || $_GET['idLoai'] < 1) header("location: index.php?c=loaisp&a=xem");

$qt->xoaloaisp($_GET['idLoai']);