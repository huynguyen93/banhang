<?php session_start(); define("BASE_URL", "http://localhost/banhang/") ?>
    <?php if(count($_SESSION['sanpham']) > 0){?>
    <table class="table table-striped" style="width: 500px;">
        <thead>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th class="text-right">Giá</th>
        </thead>
        <?php
        $tong =0; $tongsanpham = 0;
        for($i=0; $i<count($_SESSION['sanpham']); $i++)
        {
        ?>
        <tr>
            <td class="text-left"><?php echo $_SESSION['sanpham'][$i]['name'];?></td>
            <td class="text-center"><?php echo number_format($_SESSION['sanpham'][$i]['quantity'], 0, ',', '.');?></td>
            <td class="text-right"><?php echo number_format($_SESSION['sanpham'][$i]['price']*$_SESSION['sanpham'][$i]['quantity'],0, ',', '.');?>đ</td>
        </tr>
        <?php
            $tong += $_SESSION['sanpham'][$i]['price']*$_SESSION['sanpham'][$i]['quantity'];
            $tongsanpham += $_SESSION['sanpham'][$i]['quantity'];
        }
        ?>
        <tr>
            <td></td>
            <th>Tổng</th>
            <th class="text-right"><?php echo number_format($tong, 0, ',', '.');?>đ</th>
        </tr>
    </table>
    <hr/>
    <a href="<?php echo BASE_URL;?>index.php?action=xemdonhang" class="btn btn-lg btn-default btn-block">Xem chi tiết</a>
    <?php
    } else {
    $tongsanpham = 0;
    ?>
    <h4>Chưa có sản phẩm nào!</h4>
    <?php }?>
</div>