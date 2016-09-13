<div class="panel panel-default" style="">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-8">
                <h2>Thông tin đơn hàng</h2>
                <?php 
                if(count($_SESSION['sanpham']) > 0)
                {
                ?>
                <form method="get" action="process.php">
                <table class="table table-striped">
                    <thead>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-right">Đơn giá</th>
                        <th class="text-right">Thành tiền</th>
                        <th class="text-center">Hành động</th>
                    </thead>
                    <?php
                    $tong =0;
                    for($i=0; $i<count($_SESSION['sanpham']); $i++)
                    {
                    ?>
                    <tr>
                        <td><?php echo $i+1; ?></td>
                        <td ><a class="text-primary" href="<?php echo BASE_URL;?>index.php?idSP=<?php echo $_SESSION['sanpham'][$i]['idsp'];?>"><?php echo $_SESSION['sanpham'][$i]['name'];?></a></td>
                        <td class="text-center"><input class="soluong" style="width:50px; text-align:center" type="text" name="soluong<?php echo $i?>" value="<?php echo number_format($_SESSION['sanpham'][$i]['quantity'], 0, ',', '.');?>"></td>
                        <td class="text-right"><?php echo number_format($_SESSION['sanpham'][$i]['price']);?></td>
                        <td class="text-right"><?php echo number_format($_SESSION['sanpham'][$i]['price']*$_SESSION['sanpham'][$i]['quantity'],0, ',', '.');?>đ</td>
                        <td class="text-center"><a class="text-danger" href="<?php echo BASE_URL;?>process.php?xoasanpham=<?php echo $i;?>">Xóa <i class="glyphicon glyphicon-trash"></i></a></td>
                    </tr>
                    <?php
                        $tong += $_SESSION['sanpham'][$i]['price']*$_SESSION['sanpham'][$i]['quantity'];
                    }
                    ?>
                    <tr>
                        <td></td>
                        <th class="text-right" colspan="3">Tổng cộng</th>
                        <th class="text-right"><?php echo number_format($tong, 0, ',', '.');?>đ</th>
                        <th></th>
                    </tr>
                </table>
                <button class="btn btn-default" type="submit" name="capnhatgiohang">Cập nhật</button>
                <a href="<?php echo BASE_URL;?>index.php?action=thongtinnhanhang" class="btn btn-success">Tiếp tục</a>
                </form>
                <hr/>
                <?php 
                } else {
                ?>
                
                <h4>Chưa có sản phẩm nào!</h4>
                
                <?php 
                }
                ?>
            </div>
        </div>
    </div>
</div>
<hr/>