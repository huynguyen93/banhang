<?php
if(isset($_GET['a'])) {$array = explode('-', $_GET['a']); $action=$array[0];}

?>
<ul id="menu-qt" style="">
    <li <?php if(!isset($_GET['a']) )echo " class= 'active'"; ?>><a href="index.php">Admin dashboard</a></li>
    <li><a href="../index.php">Home page</a></li>
    <li class="<?php if(isset($_GET['a']) && $action == 'donhang') echo 'active'; ?>">
        <a href="#">Đơn hàng <span class="caret"></span></a>
        <ul class="">
            <li class=""><a href="index.php?a=donhang-duyet">Đang chờ duyệt</a></li>
            <li><a href="index.php?a=donhang-xem">Đã duyệt</a></li>
        </ul>
    </li>
    <li class="<?php if(isset($_GET['a']) && $action == 'chungloai') echo 'active'; ?>">
        <a href="#">Chủng loại <span class="caret"></span></a>
        <ul class="">
            <li class=""><a href="index.php?a=chungloai-xem">Xem danh sách</a></li>
            <li><a href="index.php?a=chungloai-them">Thêm mới</a></li>
        </ul>
    </li>
    <li class="<?php if(isset($_GET['a']) && $action == 'loaisp') echo 'active'; ?>">
        <a href="#">Loại sản phẩm <span class="caret"></span></a>
        <ul class="">
            <li><a href="index.php?a=loaisp-xem">Xem danh sách</a></li>
            <li><a href="index.php?a=loaisp-them">Thêm mới</a></li>
        </ul>
    </li>
    <li class="<?php if(isset($_GET['a']) && $action == 'sanpham') echo 'active'; ?>">
        <a href="#">Sản phẩm <span class="caret"></span></a>
        <ul class="">
            <li><a href="index.php?a=sanpham-xem">Xem danh sách</a></li>
            <li><a href="index.php?a=sanpham-them">Thêm mới</a></li>
        </ul>
    </li>
    <li class="<?php if(isset($_GET['a']) && $action == 'binhluan') echo 'active'; ?>">
        <a href="#">Bình luận <span class="caret"></span></a>
        <ul class="">
            <li><a href="index.php?a=binhluan-duyet">Chờ xét duyệt</a></li>
            <li><a href="index.php?a=binhluan-xem">Đã duyệt</a></li>
        </ul>
    </li>
    <li class="<?php if(isset($_GET['a']) && $action == 'user') echo 'active'; ?>">
        <a href="#">Users <span class="caret"></span></a>
        <ul class="">
            <li><a href="index.php?a=user-xem">Xem danh sách</a></li>
            <li><a href="index.php?a=user-them">Thêm mới</a></li>
        </ul>
    </li>
    <li><a href="../process.php?action=thoat">Logout</a></li>
</ul>
<script>
    $(document).ready(function(){
        $("li.active").children("ul").show();
        $("#menu-qt > li").click(function(){
            $(this).toggleClass('active');
            $(this).children("ul").slideToggle();
        });
    });
</script>