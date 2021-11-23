<?php

    // variabel untuk koneksi db
    $server = 'localhost'; 
    $dbname = 'surat_e-arsip';
    $username = 'root';       
    $password = '';    

    //fungsi koneksi ke database 
    $koneksi = mysqli_connect($server , $username , $password,$dbname);
    
    //cek koneksi berhasil atau tidak
        if (mysqli_connect_errno()) {
        echo "gagal terhubung :" . mysqli_connect_error() ;
    } else {
        // echo "terhubung ke db ";
    }

?>


