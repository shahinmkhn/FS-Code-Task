<?php

 session_start();

    require_once 'dbh.php';
    require_once 'func.php';

$done = $_POST['done'];


if ($done == "success"){

    $red= $_POST['red'];
    $green= $_POST['green'];
    $blue= $_POST['blue'];
    $left= $_POST['left'];
    $top= $_POST['top'];
    $width= $_POST['width'];
    $height= $_POST['height'];
    $id= $_POST['id'];
    

    createDiv($conn, $red, $green, $blue, $left, $top, $width, $height, $id);


} else if ($done == "successdel"){

    $id= $_POST['id'];

    deleteDiv($conn, $id);
}   