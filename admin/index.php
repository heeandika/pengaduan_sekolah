<?php

include "../koneksi.php";


if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {

        case 'siswa':
            $content = "siswa.php";
            break;

        case 'aspirasi':
            $content = "aspirasi.php";
            break;

        case 'kategori':
            $content = "kategori.php";
            break;

        case 'tambah_siswa':
            $content = "tambah_siswa.php";
            break;

        case 'ubah_siswa':
            $content = "ubah_siswa.php";
            break;

        case 'hapus_siswa':
            $content = "hapus_siswa.php";
            break;

        case 'logout':
            $content = "logout.php";
            break;

        default:
            include "../404.php";
            break;
    }
    if ($content === "../404.php") {
        include $content;
        exit;
    } else {
        include "template.php";
    }

} else {
    include "../404.php";
}

$koneksi->close();
