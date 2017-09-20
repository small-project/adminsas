<?php
		/* include autoloader */
		require_once 'dompdf/autoload.inc.php';

		// Konfigurasi database anda
		$host = "localhost";
		$dbname = "sinergiadhi_staging";
		$username = "root";
		$password = "anggaadityas";

		try {
			// Buat Object PDO baru dan simpan ke variable $db
			$db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
			// Mengatur Error Mode di PDO untuk segera menampilkan exception ketika ada kesalahan
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $exception){
			die("Connection error: " . $exception->getMessage());
		}


		$no_ktp = $_GET['id'];

		$stmt = $db->prepare('SELECT * FROM tb_karyawan where no_ktp = :no_ktp');
		$stmt->bindParam(":no_ktp",$no_ktp);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_LAZY);

		/* reference the Dompdf namespace */
		use Dompdf\Dompdf;

		/* instantiate and use the dompdf class */
		$dompdf = new Dompdf();

		$html = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<style>	
		.name{
			margin-top:10px;
		}
		.noktp{
			margin-top:-80px;
		}
		</style>
		<div>	
		<img src="'.$row['foto'].'" width="150" height="200"/>
		<h2 class="name">'.$row['nama_depan'] . ' ' .$row['nama_belakang'].'</h2>
		<span class="noktp">'.$row['no_ktp'].'</span>	
		</div>';

		$stmtpendidikan = $db->prepare('SELECT * FROM tb_info_pendidikan where no_ktp = :no_ktp');
		$stmtpendidikan->bindParam(":no_ktp",$no_ktp);
		$stmtpendidikan->execute();
		
		$html .= "
		 <style>
		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
			margin-top:10px;
		}
		
		td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}
		
		tr:nth-child(even) {
			background-color: #dddddd;
		}
		.pendidikan{
			margin-top:50px;
		}
		</style>
		<div class='pendidikan'>
		<span style=font-size:30px;margin-top:20px;>Table Informasi Pendidikan</span>
		<table>
		 <tr>
		  <th>Tingkat Pendidkan</th>
		  <th>Nama Badan Pendidikan</th>
		  <th> Jurusan</th>
		  <th> Tahun Masuk </th>
		  <th> Tahun Keluar</th>
		  <th> Nilai (Rata-Rata)
		 </tr>
		";
		while ($rowpendidikan = $stmtpendidikan->fetch(PDO::FETCH_LAZY)) {
		 $html .= '
		  <tr>
		   <td>'.$rowpendidikan["tingkat"].'</td>
		   <td>'.$rowpendidikan["nama_bapen"].'</td>
		   <td>'.$rowpendidikan["jurusan"].'</td>
		   <td>'.$rowpendidikan["tahun_masuk"].'</td>
		   <td>'.$rowpendidikan["tahun_lulus"].'</td>
		   <td>'.$rowpendidikan["nilai"].'</td>
		  </tr>
		 ';
		}
		
		$html .= '</table></div>';

		$stmtbahasa = $db->prepare('SELECT * FROM tb_info_bahasa where no_ktp = :no_ktp');
		$stmtbahasa->bindParam(":no_ktp",$no_ktp);
		$stmtbahasa->execute();

		$html .= "
		<style>
	   table {
		   font-family: arial, sans-serif;
		   border-collapse: collapse;
		   width: 100%;
		   margin-top:10px;
	   }
	   
	   td, th {
		   border: 1px solid #dddddd;
		   text-align: left;
		   padding: 8px;
	   }
	   
	   tr:nth-child(even) {
		   background-color: #dddddd;
	   }
	   .pendidikan{
		   margin-top:50px;
	   }
	   </style>
	   <div class='pendidikan'>
	   <span style=font-size:30px;margin-top:20px;>Table Informasi Bahasa</span>
	   <table>
		<tr>
		 <th>Nama Bahasa</th>
		 <th>Writing</th>
		 <th>Listening</th>
		 <th>Speaking</th>
		</tr>
	   ";
	   while ($rowbahasa = $stmtbahasa->fetch(PDO::FETCH_LAZY)) {
		$html .= '
		 <tr>
		  <td>'.$rowbahasa["nama_bahasa"].'</td>
		  <td>'.$rowbahasa["writing"].'</td>
		  <td>'.$rowbahasa["listening"].'</td>
		  <td>'.$rowbahasa["speaking"].'</td>
		 </tr>
		';
	   }
	   
	   $html .= '</table></div>';

	   $stmtbahasa = $db->prepare('SELECT * FROM tb_info_bahasa where no_ktp = :no_ktp');
	   $stmtbahasa->bindParam(":no_ktp",$no_ktp);
	   $stmtbahasa->execute();

	   $html .= "
	   <style>
	  table {
		  font-family: arial, sans-serif;
		  border-collapse: collapse;
		  width: 100%;
		  margin-top:10px;
	  }
	  
	  td, th {
		  border: 1px solid #dddddd;
		  text-align: left;
		  padding: 8px;
	  }
	  
	  tr:nth-child(even) {
		  background-color: #dddddd;
	  }
	  .pendidikan{
		  margin-top:50px;
	  }
	  </style>
	  <div class='pendidikan'>
	  <span style=font-size:30px;margin-top:20px;>Table Informasi Bahasa</span>
	  <table>
	   <tr>
		<th>Nama Bahasa</th>
		<th>Writing</th>
		<th>Listening</th>
		<th>Speaking</th>
	   </tr>
	  ";
	  while ($rowbahasa = $stmtbahasa->fetch(PDO::FETCH_LAZY)) {
	   $html .= '
		<tr>
		 <td>'.$rowbahasa["nama_bahasa"].'</td>
		 <td>'.$rowbahasa["writing"].'</td>
		 <td>'.$rowbahasa["listening"].'</td>
		 <td>'.$rowbahasa["speaking"].'</td>
		</tr>
	   ';
	  }
	  
	  $html .= '</table></div>';

	  $stmtkursus = $db->prepare('SELECT * FROM tb_info_kursus where no_ktp = :no_ktp');
	  $stmtkursus->bindParam(":no_ktp",$no_ktp);
	  $stmtkursus->execute();

	  $html .= "
	  <style>
	 table {
		 font-family: arial, sans-serif;
		 border-collapse: collapse;
		 width: 100%;
		 margin-top:10px;
	 }
	 
	 td, th {
		 border: 1px solid #dddddd;
		 text-align: left;
		 padding: 8px;
	 }
	 
	 tr:nth-child(even) {
		 background-color: #dddddd;
	 }
	 .pendidikan{
		 margin-top:50px;
	 }
	 </style>
	 <div class='pendidikan'>
	 <span style=font-size:30px;margin-top:20px;>Table Informasi Kursus</span>
	 <table>
	  <tr>
	   <th>Nama Bidang</th>
	   <th>Nama Penyelenggara</th>
	   <th>Tahun Masuk</th>
	   <th>Tahun Lulus</th>
	  </tr>
	 ";
	 while ($rowkursus = $stmtkursus->fetch(PDO::FETCH_LAZY)) {
	  $html .= '
	   <tr>
		<td>'.$rowkursus["nama_bidang"].'</td>
		<td>'.$rowkursus["nama_penyelenggara"].'</td>
		<td>'.$rowkursus["tahun_masuk"].'</td>
		<td>'.$rowkursus["tahun_lulus"].'</td>
	   </tr>
	  ';
	 }
	 
	 $html .= '</table></div>';

	 $stmtpenghargaan = $db->prepare('SELECT * FROM tb_info_penghargaan where no_ktp = :no_ktp');
	 $stmtpenghargaan->bindParam(":no_ktp",$no_ktp);
	 $stmtpenghargaan->execute();

	 $html .= "
	 <style>
	table {
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
		margin-top:10px;
	}
	
	td, th {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	}
	
	tr:nth-child(even) {
		background-color: #dddddd;
	}
	.pendidikan{
		margin-top:50px;
	}
	</style>
	<div class='pendidikan'>
	<span style=font-size:30px;margin-top:20px;>Table Informasi Penghargaan</span>
	<table>
	 <tr>
	  <th>Nama Penghargaan</th>
	  <th>Tingkat</th>
	  <th>Keterangan</th>
	 </tr>
	";
	while ($rowpenghargaan = $stmtpenghargaan->fetch(PDO::FETCH_LAZY)) {
	 $html .= '
	  <tr>
	   <td>'.$rowpenghargaan["nama_penghargaan"].'</td>
	   <td>'.$rowpenghargaan["tingkat"].'</td>
	   <td>'.$rowpenghargaan["keterangan"].'</td>
	  </tr>
	 ';
	}
	
	$html .= '</table></div>';

	$stmtpenyakit = $db->prepare('SELECT * FROM tb_info_penyakit where no_ktp = :no_ktp');
	$stmtpenyakit->bindParam(":no_ktp",$no_ktp);
	$stmtpenyakit->execute();

	$html .= "
	<style>
   table {
	   font-family: arial, sans-serif;
	   border-collapse: collapse;
	   width: 100%;
	   margin-top:10px;
   }
   
   td, th {
	   border: 1px solid #dddddd;
	   text-align: left;
	   padding: 8px;
   }
   
   tr:nth-child(even) {
	   background-color: #dddddd;
   }
   .pendidikan{
	   margin-top:50px;
   }
   </style>
   <div class='pendidikan'>
   <span style=font-size:30px;margin-top:20px;>Table Informasi Penyakit</span>
   <table>
	<tr>
	 <th>Nama Penyakit</th>
	 <th>Status</th>
	</tr>
   ";
   while ($rowpenyakit = $stmtpenyakit->fetch(PDO::FETCH_LAZY)) {
	$html .= '
	 <tr>
	  <td>'.$rowpenyakit["nama_penyakit"].'</td>
	  <td>'.$rowpenyakit["status"].'</td>
	 </tr>
	';
   }
   
   $html .= '</table></div>';

   $stmtkeluarga = $db->prepare('SELECT * FROM tb_info_keluarga where no_ktp = :no_ktp');
   $stmtkeluarga->bindParam(":no_ktp",$no_ktp);
   $stmtkeluarga->execute();

   $html .= "
   <style>
  table {
	  font-family: arial, sans-serif;
	  border-collapse: collapse;
	  width: 100%;
	  margin-top:10px;
  }
  
  td, th {
	  border: 1px solid #dddddd;
	  text-align: left;
	  padding: 8px;
  }
  
  tr:nth-child(even) {
	  background-color: #dddddd;
  }
  .pendidikan{
	  margin-top:50px;
  }
  </style>
  <div class='pendidikan'>
  <span style=font-size:30px;margin-top:20px;>Table Informasi Keluarga</span>
  <table>
   <tr>
	<th>Nama Lengkap</th>
	<th>Status Keluarga</th>
	<th>Jenis Kelamin</th>
	<th>Tempat Lahir</th>
	<th> Tanggal Lahir</th>
	<th> Pendidikan </th>
	<th> Pekerjaan </th>
	<th> No Handphone </th>
   </tr>
  ";
  while ($rowkeluarga = $stmtkeluarga->fetch(PDO::FETCH_LAZY)) {
   $html .= '
	<tr>
	 <td>'.$rowkeluarga["nama_lengkap"].'</td>
	 <td>'.$rowkeluarga["status_keluarga"].'</td>
	 <td>'.$rowkeluarga["jenis_kelamin"].'</td>
	 <td>'.$rowkeluarga["tempat_lahir"].'</td>
	 <td>'.$rowkeluarga['tanggal_lahir'].'</td>
	 <td>'.$rowkeluarga["pendidikan"].'</td>
	 <td>'.$rowkeluarga["pekerjaan"].'</td>
	 <td>'.$rowkeluarga["nomor_handphone"].'</td>
	</tr>
   ';
  }
  
  $html .= '</table></div>';

  $stmtpekerjaan = $db->prepare('SELECT * FROM tb_info_pekerjaan where no_ktp = :no_ktp');
  $stmtpekerjaan->bindParam(":no_ktp",$no_ktp);
  $stmtpekerjaan->execute();

  $html .= "
  <style>
 table {
	 font-family: arial, sans-serif;
	 border-collapse: collapse;
	 width: 100%;
	 margin-top:10px;
 }
 
 td, th {
	 border: 1px solid #dddddd;
	 text-align: left;
	 padding: 8px;
 }
 
 tr:nth-child(even) {
	 background-color: #dddddd;
 }
 .pendidikan{
	 margin-top:50px;
 }
 </style>
 <div class='pendidikan'>
 <span style=font-size:30px;margin-top:20px;>Table Informasi Pekerjaan</span>
 <table>
  <tr>
   <th>Nama Perusahaan</th>
   <th>Tahun Masuk</th>
   <th>Tahun Keluar</th>
   <th>Jabatan</th>
   <th>Gaji Terakhir</th>
   <th>Alasan Berhenti</th>
   <th>Keterangan</th>
  </tr>
 ";
 while ($rowpekerjaan = $stmtpekerjaan->fetch(PDO::FETCH_LAZY)) {
  $html .= '
   <tr>
	<td>'.$rowpekerjaan["nama_perusahaan"].'</td>
	<td>'.$rowpekerjaan["tahun_masuk"].'</td>
	<td>'.$rowpekerjaan["tahun_keluar"].'</td>
	<td>'.$rowpekerjaan["jabatan"].'</td>
	<td>'.$rowpekerjaan["gaji"].'</td>
	<td>'.$rowpekerjaan["alasan_berhenti"].'</td>
	<td>'.$rowpekerjaan["keterangan"].'</td>
   </tr>
  ';
 }
 
 $html .= '</table></div>';

 $stmtreferensi = $db->prepare('SELECT * FROM tb_info_referensi where no_ktp = :no_ktp');
 $stmtreferensi->bindParam(":no_ktp",$no_ktp);
 $stmtreferensi->execute();

 $html .= "
 <style>
