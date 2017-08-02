<?php
include_once '../config/api.php';
$delete = new Perusahaan();
	$id = $_GET['id'];
	$sql = "DELETE FROM tb_temporary_perusahaan WHERE id=:id";
	$stmt = $delete->runQuery($sql);
	$stmt->execute(array(
		':id'	=>$id));
	if (!$stmt) {
		# code...
		echo "Data Tidak berhasil di hapus.";
	}else{
		header('Location: ../index.php?p=new-customer');
	}


?>