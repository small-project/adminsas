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
        <th style="width: 20%">#Edit</th>
      </tr>
    </thead>
    <tbody>

    <?php
      $sql = "SELECT tb_kerjasama_perusahan.nomor_kontrak, tb_temporary_perusahaan.no_pendaftaran, tb_temporary_perusahaan.kode_perusahaan, tb_temporary_perusahaan.nama_perusahaan, tb_kerjasama_perusahan.tgl_input, tb_job.kode_detail_job FROM `tb_kerjasama_perusahan` LEFT JOIN tb_temporary_perusahaan ON tb_temporary_perusahaan.kode_perusahaan = tb_kerjasama_perusahan.kode_perusahaan LEFT JOIN tb_job ON tb_job.nomor_kontrak=tb_kerjasama_perusahan.nomor_kontrak ";
      $stmt = $config->runQuery($sql);
      $stmt->execute();

      while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
          $total2 = $row['no_pendaftaran'];
          $dt = "SELECT tb_kerjasama_perusahan.id FROM tb_kerjasama_perusahan WHERE tb_kerjasama_perusahan.kode_perusahaan = :list";
          $md = $config->runQuery($dt);
          $md->execute(array(
                  ':list'   => $total2
          ));
          $totalData = $md->rowCount();


          //end of total list karyawan
    ?>
      <tr>
        <td>#</td>
        <td>
          <a style="text-transform: uppercase;"><?php echo $row['nama_perusahaan']; ?></a>
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
            <span class="label label-danger"><?php echo $totalData; ?></span> list Pekerjaan
        </td>
        <td>
          <button type="button" class="btn btn-success btn-xs">a</button>
        </td>
        <td>
          <a href="?p=detail-list&id=<?php echo $row['kode_perusahaan'] ?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
          <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
        </td>
      </tr>
      <?php } ?>

    </tbody>
  </table>
  <!-- end project list -->

</div>
</div>