table {
	font-family: arial, sans-serif;
	border-collapse: collapse;
	width: 100%;
	margin-top:10px;
}

td, th {
	border: 1px solid #dddddd;
	text-align: left;
	padding: 8px;
}

tr:nth-child(even) {
	background-color: #dddddd;
}
.pendidikan{
	margin-top:50px;
}
</style>
<div class='pendidikan'>
<span style=font-size:30px;margin-top:20px;>Table Informasi Referensi</span>
<table>
 <tr>
  <th>Nama Lengkap</th>
  <th>Jabatan</th>
  <th>Nomor Handphone</th>
  <th>Hubungan</th>
 </tr>
";
while ($rowreferensi = $stmtreferensi->fetch(PDO::FETCH_LAZY)) {
 $html .= '
  <tr>
   <td>'.$rowreferensi["nama_lengkap"].'</td>
   <td>'.$rowreferensi["jabatan"].'</td>
   <td>'.$rowreferensi["nomor_hp"].'</td>
   <td>'.$rowreferensi["hubungan"].'</td>
  </tr>
 ';
}

$html .= '</table></div>';

$stmtpekerjaan = $db->prepare('SELECT * FROM tb_info_pekerjaan where no_ktp = :no_ktp');
$stmtpekerjaan->bindParam(":no_ktp",$no_ktp);
$stmtpekerjaan->execute();

