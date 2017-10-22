<?php
require '../config/api.php';

$no_ktp = $_GET['id'];

$sql = "SELECT * FROM tb_karyawan WHERE no_ktp = :ktp";
$config = new Admin();

$stmt = $config->runQuery($sql);
$stmt->execute(array(':ktp' => $no_ktp));

$info = $stmt->fetch(PDO::FETCH_LAZY);

 ?>
<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
	body{
		text-transform: capitalize;
	}
</style>

<body onload="window.print()">

<div class="panel panel-body">
	<div class="table-responsive">
		<table class="table">
			<tr style="background-color: #ebebeb">
			<td colspan="4">data informasi primer</td>
		</tr>
		<tr>
			<td width="30%" rowspan="6">
				<img class="img-responsive img-rounded" width="40%" style="margin-left: 50%;" src="<?=$info['foto']?>">
			</td>
		</tr>
				<tr width="70%">
					<td width="20%">nomor NIP</td>
					<td width="10%">:</td>
					<td width="70%"><?=$info['no_ktp']?></td>
				</tr>
				<tr width="70%">
					<td width="20%">Nama Lengkap</td>
					<td width="10%">:</td>
					<td width="70%"><?=$info['nama_depan']?> <?=$info['nama_depan']?></td>
				</tr>
				<tr width="70%" >
					<td width="20%">TTL</td>
					<td width="10%">:</td>
					<td width="70%"><?=$info['tempat_lahir']?>, <?=$info['tgl_lahir']?></td>
				</tr>
				<tr width="70%">
					<td width="20%">Jenis Kelamin</td>
					<td width="10%">:</td>
					<td width="70%"><?=$info['jenis_kelamin']?></td>
				</tr>
				<tr width="70%">
					<td width="20%">Alamat</td>
					<td width="10%">:</td>
					<td width="70%"><?=$info['alamat']?>, <?=$info['kelurahan']?>, <?=$info['kecamatan']?>, <?=$info['kota']?></td>
				</tr>
		<tr class="info">
			<td colspan="4">data informasi sekunder</td>
		</tr>
	</table>
	<?php 
		$query = "SELECT * FROM tb_info_keluarga WHERE no_ktp = :ktp";
		$stmt = $config->runQuery($query);
		$stmt->execute(array(':ktp' => $no_ktp));

	?>
	<table class="table table-bordered" style="margin-top: 25px;">
		<tr style="background-color: #000; color: #fff;">
			<td colspan="6">Informasi Keluarga</td>
		</tr>
		<tr style="background-color: #ebebeb; color: #000;">
			<td>Nama Lengkap</td>
			<td>Status Keluarga</td>
			<td>L / P</td>
			<td>Pendidikan</td>
			<td>Pekerjaan</td>
			<td>Nomor Telp</td>
		</tr>
		<?php while ($pendidikan = $stmt->fetch(PDO::FETCH_LAZY) ) { ?>
		<tr>
			
			<td><?=$pendidikan['nama_lengkap']?></td>
			<td><?=$pendidikan['status_keluarga']?></td>
			<td><?=$pendidikan['jenis_kelamin']?></td>
			<td><?=$pendidikan['pendidikan']?></td>
			<td><?=$pendidikan['pekerjaan']?></td>
			<td><?=$pendidikan['nomor_handphone']?></td>
			
		</tr>
		<?php } ?>
	</table>

	<?php 
		$query = "SELECT * FROM tb_info_pendidikan WHERE no_ktp = :ktp";
		$stmt = $config->runQuery($query);
		$stmt->execute(array(':ktp' => $no_ktp));

	?>
	<table class="table table-bordered" style="margin-top: 25px;">
		<tr style="background-color: #000; color: #fff;">
			<td colspan="6">Informasi Pendidikan</td>
		</tr>
		<tr style="background-color: #ebebeb; color: #000;">
			<td>Tingkat Pendidikan</td>
			<td>Nama Badan Pendidikan</td>
			<td>Jurusan</td>
			<td>Tahun Masuk</td>
			<td>Tahun Lulus</td>
			<td>Nilai</td>
		</tr>
		<?php while ($pendidikan = $stmt->fetch(PDO::FETCH_LAZY) ) { ?>
		<tr>
			
			<td><?=$pendidikan['tingkat']?></td>
			<td><?=$pendidikan['nama_bapen']?></td>
			<td><?=$pendidikan['jurusan']?></td>
			<td><?=$pendidikan['tahun_masuk']?></td>
			<td><?=$pendidikan['tahun_lulus']?></td>
			<td><?=$pendidikan['nilai']?></td>
			
		</tr>
		<?php } ?>
	</table>

	<?php 
		$query = "SELECT * FROM tb_info_pekerjaan WHERE no_ktp = :ktp";
		$stmt = $config->runQuery($query);
		$stmt->execute(array(':ktp' => $no_ktp));
		if ($stmt->rowCount() < 1) {
			# code...
		}else{

	?>
	<table class="table table-bordered" style="margin-top: 25px;">
		<tr style="background-color: #000; color: #fff;">
			<td colspan="6">Informasi Pekerjaan</td>
		</tr>
		<tr style="background-color: #ebebeb; color: #000;">
			<td>Nama Perusahaan</td>
			<td>Tahun Masuk</td>
			<td>Tahun Keluar</td>
			<td>Jabatan</td>
			<td>Gaji</td>
			<td>Alasan Berhenti</td>
		</tr>
		<?php while ($pendidikan = $stmt->fetch(PDO::FETCH_LAZY) ) { ?>
		<tr>
			
			<td><?=$pendidikan['nama_perusahaan']?></td>
			<td><?=$pendidikan['tahun_masuk']?></td>
			<td><?=$pendidikan['tahun_keluar']?></td>
			<td><?=$pendidikan['jabatan']?></td>
			<td><?=$pendidikan['gaji']?></td>
			<td><?=$pendidikan['alasan_berhenti']?></td>
			
		</tr>
		<?php }
		 } ?>
	</table>

	<?php 
		$query = "SELECT * FROM tb_info_referensi WHERE no_ktp = :ktp";
		$stmt = $config->runQuery($query);
		$stmt->execute(array(':ktp' => $no_ktp));
		if ($stmt->rowCount() < 1) {
			# code...
		}else{
	?>
	<table class="table table-bordered" style="margin-top: 25px;">
		<tr style="background-color: #000; color: #fff;">
			<td colspan="4">Informasi Referensi</td>
		</tr>
		<tr style="background-color: #ebebeb; color: #000;">
			<td>Nama Lengkap</td>
			<td>Jabatan</td>
			<td>Nomor HP</td>
			<td>Hubungan</td>
		</tr>
		<?php while ($pendidikan = $stmt->fetch(PDO::FETCH_LAZY) ) { ?>
		<tr>
			
			<td><?=$pendidikan['nama_lengkap']?></td>
			<td><?=$pendidikan['jabatan']?></td>
			<td><?=$pendidikan['nomor_hp']?></td>
			<td><?=$pendidikan['hubungan']?></td>
			
		</tr>
		<?php } } ?>
	</table>

	<?php 
		$query = "SELECT * FROM tb_info_bahasa WHERE no_ktp = :ktp";
		$stmt = $config->runQuery($query);
		$stmt->execute(array(':ktp' => $no_ktp));
		if ($stmt->rowCount() < 1) {
			# code...
		}else{

	?>
	<table class="table table-bordered" style="margin-top: 25px;">
		<tr style="background-color: #000; color: #fff;">
			<td colspan="6">Informasi Pengusaan Bahasa</td>
		</tr>
		<tr style="background-color: #ebebeb; color: #000;">
			<td>Nama Bahasa</td>
			<td>Writing</td>
			<td>Listening</td>
			<td>Speaking</td>
		</tr>
		<?php while ($pendidikan = $stmt->fetch(PDO::FETCH_LAZY) ) { ?>
		<tr>
			
			<td><?=$pendidikan['nama_bahasa']?></td>
			<td><?=$pendidikan['writing']?></td>
			<td><?=$pendidikan['listening']?></td>
			<td><?=$pendidikan['speaking']?></td>
			
		</tr>
		<?php }
		 } ?>
	</table>

	<?php 
		$query = "SELECT * FROM tb_info_keahlian WHERE no_ktp = :ktp";
		$stmt = $config->runQuery($query);
		$stmt->execute(array(':ktp' => $no_ktp));
		if ($stmt->rowCount() < 1) {
			# code...
		}else{

	?>
	<table class="table table-bordered" style="margin-top: 25px;">
		<tr style="background-color: #000; color: #fff;">
			<td colspan="6">Informasi Keahlian</td>
		</tr>
		<tr style="background-color: #ebebeb; color: #000;">
			<td>Nama Keahilan yang di Kuasai</td>
			<td>Nilai</td>
		</tr>
		<?php while ($pendidikan = $stmt->fetch(PDO::FETCH_LAZY) ) { ?>
		<tr>
			
			<td><?=$pendidikan['nama_keahlian']?></td>
			<td><?=$pendidikan['nilai']?></td>
			
		</tr>
		<?php }
		 } ?>
	</table>

	<?php 
		$query = "SELECT * FROM tb_info_penghargaan WHERE no_ktp = :ktp";
		$stmt = $config->runQuery($query);
		$stmt->execute(array(':ktp' => $no_ktp));
		if ($stmt->rowCount() < 1) {
			# code...
		}else{

	?>
	<table class="table table-bordered" style="margin-top: 25px;">
		<tr style="background-color: #000; color: #fff;">
			<td colspan="6">Informasi Penghargaan</td>
		</tr>
		<tr style="background-color: #ebebeb; color: #000;">
			<td>Nama Penghargaan</td>
			<td>Tingkat</td>
			<td>Keterangan</td>
		</tr>
		<?php while ($pendidikan = $stmt->fetch(PDO::FETCH_LAZY) ) { ?>
		<tr>
			
			<td><?=$pendidikan['nama_penghargaan']?></td>
			<td><?=$pendidikan['tingkat']?></td>
			<td><?=$pendidikan['keterangan']?></td>
			
		</tr>
		<?php }
		 } ?>
	</table>

	<?php 
		$query = "SELECT * FROM tb_info_kursus WHERE no_ktp = :ktp";
		$stmt = $config->runQuery($query);
		$stmt->execute(array(':ktp' => $no_ktp));
		if ($stmt->rowCount() < 1) {
			# code...
		}else{

	?>
	<table class="table table-bordered" style="margin-top: 25px;">
		<tr style="background-color: #000; color: #fff;">
			<td colspan="6">Informasi Kursus</td>
		</tr>
		<tr style="background-color: #ebebeb; color: #000;">
			<td>Bidang Kursus</td>
			<td>Badan Penyelenggara</td>
			<td>Tahun Masuk</td>
			<td>Tahun Lulus</td>
		</tr>
		<?php while ($pendidikan = $stmt->fetch(PDO::FETCH_LAZY) ) { ?>
		<tr>
			
			<td><?=$pendidikan['nama_bidang']?></td>
			<td><?=$pendidikan['nama_penyelenggara']?></td>
			<td><?=$pendidikan['tahun_masuk']?></td>
			<td><?=$pendidikan['tahun_lulus']?></td>
			
		</tr>
		<?php }
		 } ?>
	</table>

	</div>
</div>

</body>