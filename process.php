<?php 
require_once("classSP.php"); $sp = new sp;
    
require_once("classUser.php"); $u = new user;

if(isset($_GET['themvaogiohang'])) $sp->themspvaogiohang($_GET['themvaogiohang']);

elseif(isset($_POST['guicomment'])) $sp->binhluan();

elseif(isset($_GET['action']) && $_GET['action'] =='thoat') $u->thoat();

elseif(isset($_POST['action']) && $_POST['action']=='dangky') $u->dangky();

elseif(isset($_POST['action']) && $_POST['action']=='dangnhap') $u->dangnhap();

elseif(isset($_POST['action']) && $_POST['action']=='doipass') $u->doimatkhau();

elseif(isset($_GET['capnhatgiohang'])) $sp->capnhatgiohang();

elseif(isset($_GET['xoasanpham'])) $sp->xoaspkhoigiohang($_GET['xoasanpham']);

elseif(isset($_POST['btn-dathang'])) $sp->dathang();