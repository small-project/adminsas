<?php

$kode = $_POST['id'];

include_once '../../config/api.php';

    $kelas = new Admin();
    $sql = "UPDATE tb_karyawan SET no_NIK = :kode WHERE no_KTP = :ktp";
    $stmt = $kelas->runQuery($sql);

    $stmt->execute(array(
    	':kode'		=> $kode,
    	':ktp'		=> $kode));

    if (!$stmt) {
    	# code...
    	echo "gagal";
    } else {
    	echo "berhasil";
    }

?>