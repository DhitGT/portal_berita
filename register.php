<?php

    if(isset($_POST['submit'])){
        if($_POST['nama'] != '' && $_POST['password'] != ''){
            require_once 'koneksi.php';
            $nama = $_POST['nama'];
            $sql = "SELECT * FROM users WHERE nama = '$nama'";
            $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result) > 0) {
                $infoNama = 'nama tidak tersedia';
            } else {
                if(strlen($_POST['password']) >= 8 ){
                    mysqli_query($conn, "INSERT INTO users ( `nama`, `password`, `role`) VALUES ('" . $_POST['nama'] . "', '" . $_POST['password'] . "', 'user')");
                    mysqli_close($conn);
                    header('location:login.php');
                }else{
                    $infoPw = 'password harus setidaknya 8 karakter';
                }
            }
            
        }else{
            if($_POST['nama'] == ''){
                $infoNama = 'Nama harus diisi';
            }
            if($_POST['password'] == ''){
                $infoPw = 'Password harus diisi';
            }
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<div class="container pt-4">
        <h1 align="center">Register</h1>
        <hr>
        <div class="card card-50 p-3 m-4 secondary m-auto">
            <form action="" method="post">
                <table class="t-white">
                    <tr>
                        <th width="15%"></th>
                        <th width="3%"></th>
                        <th width="35%"></th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><span class="info-nama info"><?php echo isset($infoNama) ? $infoNama : ''; ?></span></td>
                    </tr>
                    <tr>
                        <td>
                            Nama
                        </td>
                        <td>
                            :
                        </td>
                        <td >
                            <input value="<?php echo isset($_POST['nama']) ? $_POST['nama'] : ''; ?>" type="text" class="form-control form-control-sm bo-2 t-black" name="nama">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><span class="info-pw info"><?php echo isset($infoPw) ? $infoPw : ''; ?></span></td>
                    </tr>
                    <tr>
                        <td class="mb-auto">
                            Password
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <input type="password" name="password" class="form-control form-control-sm bo-2 t-black" id="">
                        </td>
                    </tr>
                </table>
                <button name="submit" class="btn btn-outline-success mt-4 W-100">REGISTER</button>
            </form>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>