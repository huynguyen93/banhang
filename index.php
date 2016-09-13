<?php require_once("classSP.php"); require_once("classUser.php");
$sp = new sp;
//gio hang
if(!isset($_SESSION['sanpham'])) $_SESSION['sanpham'] = array();

// lay san pham theo chung loai, loaisp, idsp, neu ko cho chung loai, chung loai = dien thoai di dong
$idCL = 1; if(isset($_GET['chungloai'])) $idCL = $_GET['chungloai'];
$idLoai = 0; if(isset($_GET['loaisp'])) $idLoai = $_GET['loaisp'];

//phan trang san pham:
$current_page = 1; if(isset($_GET['page'])) $current_page = $_GET['page'];
$per_page = 30;
$pages_per_group = 5;

//user
$u = new user;
?>
<!DOCTYPE html>
<html>
<head>
<title>Nhất nghệ</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<base href="<?=BASE_URL?>">
<link href="https://fonts.googleapis.com/css?family=Baloo+Tamma" rel="stylesheet">
<link rel="stylesheet" href="<?php echo BASE_URL;?>css/bootstrap.css">
<link rel="stylesheet" href="<?php echo BASE_URL;?>css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo BASE_URL;?>js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container" id="container">
        <div class="header row">
            <?php include("sanpham_chungloai.php"); ?>
        </div>

        <div class="row menuloai-user">
            <div class="col-md-9"><?php require_once("sanpham_loaisp.php"); ?></div>
            <div class="col-md-3 user-area text-center"><?php  if(isset($_SESSION['user_hoten'])) require_once("user_info.php"); else require_once("user.php");?></div>
        </div>

        <div class="row filter-giohang">
            <?php if(!isset($_GET['action'])){?>
            <div class="col-xs-6 col-md-9"><?php if(isset($_GET['idSP'])) echo ""; else require_once("sanpham_filter.php");?></div>
            <div class="col-xs-6 col-md-3 text-center giohang"><?php require_once("giohang.php");?></div>
            <?php }?>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php
                if(isset($_GET['timkiem'])) require_once("sanpham_timkiem.php");
                elseif(isset($_GET['action']) && $_GET['action'] == 'lienhe') require_once("lienhe.php");
                elseif(isset($_GET['action']) && $_GET['action']=='xemdonhang') require_once("donhang_chitiet.php");
                elseif(isset($_GET['action']) && $_GET['action'] =='thanhcong') require_once("dathangthanhcong.php");
                elseif(isset($_GET['action']) && $_GET['action'] =='thongtinnhanhang') require_once("thongtinnhanhang.php");
                elseif(isset($_GET['idSP'])) require_once("sanpham_chitiet.php");
                else require_once("sanpham_danhsach.php");
                ?>
            </div>
        </div>
    </div>
    <div id="footer" style="background: #222; color: #9d9d9d;">
        <?php require_once("footer.php");?>
    </div>
    <script>
        $(document).ready(function(){
            var bodyheight = $("html").height();
            var containerheight = $("#container").height();
            var footerheight = $("#footer").height();
//            alert("container:"+containerheight + "footer:"+footerheight);
            if(containerheight < bodyheight-footerheight){
                $("#container").height(bodyheight-footerheight);
            }
        });


        function themvaogiohang(){
            $.ajax({
                url: 'process.php',
                type: 'get',
                data: 'themvaogiohang='+$("#themvaogiohang").attr('idsp'),
                success: function(data){
                    $("#sosanpham").html(data);
                }
            });
        }
        function giohangtomtat(){
            $.ajax({
                url: '<?php echo BASE_URL;?>giohang-tomtat.php',
                success: function(data){
                    $("#giohang-tomtat").html(data);
                }
            });
        }
    </script>
</body>
</html>
