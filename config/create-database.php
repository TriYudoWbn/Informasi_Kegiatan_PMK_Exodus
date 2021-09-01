<?php 
    include "koneksi.php";

    $sql = "CREATE DATABASE Exodus";

    if ($kon->query($sql) === TRUE){
        echo "Database berhasil dibuat";
    }else{
        echo "Database gagal dibuat";
    }
