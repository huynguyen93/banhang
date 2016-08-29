<ul class="nav navbar-nav side-menu">
    <li><a href="#">Admin dashboard</a></li>
    <li>
        <a href="index.php?c=chungloai&a=xem">Chủng loại <span class="caret"></span></a>
        <ul class="nav ">
            <li class="<?php if($c == 'chungloai') echo "active"; ?>"><a href="index.php?c=chungloai&a=xem">Xem danh sách</a></li>
            <li><a href="index.php?c=chungloai&a=them">Thêm mới</a></li>
        </ul>
    </li>
    <li>
        <a href="index.php?c=loaisp&a=xem">Loại sản phẩm <span class="caret"></span></a>
        <ul class="nav ">
            <li><a href="index.php?c=loaisp&a=xem">Xem danh sách</a></li>
            <li><a href="index.php?c=loaisp&a=them">Thêm mới</a></li>
        </ul>
    </li>
    <li>
        <a href="index.php?c=sanpham&a=xem">Sản phẩm <span class="caret"></span></a>
        <ul class="nav ">
            <li><a href="index.php?c=sanpham&a=xem">Xem danh sách</a></li>
            <li><a href="#">Thêm mới</a></li>
        </ul>
    </li>
    <li>
        <a href="#">Users <span class="caret"></span></a>
        <ul class="nav ">
            <li><a href="#">Xem danh sách</a></li>
            <li><a href="#">Thêm mới</a></li>
        </ul>
    </li>
    <li>
        <a href="#">Tin tức <span class="caret"></span></a>
        <ul class="nav ">
            <li><a href="#">Xem danh sách</a></li>
            <li><a href="#">Thêm mới</a></li>
        </ul>
    </li>
    <li><a href="#">Logout</a></li>
</ul>