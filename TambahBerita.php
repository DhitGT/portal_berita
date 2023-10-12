<?php
session_start();
if(!isset($_SESSION['login']) ||     $_SESSION['loginName'] == 'guest'){
    header('location:logout.php');
}
require_once 'koneksi.php';
$Author = $_SESSION['loginName'];
$info = '';
$sqlGetToken = "SELECT * FROM users WHERE nama = '$Author'";
$result = mysqli_fetch_assoc(mysqli_query($conn,$sqlGetToken));
if(isset($_POST['submit'])){
    if($result['token'] != 0){
            $Judul = $_POST['judul'];
            $Isi = $_POST['isiberita'];
            $Tanggal = $_POST['tanggal'];
            $Gambar = $_FILES["gambar"]["name"];
            $targetDir = "img/";
            $nowToken = $result['token'] -1;
            $targetFile = $targetDir . basename($_FILES["gambar"]["name"]);
            $sqlSetToken = "UPDATE `users` SET `token` = $nowToken WHERE `users`.`nama` = '$Author'";
            mysqli_query($conn,$sqlSetToken);
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
                echo "The file ". basename( $_FILES["gambar"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
            $query = "INSERT INTO berita VALUES ('','$Judul','$Author','$Isi','$Tanggal','$Gambar','0')";
            if(mysqli_query($conn,$query)){
                header("location:index.php");
            }
        }else{
            $info = "Token Kamu Habis. Hubungi admin untuk tambah token";
        }
    }
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
        <p>Token : <?php echo isset($result['token']) ? $result['token'] : ''; ?></p>
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
                            JUDUL
                        </td>
                        <td>
                            :
                        </td>
                        <td >
                            <input type="text" class="form-control form-control-sm bo-2 t-black" name="judul">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            TANGGAL PUBLIKASI
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <input type="date" class="form-control form-control-sm bo-2 t-black" name="tanggal">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            AUTHOR
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <input disabled type="text" class="form-control form-control-sm bo-2 t-black" name="author" value="<?php echo $_SESSION['loginName']?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="mb-auto">
                            ISI BERITA
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <textarea name="isiberita" id="" cols="30" rows="3" class="form-control form-control-sm bo-2 t-black"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            GAMBAR
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <input type="file" class="form-control form-control-sm bo-2 t-black" name="gambar" id="gambar">
                        </td>
                    </tr>
                    <tr>
                        <td><span class="info-name info"><?php echo isset($info) ? $info : ''; ?></span></td>
                    </tr>
                    <tr>

                        <td>
                            <button name="submit" class="btn btn-outline-success mt-5">TAMBAH BERITA (-1 Token)</button>
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