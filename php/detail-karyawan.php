<?php

$no_ktp = $_GET['id'];

$detail = new Karyawan();

$stmt = $detail->runQuery("SELECT * FROM tb_karyawan WHERE no_ktp = :id");
$stmt->bindParam(':id', $no_ktp);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_LAZY);
$nik = $row['no_NIK'];
$nilai = $row['nilai'];

if ($nilai == "") {
  # code...
    $st = "Belum Ujian";
    $color = "btn-info";
}elseif ($nilai == "0") {
  # code...
    $st = "Tidak Lulus";
    $color = "btn-danger";
}else{
  $st = "Lulus";
    $color = "btn-success";
}

if ($nik == "") {
  # code...
  $pesan = "Detail Calon Karyawan";
  $nik = "NIK belum terdaftar";

} else{
  $pesan = "Detail Karyawan";
  $nik = $row['no_NIK'];
}
?>


<div class="x_panel">
  <div class="x_title">
    <h2><?php echo $pesan; ?></h2>

    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
      <div class="profile_img">
        <div id="crop-avatar">
          <!-- Current avatar -->
          <img class="img-responsive avatar-view" src="<?php echo $row['foto']; ?>" alt="Avatar" title="Change the avatar">
        </div>
      </div>
      <h3><?php echo $row['nama_depan']; ?> <?php echo $row['nama_belakang']; ?> <button class="btn btn-success btn-sm"><?php echo $row['jenis_kelamin']; ?></button></h3>

      <ul class="list-unstyled user_data">
        <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $row['alamat']; ?>, <?php echo $row['kelurahan']; ?>, <?php echo $row['kecamatan']; ?>, <?php echo $row['kota']; ?>
        </li>

        <li>
          <i class="fa fa-phone-square user-profile-icon"></i> <?php echo $row['nomor_hp']; ?>
        </li>

        <li class="m-top-xs">
          <i class="fa fa-envelope user-profile-icon"></i>
          <?php echo $row['email']; ?>
        </li>
      </ul>

      <a class="btn btn-danger"><i class="fa fa-qrcode m-right-xs"></i> <?php echo $nik; ?></a>
      <a class="btn <?=$color?>"><i class="fa fa-qrcode m-right-xs"></i> <?php echo $st; ?></a>
      <a class="btn btn-success" href="php/export.php?id=<?php echo $row['no_ktp']; ?>"><i class="fa fa-qrcode m-right-xs"></i> Export Data Karyawan</a>
      <br/>

      <!-- start skills -->
      <h4 class="text-success"> <strong>Keahlian</strong></h4>
      <ul class="list-unstyled user_data">
      <?php
                  $widget = new Karyawan();

                  $stmt = $widget->runQuery("SELECT * FROM tb_info_keahlian where no_ktp = :no_ktp");
                  $stmt->bindParam(':no_ktp', $no_ktp);
                  $stmt->execute();

                  while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                    # code...

                ?>
        <li>
          <p><?php echo $row['nama_keahlian']; ?></p>
          <div class="progress progress">
            <div class="progress-bar bg-info" role="progressbar" data-transitiongoal="<?php echo $row['nilai']; ?>" aria-valuenow="0" style="width: 0%;"> <?php echo $row['nilai']; ?>%</div>
          </div>
        </li>
        <?php } ?>

      </ul>

      <!-- end of skills -->

      <br/>


    </div>
    <div class="col-md-9 col-sm-9 col-xs-12">

      <div class="col-md-12">
      <div class="profile_title">
        <div class="col-md-6">
          <h2>Informasi Data</h2>
        </div>
        <div class="col-md-6">

        </div>
      </div>

      <br/>

      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Pendidikan</a>
          </li>
          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Bahasa</a>
          </li>
          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Kursus</a>
          </li>
          <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab4" data-toggle="tab" aria-expanded="false">Penghargaan</a>
          </li>
          <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab5" data-toggle="tab" aria-expanded="false">Penyakit</a>
          </li>
          <li role="presentation" class=""><a href="#tab_content6" role="tab" id="profile-tab6" data-toggle="tab" aria-expanded="false">Psikotes</a>
          </li>
          <li role="presentation" class=""><a href="#tab_content7" role="tab" id="profile-tab7" data-toggle="tab" aria-expanded="false">Interviews</a>
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
                        <th class="column-title">Tingkat Pendidikan </th>
                        <th class="column-title">Nama Badan Pendidikan </th>
                        <th class="column-title">Jurusan </th>
                        <th class="column-title">Tahun Masuk </th>
                        <th class="column-title">Tahun Keluar </th>
                        <th class="column-title">Nilai (Rata-Rata) </th>
                        <th class="bulk-actions" colspan="7">
                          <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                        </th>
                      </tr>
                    </thead>
                    <?php
                      $calon = new Karyawan();
                      $stmt = $calon->runQuery("SELECT * FROM tb_info_pendidikan where no_ktp = :no_ktp");
                      $stmt->bindParam(':no_ktp', $no_ktp);
                      $stmt->execute();
                    ?>
                    <tbody>
                    <?php
                    while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                        # code...
                       ?>
                      <tr class="even pointer">

                        <td class=" "><?php echo $row['tingkat']; ?> <?php echo $row['nama_belakang']; ?></td>
                        <td class=" "><?php echo $row['nama_bapen']; ?></td>
                        <td class=" "><?php echo $row['jurusan']; ?></td>
                        <td class=" "><?php echo $row['tahun_masuk']; ?></td>
                        <td class=" "><?php echo $row['tahun_lulus']; ?></td>
                        <td class=" "><?php echo $row['nilai']; ?></td>

                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
            </ul>
            <!-- end recent activity -->

          </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

            <!-- start user projects -->
              <?php
                  $widget = new Karyawan();

                  $stmt = $widget->runQuery("SELECT * FROM tb_info_bahasa where no_ktp = :no_ktp");
                  $stmt->bindParam(':no_ktp', $no_ktp);
                  $stmt->execute();

                  while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                    # code...

                ?>

                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="x_panel tile overflow_hidden">
                    <div class="x_title">
                      <h2><?php echo $row['nama_bahasa']; ?></h2>

                      <div class="clearfix"></div>
                    </div>
                    <div class="progress progress">
                      <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $row['writing']; ?>" aria-valuenow="0" style="width: 0%;"> <?php echo $row['writing']; ?>%</div>
                    </div>
                    <div class="progress progress">
                      <div class="progress-bar bg-red" role="progressbar" data-transitiongoal="<?php echo $row['listening']; ?>" aria-valuenow="0" style="width: 0%;"> <?php echo $row['listening']; ?>%</div>
                    </div>
                    <div class="progress progress">
                      <div class="progress-bar bg-blue" role="progressbar" data-transitiongoal="<?php echo $row['speaking']; ?>" aria-valuenow="0" style="width: 0%;"> <?php echo $row['speaking']; ?>%</div>
                    </div>
                    <div class="x_panel footer">
                      <i class="fa fa-square green"></i> Writing
                      <i class="fa fa-square red"></i> Listening
                      <i class="fa fa-square blue"></i> Speaking

                    </div>
                  </div>
                </div>

                <?php } ?>

            <!-- end user projects -->

          </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
            <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th class="column-title">Bidang Kursus</th>
                      <th class="column-title">Badan Penyelenggara </th>
                      <th class="column-title">Tahun Masuk </th>
                      <th class="column-title">Tahun Lulus </th>
                    </tr>
                  </thead>
                  <?php
                    $calon = new Karyawan();
                    $stmt = $calon->runQuery("SELECT * FROM tb_info_kursus where no_ktp = :no_ktp");
                    $stmt->bindParam(':no_ktp', $no_ktp);
                    $stmt->execute();
                  ?>
                  <tbody>
                  <?php
                  while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                      # code...
                     ?>
                    <tr class="even pointer">

                      <td class=" "><?php echo $row['nama_bidang']; ?></td>
                      <td class=" "><?php echo $row['nama_penyelenggara']; ?></td>
                      <td class=" "><?php echo $row['tahun_masuk']; ?></td>
                      <td class=" "><?php echo $row['tahun_lulus']; ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
          </div>

          <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">

              <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th class="column-title">Nama Penghargaan</th>
                      <th class="column-title">Tingkat Bidang </th>
                      <th class="column-title">Keterangan </th>
                    </tr>
                  </thead>
                  <?php
                    $calon = new Karyawan();
                    $stmt = $calon->runQuery("SELECT * FROM tb_info_penghargaan where no_ktp = :no_ktp");
                    $stmt->bindParam(':no_ktp', $no_ktp);
                    $stmt->execute();
                  ?>
                  <tbody>
                  <?php
                  while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                      # code...
                     ?>
                    <tr class="even pointer">

                      <td class=" "><?php echo $row['nama_penghargaan']; ?></td>
                      <td class=" "><?php echo $row['tingkat']; ?></td>
                      <td class=" "><?php echo $row['keterangan']; ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

          </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">

              <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th class="column-title">Nama Penyakit</th>
                      <th class="column-title">Status Diagnosis Terakhir</th>
                    </tr>
                  </thead>
                  <?php
                    $calon = new Karyawan();
                    $stmt = $calon->runQuery("SELECT * FROM tb_info_penyakit where no_ktp = :no_ktp");
                    $stmt->bindParam(':no_ktp', $no_ktp);
                    $stmt->execute();
                  ?>
                  <tbody>
                  <?php
                  while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                      # code...
                     ?>
                    <tr class="even pointer">

                      <td class=" "><?php echo $row['nama_penyakit']; ?></td>
                      <td class=" "><?php echo $row['status']; ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

          </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_content6" aria-labelledby="profile-tab6">

              <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th class="column-title">Judul Kriteria</th>
                      <th class="column-title">Nilai</th>
                      <th class="column-title">Grade</th>
                      <th class="column-title">Date</th>
                      <th class="column-title">Admin</th>
                    </tr>
                  </thead>
                  <?php
                    $calon = new Karyawan();
                    $stmt = $calon->runQuery("SELECT tb_info_test.kode_test, tb_info_test.no_ktp, tb_hasil_test.nama_penilaian, tb_hasil_test.nilai, tb_hasil_test.tgl_input, tb_hasil_test.kd_admin FROM tb_info_test INNER JOIN tb_hasil_test ON tb_hasil_test.kd_test = tb_info_test.kode_test WHERE tb_info_test.no_ktp = :no_ktp");
                    $stmt->bindParam(':no_ktp', $no_ktp);
                    $stmt->execute();

                    if ($stmt->rowCount() >= 1) { ?>
                      <tbody>
                      <?php
                      $data = array();
                     $sum = 0;
                      while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                          # code...
                          $n = $row['nilai'];
                          $sum +=$n;
                          $data[] = $row;

                          $grade = $row['nilai'];
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
                         ?>
                        <tr class="even pointer">

                          <td class=" "><?=$row['nama_penilaian']?></td>
                          <td class=" "><?=$row['nilai']?></td>
                          <td class=" "><?=$value?></td>
                          <td class=" "><?=$row['tgl_input']?></td>
                          <td class=" "><?=$row['kd_admin']?></td>
                        </tr>
                        <?php }

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
                        ?>
                    <tr style="background-color: #055294; color: #fff;">
                        <td colspan="3">Total Nilai: <?php echo $sum; ?></td>
                        <td colspan="2">GRADE Total: <?php echo $grade; ?></td>
                    </tr>
                    <?php } ?>
                      </tbody>
                  <?php  } else {
                  ?>
                    <tbody>
                      <tr class="even pointer">
                        <td colspan="5">Data Belum Ada</td>
                      </tr>
                    </tbody>
                  <?php } ?>
                </table>
              </div>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_content7" aria-labelledby="profile-tab7">

              <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th class="column-title">Judul Kriteria</th>
                      <th class="column-title">Nilai</th>
                      <th class="column-title">Grade</th>
                      <th class="column-title">Date</th>
                      <th class="column-title">Admin</th>
                    </tr>
                  </thead>
                  <?php
                    $calon = new Karyawan();
                    $stmt = $calon->runQuery("SELECT tb_info_interview.kd_interview, tb_info_interview.no_ktp, tb_hasil_interview.nama_penilaian, tb_hasil_interview.nilai, tb_hasil_interview.tgl_input, tb_hasil_interview.kd_admin FROM tb_info_interview INNER JOIN tb_hasil_interview ON tb_hasil_interview.kd_interview = tb_info_interview.kd_interview WHERE tb_info_interview.no_ktp = :no_ktp");
                    $stmt->bindParam(':no_ktp', $no_ktp);
                    $stmt->execute();

                    if ($stmt->rowCount() >= 1) { ?>
                      <tbody>
                      <?php
                      $data = array();
                     $sum = 0;
                      while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                          # code...
                          $n = $row['nilai'];
                          $sum +=$n;
                          $data[] = $row;

                          $grade = $row['nilai'];
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
                         ?>
                        <tr class="even pointer">

                          <td class=" "><?=$row['nama_penilaian']?></td>
                          <td class=" "><?=$row['nilai']?></td>
                          <td class=" "><?=$value?></td>
                          <td class=" "><?=$row['tgl_input']?></td>
                          <td class=" "><?=$row['kd_admin']?></td>
                        </tr>
                        <?php }

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
                        ?>
                    <tr style="background-color: #055294; color: #fff;">
                        <td colspan="3">Total Nilai: <?php echo $sum; ?></td>
                        <td colspan="2">GRADE Total: <?php echo $grade; ?></td>
                    </tr>
                    <?php } ?>
                      </tbody>
                  <?php  } else {
                  ?>
                    <tbody>
                      <tr class="even pointer">
                        <td colspan="5">Data Belum Ada</td>
                      </tr>
                    </tbody>
                  <?php } ?>
                </table>
              </div>
          </div>

        </div>
      </div>

      </div>


      <div class="col-md-12">
      <div class="profile_title">
        <div class="col-md-6">
          <h2>Informasi Personal</h2>
        </div>
        <div class="col-md-6">

        </div>
      </div>

      <br>

      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
          <li role="presentation" class="active"><a href="#tab_content7" id="next-tab" role="tab" data-toggle="tab" aria-expanded="true">Keluarga</a>
          </li>
          <li role="presentation" class=""><a href="#tab_content8" role="tab" id="personal-tab" data-toggle="tab" aria-expanded="false">Pekerjaan</a>
          </li>
          <li role="presentation" class=""><a href="#tab_content9" role="tab" id="personal-tab" data-toggle="tab" aria-expanded="false">Referensi</a>
          </li>
          <li role="presentation" class=""><a href="#tab_content10" role="tab" id="personal-tab10" data-toggle="tab" aria-expanded="false">Upload Files</a>
          </li>

        </ul>

        <div id="myTabContent" class="tab-content">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_content7" aria-labelledby="next-tab">

            <!-- start recent activity -->
            <ul class="messages">
                <div class="table-responsive">
                  <table class="table table-striped jambo_table bulk_action">
                    <thead>
                      <tr class="headings">
                        <th class="column-title">Nama Lengkap </th>
                        <th class="column-title">Status Keluarga </th>
                        <th class="column-title">Jenis Kelamin </th>
                        <th class="column-title">Pendidikan </th>
                        <th class="column-title">Pekerjaan </th>
                        <th class="column-title">Handphone </th>
                        <th class="column-title">Status </th>

                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $calon = new Karyawan();
                      $stmt = $calon->runQuery("SELECT * FROM tb_info_keluarga where no_ktp = :no_ktp");
                      $stmt->bindParam(':no_ktp', $no_ktp);
                      $stmt->execute();
                    ?>
                    <tbody>
                    <?php
                    while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                        # code...
                      $stat = $row['hub_urgent'];
                      if ($stat == '1') {
                        # code...
                        $status = '<span class="label label-success"><span class="fa fa-user"></span></span>';
                      }
                       ?>
                      <tr class="even pointer">

                        <td class=" "><?php echo $row['nama_lengkap']; ?>
                        <td class=" "><?php echo $row['status_keluarga']; ?></td>
                        <td class=" "><?php echo $row['jenis_kelamin']; ?></td>
                        <td class=" "><?php echo $row['pendidikan']; ?></td>
                        <td class=" "><?php echo $row['pekerjaan']; ?></td>
                        <td class=" "><?php echo $row['nomor_handphone']; ?></td>
                        <td class=" "><?php echo $status; ?></td>


                      </tr>
                      <?php } ?>

                    </tbody>
                  </table>
                </div>
            </ul>
            <!-- end recent activity -->

          </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_content8" aria-labelledby="personal-tab">

            <!-- start user projects -->


            <div class="table-responsive">
                  <table class="table table-striped jambo_table bulk_action">
                    <thead>
                      <tr class="headings">
                        <th class="column-title">Nama Perusahaan </th>
                        <th class="column-title">Tahun Masuk </th>
                        <th class="column-title">Tahun Keluar </th>
                        <th class="column-title">Jabatan </th>
                        <th class="column-title">Gaji Terakhir </th>
                        <th class="column-title">Alasan Berhenti </th>
                        <th class="column-title">Keterangan </th>

                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $calon = new Karyawan();
                      $stmt = $calon->runQuery("SELECT * FROM tb_info_pekerjaan where no_ktp = :no_ktp");
                      $stmt->bindParam(':no_ktp', $no_ktp);
                      $stmt->execute();
                    ?>
                    <tbody>
                    <?php
                    while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                        # code...
                      $stat = $row['hub_urgent'];
                      if ($stat == '1') {
                        # code...
                        $status = '<span class="label label-success"><span class="fa fa-user"></span></span>';
                      }
                       ?>
                      <tr class="even pointer">

                        <td class=" "><?php echo $row['nama_perusahaan']; ?>
                        <td class=" "><?php echo $row['tahun_masuk']; ?></td>
                        <td class=" "><?php echo $row['tahun_keluar']; ?></td>
                        <td class=" "><?php echo $row['jabatan']; ?></td>
                        <td class=" "><?php echo $row['gaji']; ?></td>
                        <td class=" "><?php echo $row['alasan_berhenti']; ?></td>
                        <td class=" "><?php echo $row['keterangan']; ?></td>


                      </tr>
                      <?php } ?>

                    </tbody>
                  </table>
                </div>

            <!-- end user projects -->

          </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_content9" aria-labelledby="personal-tab">
            <div class="table-responsive">
                <div class="table-responsive">
                  <table class="table table-striped jambo_table bulk_action">
                    <thead>
                      <tr class="headings">
                        <th class="column-title">Nama Lengkap </th>
                        <th class="column-title">Jabatan </th>
                        <th class="column-title">Nomor Handphone </th>
                        <th class="column-title">Hubungan </th>

                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $calon = new Karyawan();
                      $stmt = $calon->runQuery("SELECT * FROM tb_info_referensi where no_ktp = :no_ktp");
                      $stmt->bindParam(':no_ktp', $no_ktp);
                      $stmt->execute();
                    ?>
                    <tbody>
                    <?php
                    while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                        # code...
                      $stat = $row['hub_urgent'];
                      if ($stat == '1') {
                        # code...
                        $status = '<span class="label label-success"><span class="fa fa-user"></span></span>';
                      }
                       ?>
                      <tr class="even pointer">

                        <td class=" "><?php echo $row['nama_lengkap']; ?>
                        <td class=" "><?php echo $row['jabatan']; ?></td>
                        <td class=" "><?php echo $row['nomor_hp']; ?></td>
                        <td class=" "><?php echo $row['hubungan']; ?></td>


                      </tr>
                      <?php } ?>

                    </tbody>
                  </table>
                </div>
              </div>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_content10" aria-labelledby="personal-tab">
            <div class="table-responsive">
                <div class="table-responsive">
                  <table class="table table-striped jambo_table bulk_action">
                    <thead>
                      <tr class="headings">
                        <th class="column-title">Nama File </th>
                        <th class="column-title">Type </th>
                        <th class="column-title">Path </th>
                        <th class="column-title">Date </th>

                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $calon = new Karyawan();
                      $stmt = $calon->runQuery("SELECT * FROM tb_uploadfile_karyawan where no_ktp = :no_ktp");
                      $stmt->bindParam(':no_ktp', $no_ktp);
                      $stmt->execute();
                    ?>
                    <tbody>
                    <?php
                    while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                        # code...
                      $stat = $row['hub_urgent'];
                      if ($stat == '1') {
                        # code...
                        $status = '<span class="label label-success"><span class="fa fa-user"></span></span>';
                      }
                       ?>
                      <tr class="even pointer">

                        <td class=" " style="text-transform: uppercase;"><a href="../Pendaftaran/Upload/<?=$row['nama_file'];?>"><?=$row['nama_file']; ?></a></td>
                        <td class=" "><?php echo $row['type_file']; ?></td>
                        <td class=" "><?php echo $row['paths']; ?></td>
                        <td class=" "><?php echo $row['create_date']; ?></td>


                      </tr>
                      <?php } ?>

                    </tbody>
                  </table>
                </div>
              </div>
          </div>


        </div>
      </div>
    </div>

    </div>
  </div>

</div>
