<?php session_start(); require_once("classSP.php");

$sp = new sp;

if(!isset($_SESSION['sanpham'])) $_SESSION['sanpham'] = array();

if(isset($_GET['c'])) $c = $_GET['c']; else $c = 'sanpham';

if(isset($_GET['a'])) $a = $_GET['a']; else $a = 'main';

if(isset($_GET['page'])) $current_page = $_GET['page'];
  else $current_page = 1;

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
        
        <div class="row user-area">
            <a href="#" class="pull-right"> dang nhap</a>
        </div>
        
        <div class="row">
            <?php require_once("menuloaisp.php"); ?>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <?php
                if($c == 'sanpham' && $a  == 'chitiet') require_once("chitiet.php");
                elseif($c == 'sanpham' && $a  == 'sptheochungloai') require_once("sptheochungloai.php");
                elseif($c == 'sanpham' && $a  == 'sptheoloai') require_once("sptheoloai.php");
                else require_once('main.php');
                ?>
            </div>
            
            <div class="col-md-4">
                <?php include("giohang.php"); ?>
            </div>
        </div>
        
        <div class="row footer">
        </div>
    </div>

</body>
</html>