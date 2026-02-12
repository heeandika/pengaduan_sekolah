<!-- <?php
include "../koneksi.php";

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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa</title>
</head>
<body>
    <form action="" method="post">
        <div class="table">
            <div>
                <label>NIS</label>
                <input type="number" name="NIS" require>
            </div>
            <div>
                <label>Kelas</label>
                <input type="text" name="kelas" require>
            </div>

            <button type="submit" name="submit">Tambah</button>
            <a href="?page=siswa">Kembali</a>
        </div>
    </form>
</body>

</html> -->