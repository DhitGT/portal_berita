<?php
    session_start();    
    if(!isset($_SESSION['login']) || $_SESSION['login'] != 'admin'){
        header('location:logout.php');
    }
    require 'koneksi.php';
    $id = $_GET['Id'];
    $sql = "DELETE FROM berita WHERE `Id` = $id";
    mysqli_query($conn,$sql);
    header('location:dashboard.php');


?>