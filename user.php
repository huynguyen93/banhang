<?php

$u->taocaptcha();

?>

<div id="user-area" >
    <a href="#" id="dangnhap">Đăng nhập</a> / <a href="#" id="dangky">Đăng ký</a>
</div>

<div class="modal text-left" id="myModal">
    <div class="modal-content" id="content" ></div>
</div>

<?php require_once("user_dangnhap.php");?>

<?php require_once("user_dangky.php");?>

<script>
    $(document).ready(function(){
        $("#dangnhap").click(function(){
            $("#myModal").show();
            $("#content").html($("#formdn").html());
            $("#content").css('height', '340px');
            return false;
        });
        
        $("#dangky").click(function(){
            $("#myModal").show();
            $("#content").html($("#formdk").html());
            $("#content").css('height', '620px');
            return false;
        });
        
        $("#content").on('click', '#btn-dk', function(){
            $.ajax({
                url: "process.php",
                type: "post",
                data: $("#formdangky").serialize()+"&action=dangky",                
                success: function(data){
                    if(data == 'OK'){
                        $("#content").html("<h2>Đăng ký thành công!</h2> <p><a href='#' id='chuyendangnhap'>Đăng nhập<a></p>");
                    } else{
                        $("#error").html(data);
                    }
                }
            });
        });
        
        $("#content").on('click', '#chuyendangnhap', function(){
           $("#dangnhap").click();
        });
        
        $("#content").on('click', '#btn-dn', function(){
            $.ajax({
                url: "process.php",
                type: "post",
                data: $("#formdangnhap").serialize()+"&action=dangnhap",                
                success: function(data){
                    if(data == 'OK'){
                        location.reload();
                    } else {
                        $("#error").html(data);
                    }
                }
            });
        });
        
        $("#content").on('click', '.close',function(){
            $("#myModal").hide();
        });
    });
</script>