<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:logout.php');
}
require 'koneksi.php';
$id = $_GET['Id'];
$sqlGet = "SELECT * FROM berita WHERE Id = $id";
$result = mysqli_query($conn, $sqlGet);

$value = mysqli_fetch_assoc($result);
// $judul = $row['Judul'];
// $isi = $row['Isi'];
// $tanggal = $row['Tanggal'];
// $gambar = $row['gambar'];

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $value['Judul'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="card text-left p-2 m-3 card-m ">
        <div class="card-side">
            <img class="card-img-top bo-2" src="img/<?php echo ($value['gambar']); ?>" alt="Image" height="300px">
        </div>
        <div class="card-body">
            <h4 class="card-title"><?php echo $value['Judul'] ?></h4>
            <span><?php echo $value['Tanggal'] ?></span>
            <hr>
            <p class="card-text"><?php echo $value['Isi'] ?></p>
            <div class="wrapper d-flex align-center">
                <a class="like-btn" href="like.php?id=<?php echo $value['Id'] ?>" name="Like">
                    <img src="img/like.jpeg" alt="" width="60px">
                </a>
                <p class="mt-3"><?php echo $value['Likes'] ?> Likes</p>
            </div>
            <div class="wrapper d-flex">
                <div class="action-btn me-3">
                    <a href="index.php" class="btn bs-3 btn-info">Back</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</html>