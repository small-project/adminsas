<?php


$sql1 = "SELECT tb_karyawan.no_ktp, tb_karyawan.no_NIK, tb_karyawan.nama_depan, tb_karyawan.nama_belakang, tb_kode_status_karyawan.nama_kode FROM tb_karyawan 
INNER JOIN tb_kode_status_karyawan ON tb_kode_status_karyawan.kd_id = tb_karyawan.kd_status_karyawan
WHERE tb_karyawan.no_NIK !='' AND tb_karyawan.kd_status_karyawan IN ('KDKRY0006', 'KDKRY0008', 'KDKRY0009', 'KDKRY0010')";
// $sql1 = 'SELECT * FROM tb_karyawan WHERE no_NIK !="" AND kd_status_karyawan LIKE :arrayData';
$sql2 = 'SELECT * FROM tb_karyawan WHERE no_NIK = ""';

$karyawanAvailable = $config->runQuery($sql1);
$karyawanAvailable->execute();

$karyawanProject = $config->runQuery($sql2);
$karyawanProject->execute();

?>

<div class="x_panel">
  <div class="x_title">
    <h2>Data Perusahaan</h2>

    <div class="clearfix"></div>
  </div>
  <div class="x_content">

    <div class="col-md-12">


      <br/>

      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Karyawan Available</a>
          </li>
          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Karyawan Dalam Project</span></a>
          </li>
        </ul>

        <div id="myTabContent" class="tab-content">
          <div role="tabpanel" class="tab-pane active fade in" id="tab_content1" aria-labelledby="home-tab">

            <!-- start recent activity -->
            <ul class="messages">
              <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th class="column-title" width="20%">Nomor NIP </th>
                      <th class="column-title" width="30%">Nama Karyawan </th>
                      <th class="column-title" width="30%">Status Karyawan </th>
                      <th class="column-title" width="20%">Detail Karyawan </th>
                    </tr>
                  </thead>
                  <?php while ($data = $karyawanAvailable->fetch(PDO::FETCH_LAZY)) { ?>
                  <tbody>
                        <tr class="even pointer">


                          <td class="col-md-2" style="text-transform: uppercase;"><?=$data['no_NIK']?></td>
                          <td class="col-md-2"><?=$data['nama_depan']?> <?=$data['nama_belakang']?></td>
                          <td class="col-md-2">
                              <span class="label label-success" style="font-size: 12px; text-transform: capitalize;"><?=$data['nama_kode']?></span>
                            </td>
                          <td class="col-md-2">
                            <a href="?p=detail-karyawan&id=<?=$data['no_ktp']; ?>">
                              <button type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-user"> </i> View Profile
                              </button>
                            </a>
                          </td>

                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                  </div>
                </ul>
                <!-- end recent activity -->

              </div>
              <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                <!-- start user projects -->

                <ul class="messages">
                  <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                      <thead>
                        <tr class="headings">
                          <th class="column-title">Nama Perusahaan </th>
                          <th class="column-title">CP </th>
                          <th class="column-title">Handphone </th>
                          <th class="column-title">Email </th>
                          <th class="column-title">Kebutuhan </th>
                          <th class="column-title">Bergabung Sejak </th>
                          <th class="column-title">Action </th>
                        </tr>
                      </thead>
                      <?php
                      $calon = new Karyawan();
                      $stmt = $calon->runQuery("SELECT tb_temporary_perusahaan.no_pendaftaran, tb_temporary_perusahaan.kode_perusahaan, tb_temporary_perusahaan.nama_perusahaan, tb_temporary_perusahaan.cp, tb_temporary_perusahaan.phone, tb_temporary_perusahaan.email, tb_temporary_perusahaan.create_date, tb_temporary_perusahaan.status, tb_jenis_pekerjaan.nama_pekerjaan, tb_kategori_pekerjaan.nama_kategori
                        FROM tb_temporary_perusahaan
                        LEFT JOIN tb_jenis_pekerjaan ON tb_jenis_pekerjaan.kd_pekerjaan=tb_temporary_perusahaan.kode_pekerjaan
                        LEFT JOIN tb_kategori_pekerjaan ON tb_kategori_pekerjaan.kode_kategori=tb_temporary_perusahaan.kebutuhan
                        WHERE tb_temporary_perusahaan.kode_perusahaan = ''
                        ORDER BY tb_temporary_perusahaan.create_date DESC");
                      $stmt->execute(array());
                      ?>
                      <tbody>
                        <?php
                        if ($stmt->rowCount() == '') {
                                            # code...
                          ?>
                          <tr>
                            <td colspan="7">Data Tidak Ada</td>
                          </tr>
                          <?php
                        } else{
                          while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                                            # code...
                            ?>
                            <tr class="even pointer">


                              <td class="col-md-2"><?php echo $row['nama_perusahaan']; ?></td>
                              <td class="col-md-2"><?php echo $row['cp']; ?></td>
                              <td class="col-md-2"><?php echo $row['phone']; ?></td>
                              <td class="col-md-2"><?php echo $row['email']; ?></td>
                              <td class="col-md-1"><?php echo $row['nama_kategori']; ?></td>
                              <td class="col-md-2"><?php echo $row['create_date']; ?></td>
                              <td class="col-md-2">
                                <a href="?p=detail-entry&name=<?php echo $row['no_pendaftaran']; ?>">
                                  <button type="button" class="btn btn-success btn-xs"> <i class="fa fa-edit">
                                  </i>  Entry </button>
                                </a>
                                <a href="php/delete-request.php?id=<?php echo $row['no_pendaftaran']; ?>" onClick="return confirm('Yakin data akan dihapus?')" >
                                  <button type="button" class="btn btn-danger btn-xs">
                                    <i class="fa fa-remove">  </i>  Delete
                                  </button>
                                </a>

                              </td>

                            </tr>
                            <?php } }?>
                          </tbody>
                        </table>
                      </div>
                    </ul>


                    <!-- end user projects -->

                  </div>


                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
