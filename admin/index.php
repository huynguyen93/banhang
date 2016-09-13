<?php require_once("classquantri.php");
if(!isset($_SESSION['user_group']) ||  $_SESSION['user_group'] != 1) header("Location: ../index.php");

$qt = new quantri();

$a = 'home';

if(isset($_GET['a'])) $a = $_GET['a'];

//phân trang:
$per_page = 10;
$current_page = 1; if(isset($_GET['page'])) $current_page = $_GET['page'];
$pages_per_group = 5;

?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>Quản trị</title>
<link rel="stylesheet" href="<?php echo BASE_URL;?>css/bootstrap.css"> 
<link rel="stylesheet" href="<?php echo BASE_URL;?>css/style.css">
<script src="<?php echo BASE_URL;?>js/jquery.js"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'.tinymce' });</script>
</head>
<body>
    
<div>
    <div class="row" style="margin:0;">
        <nav class="col-md-2" id="sidebar" style="padding:0;">
            <?php include("nav.php");?>
        </nav>


        <div class="col-md-9 content" id="content">
            <div style="padding-left:25px">
            <?php
            $arr = explode('-', $a);
            if(count($arr)==2) require_once("{$arr[0]}/{$arr[1]}.php");
            else echo "<h2>Chào {$_SESSION['user_hoten']}!</h2>";
            ?>
            <hr/>
            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function(){
        var h = $("html").height();
        var h2 = $("#content").height();
        if(h2>h) $("nav#sidebar").height(h2);
          else $("nav#sidebar").height(h);
    });
    function xacnhan(){
        return confirm("Bạn có chắc muốn xóa?");
    }
</script>
</body>
</html>