<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
</head>

<body>
    <!-- tambah data kategori -->
    <?php
    $id_kategori = "";
    $ket_kategori = "";
    if (isset($_POST['submit'])) {
        $id_kategori = $_POST['id_kategori'];
        $ket_kategori = $_POST['ket_kategori'];

        if (
            empty($id_kategori) ||
            empty($ket_kategori)
        ) {
            $error = "Semua data harus di isi";
        } else {
            $stmt = $koneksi->prepare("INSERT INTO kategori (id_kategori, ket_kategori) VALUE (?,?)");
        }

        $stmt->bind_param(
            ("is"),
            $id_kategori,
            $ket_kategori

        );

        if ($stmt->execute()) {
            header("Location: ?page=kategori");
            exit();
        } else {
            $error = "ERROR:" . $stmt->error;
        }
    }
    ?>
    <!-- ubah data kategori -->
    <?php
    if (isset($_POST['id'])) {
        $id = (int)$_GET['id'];

        $hasil = $koneksi->query("SELECT * FROM kategori WHERE id_kategori = $id ");

        if ($hasil->num_rows < 0) {
            die("data tidak ditemukan");
        }

        $data = $hasil->fetch_assoc();
        $id_kategori = $data['id_kategori'];
        $ket_kategori = $data['ket_kategori'];
    }
    
    ?>
    <!-- from tambah & ubah data -->
    <form action="" method="get">
        <div>
            <div>
                <label>Kategori</label>
                <input type="text" name="ket_kategori" value="<?php echo $ket_kategori ?>" require>
            </div>
        <div>
            <button type="submit" name="submit">simpan</button>
    </form>
    <table border="1" cellpdding"5" sellspacing"0"">
        <tr>
            <th>id</th>
            <th>Keterangan Kategori</th>
            <th style="background-color: red;">Aksi</th>
        </tr>
        <?php
        $hasil = $koneksi->query("SELECT * FROM kategori");

        if ($hasil->num_rows > 0) {
            $no = 1;
            while ($row = $hasil->fetch_assoc()) {
                echo "<tr>";
                echo "<th>" . $no . "</th>";
                echo "<th>" . $row['ket_kategori'] . "</th>";
                echo "<td>";
                echo "<a href='?page=ubah_kategori&id=" . $row['id_kategori'] . "'>ubah</a>";
                echo "<a href='?page=hapus_siswa&id=" . $row['id_kategori'] . "'onclick=\"return confirm('yakin?')\">Hapus</a>";
                echo "</td>";
                echo "</tr>";
                $no += 1;
            }
        } else {
            echo "0 result";
        }

        ?>

    </table>
</body>

</html>