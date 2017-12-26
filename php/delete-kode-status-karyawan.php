<?php
include_once '../config/api.php';

$delete = new Admin();


$kode_id = $_GET['id'];

$sql = "DELETE FROM tb_kode_status_karyawan WHERE kd_id=:id";
$stmt = $delete->runQuery($sql);
$stmt->execute(array(
	':id'	=>$kode_id));
if (!$stmt) {
		# code...
	echo "<script>
    alert('Kode Gagal Dihapus!');
    window.location.href='../?p=kode-status-karyawan';
    </script>";
}else{
	echo "<script>
    alert('Kode Berhasil Dihapus!');
    window.location.href='../?p=kode-status-karyawan';
    </script>";

}


?>
