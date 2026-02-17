<?php

$hasil = $koneksi->query("SELECT * FROM kategori");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kategori</title>
</head>
<style>
    label {
        display: inline;
        width: 100px;
        margin-top: 10px;
        padding-right: 10px;
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

    th,
    td {
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
    <h2>Data kategori</h2>
    <?php
    $id_kategori = "";
    $ket_kategori = "";

    if (isset($_POST['submit'])) {

        $id    = $_POST['id'] ?? "";
        $Ket_kategori = $_POST['ket_kategori'];
        
        if (empty($Ket_kategori)) {

            $error = "Semua Data Harus Diisi!!";
        } else {

            // untuk mengubah data kategori
            if (!empty($id)) {

                $stmt = $koneksi->prepare(
                    "UPDATE kategori SET Ket_kategori=? WHERE id_kategori=?"
                );
                $stmt->bind_param("si", $Ket_kategori, $id);
            }
            // untuk menambah data kategori
            else {

                $stmt = $koneksi->prepare(
                    "INSERT INTO kategori (ket_kategori) VALUES (?)"
                );
                $stmt->bind_param("s", $Ket_kategori);
            }
        }

        if ($stmt->execute()) {
            header("Location: ?page=kategori");
            exit();
        } else {
            $error = "ERROR: " . $stmt->error;
        }
    }

    if (isset($_GET['id'])) {

        $id = (int)$_GET['id'] ?? '';

        $stmt = $koneksi->prepare("SELECT * FROM kategori WHERE id_kategori=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            die("DATA tidak ditemukan!!");
        }

        $data = $result->fetch_assoc();

        $id_kategori    = $data['id_kategori'];
        $ket_kategori   = $data['ket_kategori'];
    }
    ?>
    <?php
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {

        $id = (int)$_GET['id'];
    
        $sql = ("DELETE FROM kategori WHERE id_kategori = $id");
    
        $result =  $koneksi->query($sql);
        var_dump($result);
        if ($result) {
            header("Location: ?page=kategori");
        } else {
            $error = "ERROR:" . $koneksi->error;
        }
    }
    ?>

    <!-- form tambah & ubah -->
    <form action="" method="post">

        <input type="hidden" name="id" value="<?= $id_kategori ?>">

        <label>Keterangan Kategori:</label>
        <input type="text" name="ket_kategori" value="<?= $ket_kategori ?>" required>

        <button type="submit" name="submit">
            <?= !empty($id_kategori) ? "Update" : "Tambah" ?>
        </button>

    </form>

    <table border="1" cellpadding="5" cellspacing="0" style="width: 100%;">

        <tr>
            <th>No</th>
            <th>Keterangan Kategori</th>
            <th style="background-color: #c50000;">Aksi</th>
        </tr>

        <?php
        $hasil = $koneksi->query("SELECT * FROM kategori");

        if ($hasil->num_rows > 0) {
            $no = 1;
            while ($row = $hasil->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $row["ket_kategori"] . "</td>";
                echo "<td>
                <a href='?page=kategori&id=" . $row["id_kategori"] . "' class='btn btn-ubah'>Ubah</a> |
                <a href='?page=kategori&action=delete&id=" . $row["id_kategori"] . "' class='btn btn-hapus' onclick=\"return confirm('Yakin?')\">Hapus</a>
                </td>";
                echo "</tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
        }
        ?>
    </table>