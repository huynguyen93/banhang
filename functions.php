<?php

function int($input){
    settype($input, "int");
    return $input;
}

function redirect($url){
    header("Location: $url");
}