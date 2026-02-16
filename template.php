<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>style</title>
</head>
<style>
    body {
        display: flex;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        display: grid;
        /* Membuat 3 kolom: sidebar (200px), konten (sisa ruang), sidebar (200px) */
        grid-template-columns: 1fr 5fr;
        min-height: 100vh;
        /* Memastikan grid memenuhi tinggi layar */
        gap: 10px;
        /* Jarak antar area */
        margin: 0;
    }

    .menu a {
        display: block;
        margin-bottom: 10px;
        text-decoration: none;
        color: #007efc;
    }

    .sidebar {
        background-color: #f4f4f4;
        padding: 20px;
    }

    .main{
        padding: 20px;
    }



</style>

<body>
    <div class="sidebar">
        <div>
            <h2 class="logo">Siswa</h2>
        </div>

        <div class="menu">
            <a href="?page=display">Display</a>
            <a href="?page=inp_aspirasi">Aspirasi</a>
        </div>
    </div>

    <div class="main">
        <?php

          include $content
          
        ?>
    </div>

</body>

</html>