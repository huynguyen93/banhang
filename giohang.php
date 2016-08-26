<a href="">Dang nhap</a> / <a href="#">Dang ky</a>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-shopping-cart"></i>Giỏ hàng</h3>
    </div>
    <div class="panel-body">
        <?php if(count($_SESSION['sanpham']) > 0){?>
        <table class="table table-striped">
            <thead>
                <th>Ten san pham</th>
                <th>Quantity</th>
                <th>Gia</th>
            </thead>
            <?php
            $tong =0;
            for($i=0; $i<count($_SESSION['sanpham']); $i++)
            {
            ?>
            <tr>
                <td><?php echo $_SESSION['sanpham'][$i]['name'];?></td>
                <td class="text-center"><?php echo number_format($_SESSION['sanpham'][$i]['quantity'], 0, ',', '.');?></td>
                <td class="text-right"><?php echo number_format($_SESSION['sanpham'][$i]['price']*$_SESSION['sanpham'][$i]['quantity'],0, ',', '.');?>đ</td>
            </tr>
            <?php
                $tong += $_SESSION['sanpham'][$i]['price']*$_SESSION['sanpham'][$i]['quantity'];
            }
            ?>
            <tr>
                <td></td>
                <th>Tong</th>
                <th class="text-right"><?php echo number_format($tong, 0, ',', '.');?>đ</th>
            </tr>
        </table>
        <hr/>
        <a href="#" class="btn btn-lg btn-default btn-block">Thanh toán</a>
        <?php } else {?>
        <h4>Chưa có sản phẩm nào!</h4>
        <?php }?>
    </div>
</div>