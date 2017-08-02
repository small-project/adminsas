<?php
include_once '../config/api.php';
$delete = new Perusahaan();

$id = $_GET['kode'];
$kode = $_GET['id'];

$sql = "DELETE FROM tb_hasil_interview WHERE id=:id";
$stmt = $delete->runQuery($sql);
$stmt->execute(array(
    ':id'	=>$id));
if (!$stmt) {
    # code...
    echo "Data Tidak berhasil di hapus.";
}else{
    echo "<script>
            alert('DATA Berhasil di Hapus!');
            window.location.href='../?p=input-nilai&id=".$kode."';
            </script>";
}

?>