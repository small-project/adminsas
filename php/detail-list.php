<?php
$kode = $_GET['id'];

$query = "SELECT tb_perusahaan.kode_perusahaan, tb_temporary_perusahaan.no_pendaftaran, tb_perusahaan.nama_perusahaan, tb_kerjasama_perusahan.nomor_kontrak, tb_kerjasama_perusahan.kode_plan, tb_kerjasama_perusahan.total_karyawan, tb_kerjasama_perusahan.deskripsi, tb_kerjasama_perusahan.tugas, tb_kerjasama_perusahan.tanggung_jwb, tb_kerjasama_perusahan.penempatan, tb_kerjasama_perusahan.kontrak_start, tb_kerjasama_perusahan.kontrak_end FROM tb_perusahaan
INNER JOIN tb_temporary_perusahaan ON tb_temporary_perusahaan.kode_perusahaan=tb_perusahaan.kode_perusahaan
INNER JOIN tb_kerjasama_perusahan ON tb_kerjasama_perusahan.kode_perusahaan=tb_temporary_perusahaan.kode_perusahaan
WHERE tb_perusahaan.kode_perusahaan = :nomor_kontrak";
$conn = new Karyawan();
$stmt = $conn->runQuery($query);
$stmt->execute(array(
    ':nomor_kontrak' => $kode
));
?>
<br/>
<h4 class="page-header">List Data</h4>

<?php while ($col = $stmt->fetch(PDO::FETCH_LAZY)) {
$type = $col['kode_plan'];
switch ($type) {
  case 'BPO01':
    $name = "BPO";
    break;
  case 'MPO01':
      $name = "MPO";
    break;
  case 'SYG01':
      $name = "System Integrator";
    break;
  case 'KST01':
      $name = "Konsultan";
    break;

  default:
    # code...
    $name ="";
    break;
}
  ?>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?=$col['nomor_kontrak']?>" aria-expanded="true" aria-controls="1">
                    Type Plan: <?=$name?>
                </a>
                <span class="pull-right" style="font-size:12px;">Start Date: <?=$col['kontrak_start']?> ~ End Date: <?=$col['kontrak_end']?></span>
            </h4>
        </div>
        <div id="<?=$col['nomor_kontrak']?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <div class="row">
                  <div class="col-md-4">
                    <h5 class="page-header">Deskripsi</h5>
                    <br>
                    <p><?=$col['deskripsi']?></p>
                  </div>
                  <div class="col-md-4">
                    <h5 class="page-header">Tugas</h5>
                    <br>
                    <p><?=$col['tugas']?></p>
                  </div>
                  <div class="col-md-4">
                    <h5 class="page-header">Tanggung Jawab</h5>
                    <br>
                    <p><?=$col['tanggung_jwb']?></p>
                  </div>
                </div>
                <div class="col-md-12">
                  <hr>
                  <p style="font-weight: 600;">Penempatan Kerja: <?=$col['penempatan']?>
                    <span class="pull-right">
                      <button type="button" class="btn btn-sm btn-primary" name="button">List Karyawan</button>
                    </span>
                  </p>

                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
