<?php

// Proses submit form
if (isset($_POST['submit'])) {
    // Ambil data dari form
    $NIS         = $_POST['NIS'];
    $id_kategori = $_POST['id_kategori']; // perbaiki: name di HTML harus 'id_kategori'
    $lokasi      = $_POST['lokasi'];
    $ket         = $_POST['ket']; // perbaiki: name di HTML harus 'ket'
    
    // Gunakan prepared statement untuk keamanan
    $stmt = $koneksi->prepare("INSERT INTO inp_aspirasi (NIS, id_kategori, lokasi, ket) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $NIS, $id_kategori, $lokasi, $ket); // i=int, s=string
    
    if ($stmt->execute()) {
        echo "<script>
            alert('Aspirasi berhasil dikirim!');
            window.location.href='?page=display';
        </script>";
    } else {
        echo "<script>alert('Gagal mengirim aspirasi: " . $stmt->error . "');</script>";
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Aspirasi Siswa</title>
    <style> 

        input,
        select,
        textarea {
            width: 97%;
            padding: 10px;
        }

        textarea {
            height: 80px;
        }

    </style>
</head>
<body>
    <div class="form-container">
        <h2>📝 Form Aspirasi Siswa</h2>
        
        <form method="POST" action="">
            <!-- NIS -->
            <div class="form-group">
                <label>NIS (Nomor Induk Siswa)</label>
                <input type="number" name="NIS" required>
            </div>
            
            <!-- Kategori (PERBAIKAN: name="id_kategori") -->
            <div class="form-group">
                <label>Kategori Aspirasi</label>
                <select name="id_kategori" required>
                    <option>-- Pilih Kategori --</option>
                    <?php
                    // Ambil data kategori dari database
                    $result = $koneksi->query("SELECT * FROM kategori ORDER BY ket_kategori");
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id_kategori'] . "'>"
                            . $row['ket_kategori'] . "</option>";
                        }
                    } else {
                        echo "<option value='' disabled>Tidak ada kategori</option>";
                    }
                    ?>
                </select>
            </div>
            
            <!-- Lokasi -->
            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="lokasi" required>
            </div>
            
            <!-- Keterangan (PERBAIKAN: name="ket") -->
            <div class="form-group">
                <label>Keterangan / Keluhan</label>
                <textarea name="ket" required></textarea>
            </div>
            
            <!-- Tombol -->
            <div class="button-group">
                <button type="submit" name="submit" class="btn-kirim">Kirim Aspirasi</button>
                <a href="?page=display" class="btn-batal">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>