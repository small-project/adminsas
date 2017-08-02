<?php
    date_default_timezone_set('Asia/Jakarta');
    $kd = $_GET['name'];
    $cek = new Admin();
    $sql = "SELECT tb_temporary_perusahaan.no_pendaftaran, tb_temporary_perusahaan.kode_perusahaan, tb_temporary_perusahaan.nama_perusahaan, tb_temporary_perusahaan.kebutuhan, tb_temporary_perusahaan.create_date, tb_temporary_perusahaan.kode_pekerjaan, tb_jenis_pekerjaan.nama_pekerjaan FROM tb_temporary_perusahaan LEFT JOIN tb_jenis_pekerjaan ON tb_jenis_pekerjaan.kd_pekerjaan=tb_temporary_perusahaan.kode_pekerjaan WHERE tb_temporary_perusahaan.no_pendaftaran = :id";
    $stmt = $cek->runQuery($sql);
    $stmt->execute(array(
        ':id'   =>$kd));

    $row = $stmt->fetch(PDO::FETCH_LAZY);

    $status = $row['nama_perusahaan'];


    $id = "nomor_kontrak";
    $kode = "SPK-";
    $tbName = "tb_kerjasama_perusahan";

    $nomor = $cek->Generate($id, $kode, $tbName);

    

    if (isset($_POST['addData'])) {
        # code...
        $no_kontrak = $_POST['txt_kontrak'];
        $jmlh = $_POST['txt_total'];
        $kd_perusahaan = $_POST['txt_kode'];
        $deskripsi = $_POST['txt_deskripsi'];
        $tugas = $_POST['txt_tugas'];
        $tanggung = $_POST['txt_tanggung'];
        $penempatan = $_POST['txt_penempatan'];
        $total = $_POST['txt_nilai'];
        $req = $_POST['txt_req'];
        $admin = $_POST['txt_admin'];
        $start = $_POST['txt_start'];
        $ends = $_POST['txt_ends'];

        $query = "INSERT INTO tb_job (nomor_kontrak) VALUES (:kontrak); INSERT INTO tb_kerjasama_perusahan (nomor_kontrak, kode_perusahaan, total_karyawan, deskripsi, tugas, tanggung_jwb, penempatan, kontrak_start, kontrak_end, nilai_kontrak, kode_admin) VALUES (:kontrak, :kode, :jmlh, :deskripsi, :tgs, :tgjwb, :tmpt, :start, :ends, :nilai, :admin)";

        $stmt = $cek->runQuery($query);
        $stmt->execute(array(
          ':kontrak'  =>$no_kontrak,
          ':kode'     =>$req,
          ':jmlh'     =>$jmlh,
          ':deskripsi'=>$deskripsi,
          ':tgs'      =>$tugas,
          ':tgjwb'    =>$tanggung,
          ':tmpt'     =>$penempatan,
          ':start'    =>$start,
          ':ends'     =>$ends,
          ':nilai'    =>$total,
          ':admin'    =>$admin));
        if (!$stmt) {
          # code...
          echo "data tidak masuk";
        } else{
            //bahwa nama perusahaan dengan request tersebut telah melalui tahap "entry detail Project"
          $sql = "UPDATE tb_temporary_perusahaan SET status = '3' WHERE tb_temporary_perusahaan.no_pendaftaran = :id";
          $stmt = $cek->runQuery($sql);
            $stmt->execute(array(
                ':id'   =>$kd));

          print "<script>window.location='index.php?p=select-karyawan&id=".$no_kontrak."';</script>";
          
          
        }


        // $tgs = explode('#', $tugas);
        // print_r($tgs);

    }
   

?>

