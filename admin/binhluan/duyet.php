<?php

$dsbinhluan = $qt->laybinhluan(0, $totalrows, $current_page, $per_page);

?>
<h2 class="">Bình luận chưa duyệt</h2>
<p><b>Còn:</b> <?php echo $totalrows;?> bình luận chưa duyệt</p>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Sản phẩm</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Nội dung <small>(Rê chuột để xem nhanh)</small></th>
            <th><b class="glyphicon glyphicon-ok text-sucess" id="duyet"></b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <b class="glyphicon glyphicon-remove text-danger" id="xoa" style="opacity: 0;"></b></th>
        </tr>
    </thead>
    <tbody id="dsbinhluan">
    <?php foreach($dsbinhluan as $binhluan){ ?>
        <tr>
            <td><?php echo $binhluan['id_comment'];?></td>
            <td><a class='text-primary' href="http://localhost/banhang/index.php?idSP=<?php echo $binhluan['idSP'];?>"><?php echo $qt->laytensanpham($binhluan['idSP']);?></a></td>
            <td><?php echo $binhluan['hoten'];?></td>
            <td><?php echo $binhluan['email'];?></td>
            <td><span title="<?php echo $binhluan['noidung'];?>"><?php if(strlen($binhluan['noidung']) > 30) echo mb_substr($binhluan['noidung'], 0, strpos($binhluan['noidung'], ' ', 30))."..."; else echo $binhluan['noidung'];?><span></span></td>
            <td><a href="#" class="duyet" idbl="<?php echo $binhluan['id_comment'];?>">Duyệt</a> / <a href="#" class="xoa" idbl="<?php echo $binhluan['id_comment'];?>">Xóa</a></td> 
        </tr>
    <?php }?>
    </tbody>
</table>
<div>
    <?php
    $url = "index.php?a=binhluan-duyet";
    echo $qt->thanhphantrang($url, $totalrows, $current_page, $per_page, $pages_per_group);
    ?>
</div>
<script>
    $(document).ready(function(){
        $("#dsbinhluan").on('click',".duyet", function(){
            var idBL = $(this).attr("idbl");
            duyetbinhluan(idBL);
            laybinhluan();
            $("#duyet").animate({'opacity': 1, 'font-size': '16px', 'color':'green'});
            anduyet();
        });
        
        $("#dsbinhluan").on('click', '.xoa', function(){
            var confirm = xacnhan();
            if(confirm == false) return false;
            var idBL = $(this).attr("idbl");
            xoabinhluan(idBL);
            laybinhluan();
            $("#xoa").animate({'opacity': 1, 'font-size': '16px', 'color':'red'});
            anxoa();
        });
    });
    
    function duyetbinhluan(idBL){
        $.ajax({
            url: "process.php",
            type: "get",
            data: "duyetbinhluan="+idBL
        });
    }
    
    function xoabinhluan(idBL){
        
        $.ajax({
            url: "process.php",
            type: "get",
            data: "xoabinhluan="+idBL
        });
    }
    
    function laybinhluan(){
        $.ajax({
            url: "process.php",
            type: "get",
            data: "laybinhluan=1",
            success: function(data){
                $("#dsbinhluan").html(data);
            }
        });
    }
    
    function anduyet(){
        setTimeout(function(){
           $("#duyet").animate({'opacity': 0, 'color':'green'})
        }, 1000);
    }
    
    function anxoa(){
        setTimeout(function(){
           $("#xoa").animate({'opacity': 0, 'color':'red'})
        }, 1000);
    }
</script>