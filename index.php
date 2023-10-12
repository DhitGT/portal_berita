<?php
session_start();
if(!isset($_SESSION['login'])){
    $_SESSION['login'] = 'guest';
    $_SESSION['loginName'] = 'guest';
}

require_once 'koneksi.php';
$sql = 'SELECT * FROM berita ORDER BY Likes DESC';
$result = mysqli_query($conn, $sql);


function formatNumber($number) {
    // Convert the number to a string and reverse it
    $reversedNumber = strrev((string)$number);

    // Use chunk_split to add a dot every three characters
    $formattedNumber = chunk_split($reversedNumber, 3, '.');

    // Remove any trailing dot and reverse the string back
    $result = strrev(rtrim($formattedNumber, '.'));

    return $result;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">Portal Berita</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="TambahBerita.php">Tambah Berita</a>
                    </li>
                    <?php 
                    if($_SESSION['loginName'] == 'admin'){
                        echo ("<li class='nav-item'>
                        <a class='nav-link' href='dashboard.php'>Dashboard</a>
                        </li>");
                    }
                        if($_SESSION['loginName'] == 'guest'){
                            echo ("<li class='nav-item'>
                            <a class='nav-link' href='logout.php'>Login</a>
                            </li>");
                        }else{
                            echo ("<li class='nav-item'>
                            <a class='nav-link' href='logout.php'>Log Out</a>
                            </li>");
                        }
                        

                    ?>
                    
                </ul>
                <div class="ms-auto d-flex pt-3">
                    <img class="" src="img/pp.jpeg" alt="" width="30px" height="30px">
                    <p class="t-black mt-2 ms-2"><?php echo $_SESSION['loginName'] ?></p>
                </div>
            </div>
        </div>
    </nav>
    <div class="container pt-5">

        <?php foreach ($result as $value) : ?>
            <div class="card text-left p-2 m-3 card-m card-berita" id="<?php echo $value['Id'] ?>">
                <div class="card-side">
                    <img class="card-img-top bo-2" src="img/<?php echo ($value['gambar']); ?>" alt="Image" height="300px">
                </div>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $value['Judul'] ?></h4>
                    <span><?php echo $value['Tanggal'] ?></span>
                    <br>
                    <span>By : <?php echo $value['Author'] ?></span>
                    <hr>
                    <p class="card-text text-limit"><?php echo $value['Isi'] ?></p>
                    <form action="post">
                        <div class="wrapper d-flex align-center">
                            <a class="like-btn" href="like.php?id=<?php echo $value['Id'] ?>" name="Like">
                                <img src="img/like.jpeg" alt="" width="60px">
                            </a>
                            <p class="mt-3"><?php echo FormatNumber($value['Likes'] ) ?> Likes</p>
                        </div>
                    </form>
                    <div class="wrapper d-flex">
                        <div class="action-btn me-3">
                            <a href="baca.php?Id=<?php echo $value['Id'] ?>" class="btn bs-3 btn-danger">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>