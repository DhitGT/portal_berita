<?php
session_start();
    if(!isset($_SESSION['login'])){
        header('location:login.php');
    }
    require 'koneksi.php';
    $id = $_GET['id'];
    $sqlGet = "SELECT * FROM berita WHERE Id = $id";
    $result = mysqli_query($conn,$sqlGet);
    $row = mysqli_fetch_assoc($result);
    $likeNow = $row['Likes'] +=1;
    
    $sqlUpdate = "UPDATE berita SET Likes='$likeNow' WHERE Id=$id";
    
    if(mysqli_query($conn,$sqlUpdate)){
        $href = "location:index.php#$id";
        header($href);
    }

?>