<?php

if(isset($_GET['idloai'])) $idloai = $_GET['idloai'];

?>
<nav class="loaisp">
    <ul class="nav nav-tabs">
        <?php
        $dsloai = $sp->laydsloaisp(1);
        foreach($dsloai as $loaisp)
        {
        ?>
        <li class="<?php if($idloai==$loaisp['idLoai']) echo "active active-cat";?>"><a href="index.php?c=sanpham&a=sptheoloai&idloai=<?php echo $loaisp['idLoai']; ?>"><?php echo $loaisp['TenLoai'];?></a></li>
        <?php
        }
        ?>
    </ul>
</nav>