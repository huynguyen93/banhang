<?php

$danhsachusers = $qt->laydsusers($totalrows, $current_page, $per_page);

?>

<h2 class="">Danh sách users </h2>
<?php if(isset($_SESSION['fail'])) echo "<p class='alert alert-danger' style='padding:10px;'>{$_SESSION['fail']}</p>"; unset($_SESSION['fail']);?>
<?php if(isset($_SESSION['message'])) echo "<p class='alert-success' style='padding:10px;'>{$_SESSION['message']}</p>"; unset($_SESSION['message']);?>
<table class="table table-striped" style="margin-bottom: 0px;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Điện thoại</th>
            <th>Ngày đăng ký</th>
            <th>Group</th>
            <th><a class="btn btn-sm btn-success btn-them" href="index.php?a=user-them"><span class="glyphicon glyphicon-plus"></span>Thêm mới</a></th>
        </tr>
    </thead>
    <?php foreach($danhsachusers as $user){?>
    <tr>
        <td><?php echo $user['idUser']; ?></td>
        <td><?php echo $user['HoTen']; ?></td>
        <td><?php echo $user['Email']; ?></td>
        <td><?php if(strlen($user['DiaChi']) > 30) echo substr($user['DiaChi'], 0 , strpos($user['DiaChi'], ' ', 25))."...<i class='glyphicon glyphicon glyphicon-plus-sign'></i>"; else echo $user['DiaChi']; ?></td>
        <td><?php echo $user['DienThoai']; ?></td>
        <td><?php echo date("d-my-Y", strtotime($user['NgayDangKy'])); ?></td>
        <td><?php if($user['idGroup'] == 1) echo "Admin"; else echo "User"; ?></td>
        <td><a href="index.php?a=user-sua&idUser=<?php echo $user['idUser']; ?>">Sửa</a> / <a onclick="xacnhan()" href="index.php?a=user-xoa&idUser=<?php echo $user['idUser'];?>">Xóa</a></td>
    </tr>
    <?php }?>
</table>
<div>
    <?php
    $url = "index.php?a=user-xem";
    echo $qt->thanhphantrang($url, $totalrows, $current_page, $per_page, $pages_per_group);
    ?>
</div>