<?php
include '../include/koneksi.php';
$filesurat = $_FILES['fileupdate'];

// var_dump($filesurat);
if ($filesurat['type'] == "application/pdf") {
    if ($filesurat['size'] <= 5 * 1024 * 1000) {
        $idsurat = $_POST['id'];

        $tglsurat =  date('YmdH:i:s');
        // $kategori = $_POST['kategori'];
        $files = $filesurat['name'];



        // simpan ke db
        $query = "UPDATE surat set file='$files' where id='$idsurat'";

        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            session_start();
            die('SQL Error: ' . mysqli_error($koneksi));
            $_SESSION['msg'] = 5;
            header('Location:../index.php');
        } else {
            session_start();
            // simpan file ke server 
            move_uploaded_file($filesurat['tmp_name'], "../assets/arsip/" . $files);
            $_SESSION['msg'] = 6;

            header('Location:../index.php');
        }
    } else {
        session_start();
        // die('SQL Error: ' . mysqli_error($koneksi));
        $_SESSION['msg'] = 3;
        header('Location:../index.php');
    }
} else {
    session_start();
    // die('SQL Error: ' . mysqli_error($koneksi));
    $_SESSION['msg'] = 4;
    header('Location:../index.php');
}





//   var_dump($filesurat);
