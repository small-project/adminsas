<div class="clearfix"></div>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>List Karyawan Psikotes </h2>
      
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
              <th class="column-title">Kode Test</th>
              <th class="column-title">Tanggal Ujian </th>
              <th class="column-title">Status </th>
              <th class="column-title">Kode Admin </th>
              <th class="column-title no-link last"><span class="nobr">Action</span>
              </th>
              <th class="bulk-actions" colspan="7">
                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
              </th>
            </tr>
          </thead>
          <?php
            $calon = new Karyawan();

            $stmt = $calon->runQuery("SELECT tb_karyawan.no_ktp, tb_karyawan.no_NIK, tb_karyawan.nama_depan, tb_karyawan.nama_belakang, tb_info_test.kode_test, tb_info_test.date_test, tb_info_test.nilai, tb_info_test.kode_admin, tb_info_test.status FROM tb_karyawan LEFT OUTER JOIN tb_info_test ON tb_info_test.no_ktp=tb_karyawan.no_ktp WHERE tb_karyawan.no_NIK =''");

            $stmt->execute();
          ?>
          <tbody>
          <?php
          while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
              # code...
            $tgl = $row['date_test'];

            if ($tgl == '') {
              # code...
              $button = '<button type="button" class="btn btn-primary btn-xs">
                    <i class="fa fa-plus-square"> </i> Add Jadwal
                  </button>';
            }else{
              $button = '<button type="button" class="btn btn-danger btn-xs">
                    <i class="fa fa-plus-square"> </i> Re-Schedule
                  </button>';
            
            }
            ?>
            <tr class="even pointer">
              <td class="a-center ">
                <input type="checkbox" class="flat" name="table_records">
              </td>
              <td class=" "><?php echo $row['no_ktp']; ?></td>
              <td class=" "><?php echo $row['nama_depan']; ?> <?php echo $row['nama_belakang']; ?></td>
              <td class=" "><?php echo $row['kode_test']; ?></td>
              <td class=" "><?php echo $row['date_test']; ?></td>

              
              <td class=" "><span class="label label-success"><?php echo $row['status']; ?></span></td>
              <td class=" "><?php echo $row['kode_admin']; ?></td>


              <td>
                <a href="?p=add-jadwal-test&id=<?php echo $row['no_ktp']; ?>">
                 <?php echo $button; ?>
                </a>
              </td>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      </div>
      </div>
      </div>
      



          