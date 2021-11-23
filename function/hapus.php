<?php
include '../include/koneksi.php';

$id = $_POST['id'];

// simpan ke db
$query = "delete from surat where id=" . $id;

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('SQL Error: ' . mysqli_error($koneksi));
} else {
    header("Location:../index.php");
}
