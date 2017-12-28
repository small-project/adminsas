<?php
include_once '../config/api.php';
$config = new Admin();

$jabatan = $_POST['txt_kode'];
$email = $_POST['txt_email'];
$pass = $_POST['txt_password'];
$nama = $_POST['txt_nama'];
$role = $_POST['jabatan'];
$img = 'user.png';

$new_password = password_hash($pass, PASSWORD_DEFAULT);

$query = "INSERT INTO tb_admin (username, password, nama_admin, id_role, jabatan, picture) VALUES (:email, :pass, :nama, :role, :jabatan, :img)";

    $stmt = $config->runQuery($query);
    $stmt->execute(array(
      ':email' => $email,
      ':pass'   => $new_password,
      ':nama'   => $nama,
      ':role'   => $role,
      ':jabatan'=> $jabatan,
      ':img'    => $img
    ));

    if ($stmt) {
      # code...
      echo "<script>
        alert('Admin berhasil ditambahkan!');
        window.location.href='../?p=admin';
        </script>";
    }else{
      echo "<script>
        alert('Admin gagal di input!');
        window.location.href='../?p=admin';
        </script>";
    }


 ?>
