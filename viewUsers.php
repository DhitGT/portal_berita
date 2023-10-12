<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] != 'admin') {
    header('location:logout.php');
}
require_once 'koneksi.php';
$sql = 'SELECT * FROM users';
$result = mysqli_query($conn, $sql);
$resAssoc = mysqli_fetch_assoc($result)
?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'layout/navbar.php' ?>
    <div class="container pt-5">

        <?php foreach ($result as $value) : ?>
            <div class="card text-left p-2 m-3 card-m card-berita d-flex flex-column">
                <div class="card-head d-flex">
                    <div class="infor me-4  "> 
                        
                        <h4 class="card-title"><span><?php echo $value['id'] ?></span> | <?php echo $value['nama'] ?></h4>
                        <span>Token : <?php echo $value['token'] ?></span>
                    </div>
                    <div class="wrapper d-flex">
                        <div class="action-btn me-3">
                            <a href="deleteUser.php?Id=<?php echo $value['id'] ?>" class="btn bs-3 btn-danger">Delete</a>
                        </div>
                        <div class="action-btn">
                            <a href="updateUser.php?Id=<?php echo $value['id'] ?>" class="btn bs-3 btn-warning">Ubah</a>
                        </div>
                    </div>
                </div>
                <div class="card-body body-view-user">
                    <hr>
                    <p>Write By :</p>
                    <div class="wrapper d-flex align-center wrapper-view-user">
                        <?php
                        $Author = $value['nama'];
                        $sqlQ = "SELECT * from berita WHERE Author = '$Author'";
                        $rest = mysqli_query($conn, $sqlQ);

                        foreach ($rest as $re) :
                        ?>
                            <div class="card bo-2 text-black card-m card-berita d-flex flex-column ps-1 pe-3 pb-3 bs-3 me-3">
                                <div class="card-head">
                                    <p>Nama : <?php echo $re['Judul'] ?> </p>
                                    <p>Id : <?php echo $re['Id'] ?> </p>
                                    <p>Like : <?php echo $re['Likes'] ?> </p>
                                </div>
                                <div class="wrapper d-flex">
                                    <div class="action-btn me-3">
                                        <a href="delete.php?Id=<?php echo $re['Id'] ?>" class="btn bs-3 btn-outline-danger">Delete</a>
                                    </div>
                                    <div class="action-btn">
                                        <a href="update.php?Id=<?php echo $re['Id'] ?>" class="btn bs-3 btn-outline-warning">Ubah</a>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach ?>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>