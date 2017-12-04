<div class="x_panel">
<div class="x_title">
  <h2>Projects</h2>

  <div class="clearfix"></div>
</div>
<div class="x_content">

  <p>List Job</p>

  <!-- start project list -->
  <table class="table table-striped projects">
    <thead>
      <tr>
        <th style="width: 1%">#</th>
        <th style="width: 20%">Project Name</th>
        <th>Team Members</th>
        <th>Total Pekerjaan</th>
        <th>Status</th>
        <th style="width: 20%">Edit</th>
      </tr>
    </thead>
    <tbody>

    <?php
      $sql = "SELECT tb_kerjasama_perusahan.nomor_kontrak, tb_kerjasama_perusahan.kode_perusahaan, tb_kerjasama_perusahan.kode_plan, tb_kerjasama_perusahan.kode_list_karyawan, tb_kerjasama_perusahan.total_karyawan, tb_kerjasama_perusahan.tgl_input, tb_perusahaan.nama_perusahaan, tb_kategori_pekerjaan.nama_kategori FROM tb_kerjasama_perusahan INNER JOIN tb_perusahaan ON tb_perusahaan.kode_perusahaan = tb_kerjasama_perusahan.kode_perusahaan INNER JOIN tb_kategori_pekerjaan ON tb_kategori_pekerjaan.kode_kategori = tb_kerjasama_perusahan.kode_plan";
      $stmt = $config->runQuery($sql);
      $stmt->execute();

      while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
          $total2 = $row['no_pendaftaran'];
          $dt = "SELECT tb_kerjasama_perusahan.id FROM tb_kerjasama_perusahan WHERE tb_kerjasama_perusahan.kode_perusahaan = :list";
          $md = $config->runQuery($dt);
          $md->execute(array(
                  ':list'   => $total2
          ));
          //end of total list karyawan
          $total = $row['total_karyawan'];
          if ($total > 0) {$nilai = $row['total_karyawan'];} else {$nilai = '0';}
    ?>
      <tr>
        <td>#</td>
        <td>
          <a style="text-transform: uppercase;"><?= $row['nama_kategori']; ?> ~ <?= $row['nama_perusahaan']; ?></a>
          <br>
          <small>Created <?php echo $row['tgl_input']; ?></small>
        </td>
        <td>
          <ul class="list-inline">
              <?php while ($col = $md->fetch(PDO::FETCH_LAZY)){ ?>
            <li>
              <img src="<?php echo $col['foto'];?>" class="avatar" alt="Avatar">
            </li>
              <?php } ?>
          </ul>
        </td>
        <td class="project_progress">
            <span class="label label-danger"><?=$nilai?></span> list Pekerjaan
        </td>
        <td>
          <button type="button" class="btn btn-success btn-xs">a</button>
        </td>
        <td>
          <a href="?p=detailProject&id=<?php echo $row['nomor_kontrak'] ?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
        </td>
      </tr>
      <?php } ?>

    </tbody>
  </table>
  <!-- end project list -->

</div>
</div>
