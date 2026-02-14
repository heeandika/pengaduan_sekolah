<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
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
</style>
<body>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Keterangan</th>
            <th>Status</th>

        </tr>

        <?php
        $result = $koneksi->query("SELECT * FROM inp_aspirasi");
        $no = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $row['NIS'] . "</td>";
            echo "<td>" . $row['id_kategori'] . "</td>";
            echo "<td>" . $row['lokasi'] . "</td>";
            echo "<td>" . $row['ket'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
        }
        ?>
    </table>
</html>