$html .= "
<style>
table {
   font-family: arial, sans-serif;
   border-collapse: collapse;
   width: 100%;
   margin-top:10px;
}

td, th {
   border: 1px solid #dddddd;
   text-align: left;
   padding: 8px;
}

tr:nth-child(even) {
   background-color: #dddddd;
}
.pendidikan{
   margin-top:50px;
}
</style>
<div class='pendidikan'>
<span style=font-size:30px;margin-top:20px;>Table Informasi Pekerjaan</span>
<table>
<tr>
 <th>Nama Perusahaan</th>
 <th>Tahun Masuk</th>
 <th>Tahun Keluar</th>
 <th>Jabatan</th>
 <th>Gaji Terakhir</th>
 <th>Alasan Berhenti</th>
 <th>Keterangan</th>
</tr>
";
while ($rowpekerjaan = $stmtpekerjaan->fetch(PDO::FETCH_LAZY)) {
$html .= '
 <tr>
  <td>'.$rowpekerjaan["nama_perusahaan"].'</td>
  <td>'.$rowpekerjaan["tahun_masuk"].'</td>
  <td>'.$rowpekerjaan["tahun_keluar"].'</td>
  <td>'.$rowpekerjaan["jabatan"].'</td>
  <td>'.$rowpekerjaan["gaji"].'</td>
  <td>'.$rowpekerjaan["alasan_berhenti"].'</td>
  <td>'.$rowpekerjaan["keterangan"].'</td>
 </tr>
';
}

