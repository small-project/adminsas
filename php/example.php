<?php
$host = "localhost";
$db_name = "database";
$username = "root";
$password = "root";

$db =  new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// $password = "admin"; hasilnya salah
// $password = "love_god"; hasilnya benar

$sql = "SELECT * FROM tb_login_karyawan WHERE email = 'afz60.30@gmail.com' ";

$stmt = $db->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_LAZY);
if ($stmt->rowCount() > 0) {
  # code...
  $pass = $row['password'];

  if (password_verify($password, $pass)) {
    # code...
    echo "password sama";
  }else{
    echo "password tidak sama";
  }
}
 ?>
