<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aspirasi</title>
</head>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $koneksi->prepare("SELECT * FROM aspirasi WHERE id_pelaporan = $id");

}
  
?>
<body>
    <form action="" method="post">
        <label for="status">Status:</label>
        <select name="status">
            <option>-- pilih status --</option>
            <option value="pending">pending</option>
            <option value="diproses">diproses</option>
            <option value="selesai">selesai</option>
        </select>
        <label for="feedback">Feedback:</label>
        <textarea name="feedback"></textarea>

        <button type="submit" name="submit">Submit</button>
    </form>
    <?php
      if (isset($_POST['submit'])) {
        $status = $_POST['status'];
        $feedback =$_POST['feedback'];

        if (empty($status) || empty($feedback)) {
            echo "Semua data harus diisi!";
        } else {

            var_dump($id);
            $stmt = $koneksi->prepare("UPDATE aspirasi SET status=?, feedback=? WHERE id_pelaporan = ?");
            $stmt->bind_param("ssi", $status, $feedback, $id);
    
            $stmt->execute();
    
            if ($stmt->affected_rows > 0) {
                header("Location: ?page=aspirasi");
                exit();
            } else {
                echo "gagal update data";
            }
        }

      }
    ?>
</body>

</html>