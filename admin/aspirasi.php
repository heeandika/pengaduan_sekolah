<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pengaduan Sarana Sekolah</title>
</head>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
</style>
<body>
<?php 

?>

    <!-- TABEL ASPIRASI -->
    <h2>Daftar Aspirasi</h2>
    
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
        
        
        <?php
        // Query dengan JOIN untuk menampilkan nama kategori
        $result = $koneksi->query("
            SELECT 
                inp_aspirasi.NIS,
                inp_aspirasi.lokasi,
                inp_aspirasi.ket,
                ket_kategori as nama_kategori
            FROM inp_aspirasi
            LEFT JOIN kategori ket_kategori ON inp_aspirasi.id_kategori = ket_kategori.id_kategori
            ORDER BY inp_aspirasi.id_pelaporan DESC
        ");
        
        if ($result->num_rows > 0) {
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row['NIS'] . "</td>";
                echo "<td>" . $row['nama_kategori'] . "</td>";
                echo "<td>" . $row['lokasi'] . "</td>";
                echo "<td>" . $row['ket'] . "</td>";
                echo "<td><a href='?page=edit_aspirasi&nis=" . $row['NIS'] . "'>Detail</a> </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5' align='center'>Belum ada data aspirasi</td></tr>";
        }
        ?>
    </table>

<?php ?>

</body>
</html>