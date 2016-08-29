
<nav class="loaisp">
<ul class="nav nav-tabs">
    <?php
    $dsloai = $sp->laydsloaisp($idCL);
    foreach($dsloai as $loaisp)
    {
    ?>
    <li class="<?php if(isset($idLoai) && $idLoai==$loaisp['idLoai']) echo "active active-cat";?>">
        <a style="padding: 8px;" href="index.php?chungloai=<?php echo $idCL;?>&loaisp=<?php echo $loaisp['idLoai']; ?>">
            <?php echo $loaisp['TenLoai'];?>
        </a>
    </li>
    <?php
    }
    ?>
</ul>
</nav>