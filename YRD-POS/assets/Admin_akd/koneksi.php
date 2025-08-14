<?php
    //mysqli_connect("nama host databse", "username", "password", "nama database");
    $conn = mysqli_connect("localhost","root","","akademik"); 

    // check connection
    if(mysqli_connect_errno()) {
        echo "Koneksi database gagal : " .mysqli_connect_error();
    }
?>