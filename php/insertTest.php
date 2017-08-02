<?php
include_once '../config/api.php';
if (isset($_POST['add-jadwal'])) {
	# code...
	$kode_test = strip_tags($_POST['txt_kode']);
	$no_ktp = strip_tags($_POST['txt_kode']);
	$tgl = strip_tags($_POST['txt_kode']);
	$admin = strip_tags($_POST['txt_kode']);


	$input = new Karyawan();
	$stmt = $input->addTest($kode_test, $no_ktp, $tgl, $admin);
	if (!$stmt) {
		# code...
		echo "data tidak masuk";
	}else{
		header('Location: index.php?p=schedule-test');
	}


}
?>