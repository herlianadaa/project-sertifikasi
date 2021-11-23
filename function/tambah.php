<?php
include '../include/koneksi.php';
$filesurat = $_FILES['file'];

// var_dump($filesurat);
if ($filesurat['type'] == "application/pdf") {
    if ($filesurat['size'] <= 5 * 1024 * 1000) {
        $nosurat = $_POST['nosurat'];
        $judulsurat = $_POST['judulsurat'];
        $tglsurat =  date('YmdH:i:s');
        $kategori = $_POST['kategori'];
        $files = $filesurat['name'];



        // simpan ke db
        $query = "Insert into surat(judulsurat,kategori,nosurat,tglarsip,file) values('$judulsurat','$kategori','$nosurat',NOW(),'$files') ";

        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            session_start();
            die('SQL Error: ' . mysqli_error($koneksi));
            $_SESSION['msg'] = 2;
            header('Location:../index.php');
        } else {
            session_start();
            // simpan file ke server 
            move_uploaded_file($filesurat['tmp_name'], "../assets/arsip/" . $files);
            $_SESSION['msg'] = 1;

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