$html .= '</table></div>';

$stmtreferensi = $db->prepare('SELECT * FROM tb_info_referensi where no_ktp = :no_ktp');
$stmtreferensi->bindParam(":no_ktp",$no_ktp);
$stmtreferensi->execute();

$html .= "
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin-top:10px;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
.pendidikan{
  margin-top:50px;
}
</style>
<div class='pendidikan'>
<span style=font-size:30px;margin-top:20px;>Table Informasi Referensi</span>
<table>
<tr>
<th>Nama Lengkap</th>
<th>Jabatan</th>
<th>Nomor Handphone</th>
<th>Hubungan</th>
</tr>
";
while ($rowreferensi = $stmtreferensi->fetch(PDO::FETCH_LAZY)) {
$html .= '
<tr>
 <td>'.$rowreferensi["nama_lengkap"].'</td>
 <td>'.$rowreferensi["jabatan"].'</td>
 <td>'.$rowreferensi["nomor_hp"].'</td>
 <td>'.$rowreferensi["hubungan"].'</td>
</tr>
';
}

$html .= '</table></div>';


$stmtpsikotes = $db->prepare('SELECT tb_info_test.kode_test, tb_info_test.no_ktp, tb_hasil_test.nama_penilaian, tb_hasil_test.nilai, tb_hasil_test.tgl_input, tb_hasil_test.kd_admin FROM tb_info_test INNER JOIN tb_hasil_test ON tb_hasil_test.kd_test = tb_info_test.kode_test WHERE tb_info_test.no_ktp = :no_ktp');
$stmtpsikotes->bindParam(":no_ktp",$no_ktp);
$stmtpsikotes->execute();

