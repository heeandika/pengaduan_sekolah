<?php

$hasil = $koneksi->query("SELECT * FROM siswa");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa</title>
</head>

<body>

    <!-- tambah data siswa -->
    <?php
    $siswa_id = 0;
    $NIS = "";
    $kelas = "";
    if (isset($_POST['submit'])) {
        $NIS    = $_POST['NIS'];
        $kelas  = $_POST['kelas'];

        if (
            empty($NIS) ||
            empty($kelas)
        ) {
            $error = "Semua Data Harus Diisi!!";
        } else {
            $stmt = $koneksi->prepare("INSERT INTO siswa (NIS, kelas) VALUE (?,?)");
        }

        $stmt->bind_param(
            ("is"),
            $NIS,
            $kelas
        );

        if ($stmt->execute()) {
            header("Location: ?page=siswa");
            exit();
        } else {
            $error = "ERROR :" . $stmt->error;
        }
    }
    ?>

    <!-- ubah data siswa -->
    <?php

    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];

        $hasil = $koneksi->query("SELECT * FROM siswa WHERE id = $id");

        if ($hasil->num_rows < 0) {
            die("DATA tidak ditemukan!!");
        }

        $data = $hasil->fetch_assoc();
        $siswa_id = $data['id'];
        $NIS = $data['NIS'];
        $kelas = $data['kelas'];
    }

    ?>

    <!-- form tambah & ubah -->
    <form action="" method="post">
        <div>
            <div>
                <label>NIS</label>
                <input type="number" name="NIS" value="<?php echo $NIS ?>" require>
            </div>
            <div>
                <label>Kelas</label>
                <input type="text" name="kelas" value="<?php echo $kelas ?>" require>
            </div>

            <button type="submit" name="submit">Simpan</button>
        </div>
    </form>

    <!-- menampilkan data dari database -->
    <table border="1" cellpadding="5" cellspacing="0" style="width: 100%;">
        <div class="table">
            <tr>
                <th>id</th>
                <th>NIS</th>
                <th>kelas</th>
                <th style="background-color: #c50000;">Aksi</th>
            </tr>
            <?php
            $hasil = $koneksi->query("SELECT * FROM siswa");

            if ($hasil->num_rows > 0) {
                $no = 1;
                while ($row = $hasil->fetch_assoc()) {
                    echo "<tr>";
                    echo "<th>" . $no . "</th>";
                    echo "<th>" . $row["NIS"] . "</th>";
                    echo "<th>" . $row["kelas"] . "</th>";
                    echo "<td>";
                    echo "<a href='?page=siswa&id=" . $row["id"] . "'>ubah</a>";
                    echo "<a href='?page=hapus_siswa&id=" . $row["id"] . "'onclick=\"return confirm('yakin?')\">Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                    $no += 1;
                }
            } else {
                echo "0 result";
            }

            ?>
        </div>
    </table>
</body>

</html>