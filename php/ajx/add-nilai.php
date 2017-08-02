<?php

$kode = $_POST['id'];
$lulus = $_POST['st'];

include_once '../../config/api.php';

$kelas = new Admin();
$sql = "UPDATE tb_karyawan SET nilai = :lulus WHERE no_KTP = :ktp";
$stmt = $kelas->runQuery($sql);

$stmt->execute(array(
    ':lulus'	=> $lulus,
    ':ktp'		=> $kode));

if (!$stmt) {
    # code...
    echo "gagal";
} else {
    echo "Berhasil Simpan";
}

?>