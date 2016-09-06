<?php require_once("classquantri.php");

$qt = new quantri();

$a = 'home';

if(isset($_GET['a'])) $a = $_GET['a'];

//config phân trang:
$per_page = 10;
$current_page = 1;
if(isset($_GET['page'])) $current_page = $_GET['page'];
$pages_per_group = 5;


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
    
<div>
    <div class="row" style="height: 5px; background: #222; margin: 0; padding:0;"></div>
    <div class="row" style="margin:0;">
        <nav class="col-md-2" style="padding:0;">
            <?php include("nav.php");?>
        </nav>


        <div class="col-md-9 content">
            <div style="padding-left:25px">
            <?php
            if($a == 'donhang-xem') require_once("donhang/xem.php");
            elseif($a == 'donhang-duyet') require_once("donhang/duyet.php");
            elseif($a == 'donhang-chitiet') require_once("donhang/chitiet.php");
            elseif($a == 'donhang-xoa') require_once("donhang/xoa.php");
                
            elseif($a == 'chungloai-xem') require_once("chungloai/xem.php");
            elseif($a == 'chungloai-them') require_once("chungloai/them.php");
            elseif($a == 'chungloai-sua') require_once("chungloai/sua.php");
            elseif($a == 'chungloai-xoa') require_once("chungloai/xoa.php");

            elseif($a == 'loaisp-xem') require_once("loaisp/xem.php");
            elseif($a == 'loaisp-them') require_once("loaisp/them.php");
            elseif($a == 'loaisp-sua') require_once("loaisp/sua.php");
            elseif($a == 'loaisp-xoa') require_once("loaisp/xoa.php");

            elseif($a == 'sanpham-xem') require_once("sanpham/xem.php");
            elseif($a == 'sanpham-them') require_once("sanpham/them.php");
            elseif($a == 'sanpham-sua') require_once("sanpham/sua.php");
            elseif($a == 'sanpham-xoa') require_once("sanpham/xoa.php");

            elseif($a == 'binhluan-duyet') require_once("binhluan/duyet.php");
            elseif($a == 'binhluan-xem') require_once("binhluan/xem.php");
            elseif($a == 'binhluan-sua') require_once("binhluan/sua.php");
            elseif($a == 'binhluan-xoa') require_once("binhluan/xoa.php");
            ?>
            </div>
        </div>

    </div>
</div>
<script>
    function xacnhan(){
        confirm("Bạn có chắc muốn xóa?");
    }
</script>
</body>
</html>