<?php
  $cek = new Admin();
  $sql = 'SELECT tb_push.subject, tb_push.kd_push, tb_push.create_date, tb_push.dari, tb_push.kepada, tb_karyawan.no_ktp, tb_karyawan.nama_depan, tb_karyawan.nama_belakang, tb_admin.nama_admin, tb_detail_push.kd_detail, tb_detail_push.inisial, tb_detail_push.pesan, tb_detail_push.create_date FROM tb_push
    LEFT JOIN tb_karyawan ON tb_karyawan.no_ktp=tb_push.kepada
    LEFT JOIN tb_admin ON tb_admin.username=tb_push.dari
    LEFT JOIN tb_detail_push ON tb_detail_push.kd_push=tb_push.kd_push
    ORDER BY tb_push.create_date DESC
  ';
  $stmt = $cek->runQuery($sql);
  $stmt->execute();

if ($stmt->rowCount() == '0') {

  # code...
  ?>

<div class="alert alert-info alert-dismissible fade in" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
  </button>
  <strong>Hore!</strong> belum ada push
</div>

  <?php
}else {
  while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
     # code...
  
?>
    <a class="tampilData" href="#" data-id="<?php echo $row['kd_push']; ?>" data-jd="<?php echo $row['subject']; ?>" data-kd = "<?php echo $row['kd_detail']; ?>" data-in = "<?php echo $row['inisial']; ?>" data-ps = "<?php echo $row['pesan']; ?>" data-cd = "<?php echo $row['create_date']; ?>" data-nama = "<?php echo $row['nama_depan']; ?> <?php echo $row['nama_belakang']; ?>">
      <div class="mail_list">
        <div class="left">
          <i class="fa fa-circle"></i>
        </div>
        <div class="right">
          <h3><?php echo $row['subject']; ?> <small><?php echo $row['create_date']; ?></small></h3>
          <p>Dari <?php echo $row['nama_admin']; ?> untuk <?php echo $row['nama_depan']; ?> <?php echo $row['nama_belakang']; ?></p>
        </div>
      </div>
    </a>
<?php }
}?>