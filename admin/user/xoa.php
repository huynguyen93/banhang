<?php
settype($_GET['idUser'], "int");

if(!isset($_GET['idUser']) || $_GET['idUser'] < 1) header("location: index.php?a=user-xem");

$qt->xoauser($_GET['idUser']);