<?php
    $user = $u->get_info();
?>
<div id="user-area">
    <?php
    if($_SESSION['user_group'] == 1){
    ?>
    <a href="admin/index.php">Quản trị</a>, <a href="process.php?action=thoat">Thoát</a>
    <?php
    }  else {
    ?>
    <a class="text-primary" href="#" id="user"><i class="glyphicon glyphicon-user"></i> Chào <?php echo $_SESSION['user_hoten'];?> </a>
    <?php
    }
    ?>
</div>

<div class="modal text-left" id="myModal">
    <div class="modal-content" id="content" ></div>
</div>

<div id="user-info" style="display: none;">
    <span class="close">x</span>
    <div class="row" style="margin: 5px;">
        <h2 style="">Thông tin tài khoản</h2>
        <p><b>Họ tên: </b><?php echo $user['HoTen']; ?></p>
        <p><b>Email: </b><?php echo $user['Email']; ?></p>
        <p><b>Địa chỉ: </b><?php echo $user['DiaChi']; ?></p>
        <p><b>Số điện thoại: </b><?php echo $user['DienThoai']; ?></p>
        <p><a class="text-primary" href="#" id="formdoimatkhau">Đổi mật khẩu</a></p>
        <p><a class="text-danger" href="process.php?action=thoat" id="thoat">Thoát</a></p>
    </div>
</div>

<div id="doimatkhau" style="display:none;">
    <span class="close">x</span>
    <div class="row" style="margin: 5px;">
        <h2 style="">Thay đổi mật khẩu</h2>
        <b id="error" class="text-danger"></b>
        <form method="post">
            <div class="form-group">
                <label for="oldpass">Mật khẩu cũ</label>
                <input type="text" name="oldpass" id="oldpass" class="form-control">
            </div>
            <div class="form-group">
                <label for="newpass">Mật khẩu mới</label>
                <input type="text" name="newpass" id="newpass" class="form-control">
            </div>
            <div class="form-group">
                <label for="newpass">Xác nhận mật khẩu mới</label>
                <input type="text" name="renewpass" id="renewpass" class="form-control">
            </div>
            <div class="form-group">
                <div class="col-xs-4" style="padding:0;"> 
                    <label for="btn-doithongtin"></label>
                    <button type="button" name="btn-doipass" class="btn btn-success btn-block" id="btn-doipass">Submit</button>
                </div>
                <div class="col-xs-4">
                    <label for="cancel"></label>
                    <button type="reset" name="cancel" class="btn btn-warning btn-block" id="quayve">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#user").click(function(){
            $("#myModal").show();
            $("#content").html($("#user-info").html());
        });
        
        $("#content").on('click', '#formdoimatkhau', function(){
            $("#content").html($("#doimatkhau").html());
        });
        
        $("#content").on('click', '#btn-doipass', function(){
            $.ajax({
                url: 'process.php',
                type: 'post',
                data: "action=doipass&oldpass="+$('#oldpass').val()+"&newpass="+$("#newpass").val()+"&renewpass="+$("#renewpass").val(),
                success: function(data){
                    if(data == 'OK'){
                        $("#content").html("<h2>Đổi mật khẩu thành công</h2><a href='#' id='quayve'>Quay về</a>");
                    } else{
                        $("#error").html(data);
                    }
                }
            });
        });
        
        $("#content").on('click', '#quayve', function(){
            $("#content").html($("#user-info").html());
        });
        
        $("#content").on('click', '.close', function(){
            $("#myModal").css("display", "none");
        });
    });
</script>