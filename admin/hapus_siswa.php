<?php

$id = (int)$_GET['id'];

$sql = ("DELETE FROM siswa WHERE id = $id");
    
$result =  $koneksi->query($sql); 
var_dump($result);
if ($result) {
    header("Location: ?page=siswa");

} else {
    $error = "ERROR :" . $koneksi->error;
}

?>