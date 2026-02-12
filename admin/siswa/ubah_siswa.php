<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ubah siswa</title>
</head>

<body>
    <?php
    include "../koneksi.php";

    if (!isset($_GET['id'])) {
        die("ID tidak ditemukan!!");
    }

    $id = (int)$_GET['id'];

    $hasil = $koneksi->query("SELECT * FROM siswa WHERE id = $id");

    if ($hasil->num_rows < 0) {
        die("DATA tidak ditemukan!!");
    }

    $data = $hasil->fetch_assoc();

    ?>
    <form action="" method="POST">
        <div>

            <label>NIS</label>
            <input type="number" name="NIS" value="<?php echo $data["NIS"] ?>" require>
        </div>
        <div>
            <label>kelas</label>
            <input type="text" name="kelas" value="<?php echo $data["kelas"] ?>" require>
        </div>

        <button type="submit" name="submit">Ubah</button>
        <a href="?page=siswa">Batal</a>

    </form>
    <?php
      
      if (isset($_POST['submit'])) {
        $stmt = $koneksi->prepare("UPDATE siswa SET NIS=?, kelas=? WHERE id=?");

        $stmt->bind_param(
            ("isi"),
            $_POST['NIS'],
            $_POST['kelas'],
            $id
        );

        if ($stmt->execute()) {
            header("Location: ?page=siswa");
            exit();
        }
      }
    ?>

</body>

</html>