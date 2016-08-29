<?php session_start(); require_once("classquantri.php"); $qt = new quantri();
if(isset($_GET['c'])) $c = $_GET['c']; else $c = 'stats';
if(isset($_GET['a'])) $a = $_GET['a']; else $a = 'index';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<link rel="stylesheet" href="../css/bootstrap.css"> 
<link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js"></script>
</head>
<body>
    
<div class="container">
    <nav class="navbar navbar-default" style="margin-bottom: 0;">
        <?php include("nav.php");?>
    </nav>
<div class="row">
    
    
    
    <div class="col-md-8 content">
        <?php
        
        if($c == 'chungloai' && $a == 'xem') require_once("chungloai/xem.php");
        elseif($c == 'chungloai' && $a == 'them') require_once("chungloai/them.php");
        elseif($c == 'chungloai' && $a == 'sua') require_once("chungloai/sua.php");
        elseif($c == 'chungloai' && $a == 'xoa') require_once("chungloai/xoa.php");
        
        elseif($c == 'loaisp' && $a == 'xem') require_once("loaisp/xem.php");
        elseif($c == 'loaisp' && $a == 'them') require_once("loaisp/them.php");
        elseif($c == 'loaisp' && $a == 'sua') require_once("loaisp/sua.php");
        elseif($c == 'loaisp' && $a == 'xoa') require_once("loaisp/xoa.php");
		
		elseif($c == 'sanpham' && $a == 'xem') require_once("sanpham/xem.php");
        elseif($c == 'sanpham' && $a == 'them') require_once("sanpham/them.php");
        elseif($c == 'sanpham' && $a == 'sua') require_once("sanpham/sua.php");
        elseif($c == 'sanpham' && $a == 'xoa') require_once("sanpham/xoa.php");
        ?>
    </div>

</div>
</div>
<script>
</script>
</body>
</html>