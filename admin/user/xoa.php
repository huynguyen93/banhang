<?php
settype($_GET['idUser'], "int");

if($_GET['idUser'] <= 0) header("location: index.php?a=user-xem");

$qt->xoauser($_GET['idUser']);