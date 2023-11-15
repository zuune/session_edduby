<?php 

    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "blog";
    
    $conn = mysqli_connect($server, $username, $password, $db);
    // urutannya yang diisi = server,username,password,nama database

    if(!$conn){
        echo "Koneksi gagal";
    }

    session_start();


?>
