<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = (int)$_GET['id'];

$sql = ("DELETE FROM siswa WHERE id = $id");
    
$result =  $koneksi->query($sql); 
var_dump($result);
if ($result) {
    header("Location: ?page=siswa");

} else {
    $error = "ERROR :" . $conn->error;
}

?>