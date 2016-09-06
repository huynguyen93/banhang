<?php
$listhinhsp = $sp->layhinhsp($_GET['idSP']);
if(count($listhinhsp) < 2)
{
?>
<img class="" src="upload/sanpham/hinhchinh/<?php echo $sanpham['urlHinh'];?>"/>
<?php
 return false;
}
?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php $i=0; foreach($listhinhsp as $hinh) { ?>
            <li class="<?php if($i==0) echo 'active';?>" data-target="#myCarousel" data-slide-to="<?php echo $i++; ?>" ></li>
        <?php }?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php $i=0; foreach($listhinhsp as $hinh){ ?>
        <div class="item <?php if($i==0) echo 'active'; $i++; ?>">
            <img class="" src="upload/sanpham/hinhphu/<?php echo $hinh['urlHinh'];?>" alt="Chania" style="height: 400px; object-fit: cover;">
        </div>
        <?php }?>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev" style="color: #333;">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next" style="color: #333;">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>