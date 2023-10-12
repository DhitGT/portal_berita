<?php
    session_start();
    if(!isset($_SESSION['login']) || $_SESSION['login'] != 'admin'){
        header('location:logout.php');
    }
    require 'koneksi.php';
    $id = $_GET['Id'];
    $sqlGet = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn,$sqlGet);

    $row = mysqli_fetch_assoc($result);
    $token = $row['token'];
    $nama = $row['nama'];

    
    if(isset($_POST['submit'])){
        $newToken = $_POST['token'];
        $sqlUpdate = "UPDATE users SET token='$newToken' WHERE Id=$id";
        if(mysqli_query($conn,$sqlUpdate)){
            header('location:viewUsers.php');
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- navbar -->
    <?php include 'layout/navbar.php' ?>
    <!-- navbar -->
    <div class="container pt-4">
        <h1 align="center">Tambah Berita</h1>
        <div class="card p-3 m-4 secondary">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="t-white">
                    <tr>
                        <th width="15%"></th>
                        <th width="3%"></th>
                        <th width="35%"></th>
                    </tr>
                    <tr>
                        <td>
                            NAMA
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <input value="<?php echo htmlspecialchars($nama) ?>" type="text" class="form-control form-control-sm bo-2 t-black" name="nama" id="nama">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            TOKEN
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <input value="<?php echo htmlspecialchars($token) ?>" type="text" class="form-control form-control-sm bo-2 t-black" name="token" id="token">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button name="submit" class="btn btn-outline-success mt-5">UPDATE BERITA</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>