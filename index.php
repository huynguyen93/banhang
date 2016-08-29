<?php session_start(); require_once("classSP.php");

$sp = new sp;
//gio hang
if(!isset($_SESSION['sanpham'])) $_SESSION['sanpham'] = array();

// lay san pham theo chung loai, loaisp, idsp, neu ko cho chung loai, chung loai = dien thoai di dong
$idCL = 1; if(isset($_GET['chungloai'])) $idCL = $_GET['chungloai'];
if(isset($_GET['loaisp'])) $idLoai = $_GET['loaisp'];
if(isset($_GET['idSP'])) $idSP = $_GET['idSP'];

//phan trang san pham:
if(isset($_GET['page'])) $current_page = $_GET['page'];
  else $current_page = 1;
$per_page = 30;
$pages_per_group = 5;

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css">
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>
    
<body>
    <div class="container">
        <div class="header row">
            <?php require_once("header.php"); ?>
        </div>
        
        <div class="row">
            <div class="col-md-10"><?php require_once("menuloaisp.php"); ?></div>
            <div class="col-md-2 user-area text-right"><?php require_once("user.php");?></div>
        </div>
        
        <div class="row filter-giohang">
            <div class="col-md-10"><?php require_once("filter.php");?></div>
            <div class="col-md-2 text-right giohang"><?php require_once("giohang.php");?></div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <?php
                if(isset($idLoai) && isset($idCL)) require_once("sptheoloai.php");
                  else require_once('sptheochungloai.php');
                ?>
            </div>
        </div>
        
        <div class="row footer">
        </div>
    </div>

</body>
</html>