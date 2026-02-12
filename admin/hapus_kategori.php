<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = (int)$_GET['id'];

$sql = ("DELETE FROM kategori WHERE id_kategori = $id");
    
$result =  $koneksi->query($sql); 
var_dump($result);
if ($result) {
    header("Location: ?page=kategori");

} else {
    $error = "ERROR :" . $conn->error;
}

?>