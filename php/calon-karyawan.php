<div class="clearfix"></div>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>List Pelamar </h2>

      <div class="clearfix"></div>
    </div>

    <div class="x_content">


      <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
          <thead>
            <tr class="headings">
              <th>
                <input type="checkbox" id="check-all" class="flat">
              </th>
              <th class="column-title">Nomor KTP </th>
              <th class="column-title">Nama Lengkap </th>
              <th class="column-title">Jenis Kelamin</th>
              <th class="column-title">Email </th>
              <th class="column-title">Nomor Telp </th>
              <th class="column-title">Tanggal Daftar </th>
              <!-- <th class="column-title">Posisi Lamaran </th> -->

              <th class="column-title no-link last"><span class="nobr">Action</span>
              </th>
              <th class="bulk-actions" colspan="7">
                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
              </th>
            </tr>
          </thead>
          <?php

            $calon = new Karyawan();
            $stmt = $calon->runQuery("SELECT tb_karyawan.no_ktp, no_NIK, nama_depan, nama_belakang, jenis_kelamin, tb_karyawan.email, nomor_hp, tb_login_karyawan.joining_date FROM tb_karyawan
              LEFT JOIN tb_login_karyawan ON tb_login_karyawan.no_ktp = tb_karyawan.no_ktp
              WHERE no_NIK = '' ORDER BY tb_login_karyawan.joining_date DESC");
            $stmt->execute();
          ?>
          <tbody>
          <?php
            if ($stmt->rowCount() == 0 ) {
              # code...
              ?>
              <tr>
                <td colspan="9">Data tidak ada</td>
              </tr>
              <?php
            } else {
              while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
              # code...
             ?>
            <tr class="even pointer">
              <td class="a-center ">
                <input type="checkbox" class="flat" name="table_records">
              </td>
              <td class=" "><?php echo $row['no_ktp']; ?></td>
              <td class=" "><?php echo $row['nama_depan']; ?> <?php echo $row['nama_belakang']; ?></td>
              <td class=" "><?php echo $row['jenis_kelamin']; ?></td>
              <td class=" "><?php echo $row['email']; ?></td>
              <td class=" "><?php echo $row['nomor_hp']; ?></td>
              <td class=" "><?php echo $row['joining_date']; ?></td>
              <!-- <td class=" "><span class="label label-success"><?php echo $row['nama_pekerjaan']; ?></span></td> -->
              <td>
                <a href="?p=detail-karyawan&id=<?php echo $row['no_ktp']; ?>">
                  <button type="button" class="btn btn-primary btn-xs">
                    <i class="fa fa-user"> </i> View Profile
                  </button>
                </a>
              </td>
              </td>
            </tr>
            <?php } } ?>

          </tbody>
        </table>
      </div>

</div>
    </div>
    </div>
