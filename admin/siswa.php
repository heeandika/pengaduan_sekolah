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
<style>
    label {
        display: inline;
        width: 100px;
        margin-top: 10px;
    }

    input {
        width: 40%;
        padding: 8px;
        margin-top: 5px;
        box-sizing: border-box;
    }

    button {
        margin-top: 10px;
        padding: 10px 15px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }
    table {
        margin-top: 20px;
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .btn-ubah {
        color: white;
        background-color: #4CAF50;
        padding: 5px 10px;
        text-decoration: none;
        border-radius: 3px;
    }

    .btn-hapus {
        color: white;
        background-color: #f44336;
        padding: 5px 10px;
        text-decoration: none;
        border-radius: 3px;
    }

</style>
<body>
<h2>Data Siswa</h2>
    <?php
    $siswa_id = "";
    $NIS = "";
    $kelas = "";

    if (isset($_POST['submit'])) {

        $id    = $_POST['id'] ?? "";
        $NIS   = $_POST['NIS'];
        $kelas = $_POST['kelas'];

        if (empty($NIS) || empty($kelas)) {

            $error = "Semua Data Harus Diisi!!";
        } else {

            // untuk mengubah data siswa
            if (!empty($id)) {

                $stmt = $koneksi->prepare(
                    "UPDATE siswa SET NIS=?, kelas=? WHERE id=?"
                );
                $stmt->bind_param("ssi", $NIS, $kelas, $id);
            }
            // untuk menambah data siswa
            else {

                $stmt = $koneksi->prepare(
                    "INSERT INTO siswa (NIS, kelas) VALUES (?,?)"
                );
                $stmt->bind_param("is", $NIS, $kelas);
            }
        }

        if ($stmt->execute()) {
            header("Location: ?page=siswa");
            exit();
        } else {
            $error = "ERROR: " . $stmt->error;
        }
    }

    if (isset($_GET['id'])) {

        $id = (int)$_GET['id'] ?? '';

        $stmt = $koneksi->prepare("SELECT * FROM siswa WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            die("DATA tidak ditemukan!!");
        }

        $data = $result->fetch_assoc();

        $siswa_id = $data['id'];
        $NIS      = $data['NIS'];
        $kelas    = $data['kelas'];
    }
    ?>

    <!-- form tambah & ubah -->
    <form action="" method="post">

        <input type="hidden" name="id" value="<?= $siswa_id ?>">

        <label>NIS</label>
        <input type="number" name="NIS" value="<?= $NIS ?>" required>

        <label>Kelas</label>
        <input type="text" name="kelas" value="<?= $kelas ?>" required>

        <button type="submit" name="submit">
            <?= !empty($siswa_id) ? "Update" : "Tambah" ?>
        </button>

    </form>


    <table border="1" cellpadding="5" cellspacing="0" style="width: 100%;">

        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Kelas</th>
            <th style="background-color: #c50000;">Aksi</th>
        </tr>

        <?php
        $hasil = $koneksi->query("SELECT * FROM siswa");

        if ($hasil->num_rows > 0) {
            $no = 1;
            while ($row = $hasil->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $row["NIS"] . "</td>";
                echo "<td>" . $row["kelas"] . "</td>";
                echo "<td>
                <a href='?page=siswa&id=" . $row["id"] . "' class='btn btn-ubah'>Ubah</a> |
                <a href='?page=hapus_siswa&id=" . $row["id"] . "' class='btn btn-hapus' onclick=\"return confirm('Yakin?')\">Hapus</a>
                </td>";
                echo "</tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
        }
        ?>
    </table>