$html .= "
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin-top:10px;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
.pendidikan{
  margin-top:50px;
}
</style>
<div class='pendidikan'>
<span style=font-size:30px;margin-top:20px;>Table Informasi Psikotes</span>
<table>
<tr>
<th>Judul Kriteria</th>
<th>Nilai</th>
<th>Grade</th>
<th>Date</th>
<th>Admin</th>
</tr>
";
$data = array();
$sum = 0;
while ($rowpsikotes = $stmtpsikotes->fetch(PDO::FETCH_LAZY)) {
	$n = $rowpsikotes['nilai'];
	$sum +=$n;
	$data[] = $rowpsikotes;

	$grade = $rowpsikotes['nilai'];
	switch ($grade) {
	  case '4':
		$value = "A";
		break;
	  case '3':
		$value = "B";
		break;
	  case '2':
		$value = "C";
		break;
	  default:
		$value = "D";
		break;
	}
$html .= '
<tr>
 <td>'.$rowpsikotes["nama_penilaian"].'</td>
 <td>'.$rowpsikotes["nilai"].'</td>
 <td>'.$value.'</td>
 <td>'.$rowpsikotes["tgl_input"].'</td>
 <td>'.$rowpsikotes["kd_admin"].'</td>
</tr>
';
}

$total = count($data);
if($sum != "0" && $total != "0"){
$hasil_test = @($sum/$total);
$total = @($sum/$total);
if($total > 0 && $total < 2){
	$grade = "D";
} elseif($total >= 2 && $total < 3 ){
	$grade = "C";
} elseif($total >= 3 && $total < 4){
	$grade = "B";
} elseif($total = 4){
	$grade = "A";
}else{
	$grade = "null";
}
}

