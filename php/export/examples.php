<?php
require '../../config/api.php';
require 'config.php';

$no_ktp = "3175070204930007";
$sql = "SELECT * FROM tb_karyawan WHERE no_ktp = :ktp";
$config = new Admin();

$stmt = $config->runQuery($sql);
$stmt->execute(array(':ktp' => $no_ktp));

$info = $stmt->fetch(PDO::FETCH_LAZY);

 ?>
<link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
	body{
		text-transform: capitalize;
	}
</style>

<body>

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
	</div>
</div>

</body>