<div class="row">
    <div class="col-md-8">
        

    <div class="x_panel">
      <div class="x_title">
        <h2>Detail Request <small>different form</small></h2>
        
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form class="form-horizontal form-label-left" method="post" action="">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Karyawan <span class="required">*</span>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="number" name="txt_total" class="form-control" placeholder="total karyawan" required>
              <input type="hidden" name="txt_kode" class="form-control" value="<?php echo $row['kode_perusahaan']; ?>">
              <input type="hidden" name="txt_kontrak" class="form-control" value="<?php echo $nomor; ?>">
                <input type="hidden" name="txt_req" class="form-control" value="<?php echo $row['no_pendaftaran']; ?>">
                <input type="hidden" name="txt_admin" class="form-control" value="<?php echo $admin_id; ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi Pekerjaan <span class="required">*</span>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea  name="txt_deskripsi" class="form-control" rows="3" placeholder="gambaran luas tentang deskripsi pekerjaan" required></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tugas<span class="required">*</span>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea class="form-control" name="txt_tugas" rows="3" placeholder="gambaran luar tentang tugas pekerjaan" required></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggung Jawab<span class="required">*</span>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea class="form-control" name="txt_tanggung" rows="3" placeholder="gambaran luas tentang tanggung jawab pekerjaan" required></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Penempatan Kerja</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" name="txt_penempatan" class="form-control" placeholder="nama kota penempatan" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nilai Pekerjaan</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="number" name="txt_nilai" class="form-control" placeholder="" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kontrak Start</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input type="text" name="txt_start" class="form-control has-feedback-left" name="tanggal" id="datepsikotes"  aria-describedby="inputSuccess2Status4">
                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Kontrak Ends</label>
            <div class="col-md-4 col-sm-3 col-xs-12">
                

                                <input class="form-control has-feedback-left" id="single_cal1" placeholder="First Name" name="txt_ends" aria-describedby="inputSuccess2Status" type="text">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                              

            </div>
          </div>

          <hr>

          <div class=" panel-primary">
            <div class="panel-heading">Informasi Waktu Kerja</div>
            <div class="panel-body">
              <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">WAKTU FIX</a></li>
                  <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">WAKTU FLEKSIBEL</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="home">
                    <br/>

                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> Check jika anda memilih waktu pekerjaan FIX.
                      </label>
                      <br/>
                      <br/>
                      <table class="table table-hover table-resposive">
                          <thead>
                            <th>MINGGU</th>
                            <th>SENIN</th>
                            <th>SELASA</th>
                            <th>RABU</th>
                            <th>KAMIS</th>
                            <th>JUMAT</th>
                            <th>SABTU</th>
                          </thead>
                          <tr>
                            <td>
                              <label>
                                <input type="checkbox">
                              </label>
                            </td>
                            <td>
                              <label>
                                <input type="checkbox">
                              </label>
                            </td>
                            <td>
                              <label>
                                <input type="checkbox">
                              </label>
                            </td>
                            <td>
                              <label>
                                <input type="checkbox">
                              </label>
                            </td>
                            <td>
                              <label>
                                <input type="checkbox">
                              </label>
                            </td>
                            <td>
                              <label>
                                <input type="checkbox">
                              </label>
                            </td>
                            <td>
                              <label>
                                <input type="checkbox">
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td class="col-md-2">
                              <input type="text" class="form-control" name="hari" placeholder="HH:MM"> ~ <input type="text" class="form-control" name="hari" placeholder="HH:MM">
                            </td>
                            <td class="col-md-2">
                              <input type="text" class="form-control" name="hari" placeholder="HH:MM"> ~ <input type="text" class="form-control" name="hari" placeholder="HH:MM">
                            </td>
                            <td class="col-md-2">
                              <input type="text" class="form-control" name="hari" placeholder="HH:MM"> ~ <input type="text" class="form-control" name="hari" placeholder="HH:MM">
                            </td>
                            <td class="col-md-2">
                              <input type="text" class="form-control" name="hari" placeholder="HH:MM"> ~ <input type="text" class="form-control" name="hari" placeholder="HH:MM">
                            </td>
                            <td class="col-md-2">
                              <input type="text" class="form-control" name="hari" placeholder="HH:MM"> ~ <input type="text" class="form-control" name="hari" placeholder="HH:MM">
                            </td>
                            <td class="col-md-2">
                              <input type="text" class="form-control" name="hari" placeholder="HH:MM"> ~ <input type="text" class="form-control" name="hari" placeholder="HH:MM">
                            </td>
                            <td class="col-md-2">
                              <input type="text" class="form-control" name="hari" placeholder="HH:MM"> ~ <input type="text" class="form-control" name="hari" placeholder="HH:MM">
                            </td>
                          </tr>
                      </table>
                    </div>
                    </div>
                  <div role="tabpanel" class="tab-pane" id="profile">
                    <br/>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> Check jika anda memilih waktu pekerjaan FLEKSIBEL.
                      </label>
                      <br/>
                      <br/>
                      <table class="table table-hover table-resposive">
                          <thead>
                            <th>MINGGU</th>
                            <th>SENIN</th>
                            <th>SELASA</th>
                            <th>RABU</th>
                            <th>KAMIS</th>
                            <th>JUMAT</th>
                            <th>SABTU</th>
                          </thead>
                          <tr>
                            <td>
                              <label>
                                <input type="checkbox">
                              </label>
                            </td>
                            <td>
                              <label>
                                <input type="checkbox">
                              </label>
                            </td>
                            <td>
                              <label>
                                <input type="checkbox">
                              </label>
                            </td>
                            <td>
                              <label>
                                <input type="checkbox">
                              </label>
                            </td>
                            <td>
                              <label>
                                <input type="checkbox">
                              </label>
                            </td>
                            <td>
                              <label>
                                <input type="checkbox">
                              </label>
                            </td>
                            <td>
                              <label>
                                <input type="checkbox">
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td class="col-md-2">
                              <input type="text" class="form-control" name="hari" placeholder="HH:MM">
                            </td>
                            <td class="col-md-2">
                              <input type="text" class="form-control" name="hari" placeholder="HH:MM">
                            </td>
                            <td class="col-md-2">
                              <input type="text" class="form-control" name="hari" placeholder="HH:MM">
                            </td>
                            <td class="col-md-2">
                              <input type="text" class="form-control" name="hari" placeholder="HH:MM">
                            </td>
                            <td class="col-md-2">
                              <input type="text" class="form-control" name="hari" placeholder="HH:MM">
                            </td>
                            <td class="col-md-2">
                              <input type="text" class="form-control" name="hari" placeholder="HH:MM">
                            </td>
                            <td class="col-md-2">
                              <input type="text" class="form-control" name="hari" placeholder="HH:MM">
                            </td>
                          </tr>
                      </table>
                    </div>
                  </div>
                  
                </div>

              </div>
            </div>
          </div>         

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
              <button type="reset" class="btn btn-primary">Reset</button>
              <button type="submit" name="addData" class="btn btn-success">Submit</button>
            </div>
          </div>

        </form>
      </div>
    </div>
    </div>
    <div class="col-md-4">
        <div class="x_panel">
            <div class="x_title">
                <h2>Perusahaan </h2>
                <div class="clearfix"></div>
              </div>
            <div class="form form-horizontal">
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-3 col-xs-12">Kode</label>
                    <div class="col-md-8 col-sm-9 col-xs-12">
                      <strong class="form-control"> <?php echo $row['kode_perusahaan']; ?></strong>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-3 col-xs-12">Nama</label>
                    <div class="col-md-8 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" disabled="disabled" value="<?php echo $row['nama_perusahaan'];?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-3 col-xs-12">Kebutuhan</label>
                    <div class="col-md-8 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" disabled="disabled" value="<?php echo $row['nama_pekerjaan'];?>">
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>