$html .='<tr style="background-color: #055294; color: #fff;">
<td colspan="3">Total Nilai: '.$sum.'</td>
<td colspan="2">GRADE Total: '.$grade.'</td>
</tr></table></div>';

$stmtinterview = $db->prepare('SELECT tb_info_interview.kd_interview, tb_info_interview.no_ktp, tb_hasil_interview.nama_penilaian, tb_hasil_interview.nilai, tb_hasil_interview.tgl_input, tb_hasil_interview.kd_admin FROM tb_info_interview INNER JOIN tb_hasil_interview ON tb_hasil_interview.kd_interview = tb_info_interview.kd_interview WHERE tb_info_interview.no_ktp = :no_ktp');
$stmtinterview->bindParam(":no_ktp",$no_ktp);
$stmtinterview->execute();

$html .= "
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin-top:10px;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
.pendidikan{
  margin-top:50px;
}
</style>
<div class='pendidikan'>
<span style=font-size:30px;margin-top:20px;>Table Informasi Interview</span>
<table>
<tr>
<th>Judul Kriteria</th>
<th>Nilai</th>
<th>Grade</th>
<th>Date</th>
<th>Admin</th>
</tr>
";
$data = array();
$sum = 0;
while ($rowinterview = $stmtinterview->fetch(PDO::FETCH_LAZY)) {
	$n = $rowinterview['nilai'];
	$sum +=$n;
	$data[] = $rowinterview;

	$grade = $rowinterview['nilai'];
	switch ($grade) {
	  case '4':
		$value = "A";
		break;
	  case '3':
		$value = "B";
		break;
	  case '2':
		$value = "C";
		break;
	  default:
		$value = "D";
		break;
	}
$html .= '
<tr>
 <td>'.$rowinterview["nama_penilaian"].'</td>
 <td>'.$rowinterview["nilai"].'</td>
 <td>'.$value.'</td>
 <td>'.$rowinterview["tgl_input"].'</td>
 <td>'.$rowinterview["kd_admin"].'</td>
</tr>
';
}

if($sum != "0" && $total != "0"){
	$hasil_test = @($sum/$total);
	$total = @($sum/$total);
	if($total > 0 && $total < 2){
		$grade = "D";
	} elseif($total >= 2 && $total < 3 ){
		$grade = "C";
	} elseif($total >= 3 && $total < 4){
		$grade = "B";
	} elseif($total = 4){
		$grade = "A";
	}else{
		$grade = "null";
	}
	}
	
	$html .='<tr style="background-color: #055294; color: #fff;">
	<td colspan="3">Total Nilai: '.$sum.'</td>
	<td colspan="2">GRADE Total: '.$grade.'</td>
	</tr></table></div>';



	 

$dompdf->loadHtml($html);

/* Render the HTML as PDF */
$dompdf->render();

/* Output the generated PDF to Browser */
$dompdf->stream(''.$row['no_ktp']. ' - ' .$row['nama_depan']. ' ' .$row['nama_belakang'].'' ,array("Attachment" => false));
?>