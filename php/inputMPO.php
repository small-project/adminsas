<div class="row">
    <div class="col-md-12">


    <div class="x_panel">
      <div class="x_title">
        <h2>Detail Request <small>different form</small></h2>

        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="">
          <h2>List Request</h2>
        </div>
        <div class="x_content">
          <table class="table table-bordered table-hover">
            <thead>
              <th>Nama Kategori Pekerjaan</th>
              <th>Total</th>
            </thead>
            <tbody>
              <?php
              $query = "SELECT tb_list_perkerjaan_perusahaan.code, tb_list_perkerjaan_perusahaan.name_list, tb_list_perkerjaan_perusahaan.total,tb_jenis_pekerjaan.nama_pekerjaan FROM tb_list_perkerjaan_perusahaan
INNER JOIN tb_jenis_pekerjaan ON tb_jenis_pekerjaan.kd_pekerjaan = tb_list_perkerjaan_perusahaan.name_list WHERE tb_list_perkerjaan_perusahaan.code = :kode";
$stmt = $cek->runQuery($query);
$stmt->execute(array(':kode' => $noReg));
while ($col = $stmt->fetch(PDO::FETCH_LAZY)) {
               ?>
              <tr>
                <td><?=$col['nama_pekerjaan']?></td>
                <td><?=$col['total']?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="x_content">
        <br>
        <form class="form-horizontal form-label-left" method="post" action="">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi Pekerjaan <span class="required">*</span>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea  name="txt_deskripsi" class="form-control" rows="3" placeholder="gambaran luas tentang deskripsi pekerjaan" required></textarea>
              <input type="hidden" name="txt_kode" class="form-control" value="<?php echo $row['kode_perusahaan']; ?>">
              <input type="hidden" name="txt_kontrak" class="form-control" value="<?php echo $nomor; ?>">
              <input type="hidden" name="txt_req" class="form-control" value="<?php echo $row['no_pendaftaran']; ?>">
                <input type="hidden" name="txt_plan" class="form-control" value="<?=$type?>">
                <input type="hidden" name="txt_admin" class="form-control" value="<?php echo $admin_id; ?>">
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
                        <input type="checkbox" name="txt_inisialisasi" value="1"> Check jika anda memilih waktu pekerjaan FIX.
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
                            <td width="14.2%">
                              <input type="text" class="form-control" name="txt_minggu_start" placeholder="HH:MM"> ~
                              <input type="text" class="form-control" name="txt_minggu_end" placeholder="HH:MM">
                            </td>
                            <td width="14.2%">
                              <input type="text" class="form-control" name="txt_senin_start" placeholder="HH:MM"> ~
                              <input type="text" class="form-control" name="txt_senin_end" placeholder="HH:MM">
                            </td>
                            <td width="14.2%">
                              <input type="text" class="form-control" name="txt_selasa_start" placeholder="HH:MM"> ~
                              <input type="text" class="form-control" name="txt_selasa_end" placeholder="HH:MM">
                            </td>
                            <td width="14.2%">
                              <input type="text" class="form-control" name="txt_rabu_start" placeholder="HH:MM"> ~
                              <input type="text" class="form-control" name="txt_rabu_end" placeholder="HH:MM">
                            </td>
                            <td width="14.2%">
                              <input type="text" class="form-control" name="txt_kamis_start" placeholder="HH:MM"> ~
                              <input type="text" class="form-control" name="txt_kamis_end" placeholder="HH:MM">
                            </td>
                            <td width="14.2%">
                              <input type="text" class="form-control" name="txt_jumat_start" placeholder="HH:MM"> ~
                              <input type="text" class="form-control" name="txt_jumat_end" placeholder="HH:MM">
                            </td>
                            <td width="14.2%">
                              <input type="text" class="form-control" name="txt_sabtu_start" placeholder="HH:MM"> ~
                              <input type="text" class="form-control" name="txt_sabtu_end" placeholder="HH:MM">
                            </td>
                          </tr>
                      </table>
                    </div>
                    </div>
                  <div role="tabpanel" class="tab-pane" id="profile">
                    <br/>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="txt_inisialisasi" value="2"> Check jika anda memilih waktu pekerjaan FLEKSIBEL.
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
                            <td width="14.2%">
                              <input type="number" class="form-control" name="txt_minggu" placeholder="HH">
                            </td>
                            <td width="14.2%">
                              <input type="number" class="form-control" name="txt_senin" placeholder="HH">
                            </td>
                            <td width="14.2%">
                              <input type="number" class="form-control" name="txt_selasa" placeholder="HH">
                            </td>
                            <td width="14.2%">
                              <input type="number" class="form-control" name="txt_rabu" placeholder="HH">
                            </td>
                            <td width="14.2%">
                              <input type="number" class="form-control" name="txt_kamis" placeholder="HH">
                            </td>
                            <td width="14.2%">
                              <input type="number" class="form-control" name="txt_jumat" placeholder="HH">
                            </td>
                            <td width="14.2%">
                              <input type="number" class="form-control" name="txt_sabtu" placeholder="HH">
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
              <button type="submit" name="addDataMPO" class="btn btn-success">Submit</button>
            </div>
          </div>

        </form>
      </div>
    </div>
    </div>
</div>
