<div class="clearfix"></div>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>List Karyawan Interview </h2>
      
      <div class="clearfix"></div>
    </div>

    <div class="x_content">


      <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
          <thead>
            <tr class="headings">

              <th class="column-title">Nomor KTP </th>
              <th class="column-title">Nama Lengkap </th>
              <th class="column-title">Kode Interview</th>
              <th class="column-title">Tanggal Interview </th>
              <th class="column-title">Detail </th>
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
          $calon = new Admin();
          $records_per_page = 20;

          $query = "SELECT tb_karyawan.no_ktp, tb_karyawan.no_NIK, tb_karyawan.nama_depan, tb_karyawan.nama_belakang, tb_info_interview.kd_interview, tb_info_interview.date_interview, tb_info_interview.detail, tb_info_interview.status, tb_info_interview.kd_admin, tb_info_interview.create_date
          FROM tb_karyawan
          LEFT OUTER JOIN tb_info_interview ON tb_info_interview.no_ktp=tb_karyawan.no_ktp WHERE tb_karyawan.no_NIK ='' 
          ORDER BY tb_karyawan.nama_depan ASC";
          $sql = $calon->paging($query, $records_per_page);
          $stmt = $calon->runQuery($sql);
          $stmt->execute();


          ?>
          <tbody>
          <?php
          while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
              # code...
            $tgl = $row['date_interview'];
            if ($tgl == '') {
              # code...
              $kode = '<button type="button" class="btn btn-primary btn-xs">
                    <i class="fa fa-plus-square"> </i> Add Jadwal
                  </button>';
            } else {
              $kode = '<button type="button" class="btn btn-warning btn-xs">
                    <i class="fa fa-plus-square"> </i> Re-schedule
                  </button>';
            }
             ?>
            <tr class="even pointer">

              <td class=" ">
                <a href="?p=detail-karyawan&id=<?=$row['no_ktp']; ?>" data-toggle="tooltip" data-placement="left" title="Views Profile">
                  <button type="button" class="btn btn-primary btn-xs">
                     <?=$row['no_ktp']?> <i class="fa fa-chevron-circle-right"></i> 
                  </button>
                </a>
              </td>
              <td class=" "><?php echo $row['nama_depan']; ?> <?php echo $row['nama_belakang']; ?></td>
              <td class=" "><?php echo $row['kd_interview']; ?></td>
              <td class=" "><?php echo $row['date_interview']; ?></td>
              <td class=" "><?php echo $row['detail']; ?></td>
                <td class=" "><span class="label label-success"><?php echo $row['status']; ?></span></td>
                <td class=" "><?php echo $row['kd_admin']; ?></td>

              <td>
                <a href="?p=add-jadwal-interview&id=<?php echo $row['no_ktp']; ?>">
                  <?php echo $kode; ?>
                </a>
              </td>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php
        
        $stmt = $calon->paginglink($query, $records_per_page);

        
        ?>
      </div>
      </div>
      </div>
      </div>
      



          