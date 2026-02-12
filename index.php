<?php

include "koneksi.php";

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'display':
            $content = "display.php";
            break;
        case 'inp_aspirasi':
            $content = "inp_aspirasi.php";
            break;

        default:
            $content = "404.php";
            break;

    }

    if ($content === '404.php') {
        include "404.php";
        exit;
    } else {
        include 'template.php';
    }

} else {
    include "404.php";
}
  
?>