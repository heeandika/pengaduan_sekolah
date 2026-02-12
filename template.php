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
        background-color: #a5a5a5;
        display: grid;
        /* Membuat 3 kolom: sidebar (200px), konten (sisa ruang), sidebar (200px) */
        grid-template-columns: 1fr 5fr;
        min-height: 100vh;
        /* Memastikan grid memenuhi tinggi layar */
        gap: 10px;
        /* Jarak antar area */
        margin: 0;

    }

    .logo {
        text-align: center;
        padding: 20px;
        border-bottom: 2px solid black
    }

    .sidebar {
        background-color: #180032;
        color: white;
        height: 100vh;
        padding: 20px;
    }

    .sidebar a {
        display: block;
        color: white;
        padding: 12px 20px;
        text-decoration: none;
        border-left: 5px solid transparent;
    }

    .sidebar a:hover {
        background-color: #89e0ff;
        border-left: 5px solid #323232;
        color: black;
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