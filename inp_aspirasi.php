<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Aspirasi</title>

    <style> 

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 100vh;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .card h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 97%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #cccccc;
            outline: none;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #43008b;
            box-shadow: 0 0 5px rgba(30, 0, 78, 0.5);
        }

        textarea {
            height: 80px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn-kirim {
            background: #4800ae;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-kirim:hover {
            background: #04ff00;
        }

        .btn-batal {
            background: #ccc;
            color: black;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
        }

        .btn-batal:hover {
            background: #ff0000;
        }

        .option_kategori {
            padding: 10px;
        }

    </style>
</head>

<body>

<?php
if (isset($_POST['submit'])) {

    $NIS         = $_POST['NIS'];
    $id_kategori = $_POST['id_kategori'];
    $lokasi      = $_POST['lokasi'];
    $ket         = $_POST['ket'];

    $stmt = $koneksi->prepare("INSERT INTO inp_aspirasi (NIS, id_kategori, lokasi, ket, status) VALUES (?, ?, ?, ?, 'Menunggu')");
    $stmt->bind_param("iiss", $NIS, $id_kategori, $lokasi, $ket);

    if ($stmt->execute()) {
        echo "<script>alert('Aspirasi berhasil dikirim!'); window.location.href='?page=display';</script>";
    } else {
        echo "<script>alert('Gagal mengirim aspirasi.');</script>";
    }
}
?>

    <div class="content">

    <div class="form-container">

        <h2>Form Aspirasi</h2>

        <form method="post">

            <label>NIS</label>
            <input type="number" name="NIS" required>

            <label>Kategori</label>
            <select name="kategori" required>
                <option>Pilih Kategori</option>
                <?php
                $result = $koneksi->query("SELECT * FROM kategori");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id_kategori'] . "'>" . $row['ket_kategori'] . "</option>";
                }
                ?>
            </select>

            <label>Lokasi</label>
            <input type="text" name="lokasi" required>

            <label>Keterangan</label>
            <textarea name="keterangan" required></textarea>

            <div style="display:flex; justify-content:space-between; margin-top:15px;">
                <button type="submit" name="submit" class="btn-kirim">Kirim</button>
                <a href="?page=display" class="btn-batal">Batal</a>
            </div>

        </form>

    </div>

</div>


</body>

</html>