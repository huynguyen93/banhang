<div class="col-md-3 brand">
    <a href="index.php"><h2 class="brand-name"><i class="glyphicon glyphicon-apple logo pull-left"></i><b>nhất nghệ</b> <br></h2>
    <i class="brand-slogan">Website bán điện thoại!</span></a>
</div>
<div class="col-md-9">
    <nav class="navbar navbar-default" style="margin-bottom:0;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-nav" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            </div>
        <div class="collapse navbar-collapse" id="top-nav">
            <ul class="nav navbar-nav">
                <?php $listchungloai = $sp->laydschungloai();?>
                <?php $i=1; foreach($listchungloai as $chungloai){ ?>
                <li class="<?php if($i==1){echo "active-cat"; $i++;}?>"><a href="index.php?c=sanpham&a=sptheochungloai&idCL=<?php echo $chungloai['idCL'];?>"><?php echo $chungloai['TenCL'] ?></a></li>
                <?php }?>
                <li class=""><a href="">Tin tức</a></li>
                <li class=""><a href="">Khuyến mãi</a></li>
                <li class=""><a href="">Liên hệ</a></li>
            </ul>
            <form class="navbar-form navbar-left">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Go!</button>
                </span>
            </div>
            </form>
        </div>
    </nav>
</div>