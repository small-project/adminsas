<?php


  if (isset($_POST['addPush'])) {

    $kepada = $_POST['txt_kepada'];
    $admin = $_POST['txt_admin'];
    $subject = $_POST['txt_subject'];
    $isi = $_POST['txt_isi'];

    if ($isi == "") {
      # code...
      echo "Data tidak boleh kosong";
    } else {
      $cek = new Admin();

      $id3 = "kd_subject";
      $kode3 = "DTSBJPS";
      $tbName3 = "tb_subject_push";

      $kd = $cek->Generate($id3, $kode3, $tbName3);

      $sql = "INSERT INTO tb_subject_push (kd_subject, nama_subject, isi) VALUES (:kd, :nama, :isi)";
      $stmt = $cek->runQuery($sql);
      $stmt->execute(array(
        ':kd' =>$kd,
        ':nama' =>$subject,
        ':isi'  =>$isi));
    }

    $nama = explode(',', $kepada);

    

    // ==============================
    
      
    // ==============================

    
    foreach ($nama as $key => $value) {

      $pdo = new Admin();
      $sql = "INSERT INTO tb_push (kd_push, subject, dari, kepada) VALUES (:kode, :aa, :bb, :cc)";

      $stmt = $pdo->runQuery($sql);

      $input = new Admin();
      
      $id = "kd_push";
      $kode = "PUSH";
      $tbName = "tb_push";
      $new_kode = $input->Generate($id, $kode, $tbName);
      $kode = substr($value, -17, 16);
      $stmt->execute(array(
        ':kode'=>$new_kode,
        ':aa' =>$kd,
        ':bb' =>$admin,
        ':cc' =>$kode));

      $id2 = "kd_detail";
      $kode2 = "PUSHDT";
      $tbName2 = "tb_detail_push";
      $kdDetail = $input->Generate($id2, $kode2, $tbName2);
    $sql = "INSERT INTO tb_detail_push (kd_detail, kd_push, inisial, pesan) VALUES (:kd, :push, :inisial, :isi)";
    $stmt = $input->runQuery($sql);
    $stmt->execute(array(
      ':kd'   =>$kdDetail,
      ':push' =>$new_kode,
      ':inisial' =>$admin,
      ':isi'  =>$isi));

      if (!$stmt) {
        # code...
        echo "tidak berhasil";
      } else{
            

      //   $sql = " insert ke $key, dari kode ke: $kode";
      // echo $sql;
      // echo "<br/>";
      }
    }

    // $input = new Admin();

    // // ==============================
    // $id = "kd_push";
    // $kode = "PUSH";
    // $tbName = "tb_push";
    //   $new_kode = $input->Generate($id, $kode, $tbName);
    // // ==============================

    // $sql = "INSERT INTO tb_push (kd_push, subject, dari, kepada) VALUES (:kd, :subject, :dari, :kepada)";
    // $stmt = $input->runQuery($sql);
    // $stmt->execute(array(
    //   ':kd'   => $new_kode,
    //   ':subject' => $subject,
    //   ':dari' => $admin,
    //   ':kepada' => $kepada));

    // if (!$stmt) {
    //   # code...
    //   echo "Data tidak masuk ke Database";
    // }else {
    //     $id = "kd_detail";
    //     $kode = "PUSHDT";
    //     $tbName = "tb_detail_push";
    //     $kdDetail = $input->Generate($id, $kode, $tbName);
    //   $sql = "INSERT INTO tb_detail_push (kd_detail, kd_push, inisial, pesan) VALUES (:kd, :push, :inisial, :isi)";
    //   $stmt = $input->runQuery($sql);
    //   $stmt->execute(array(
    //     ':kd'   =>$kdDetail,
    //     ':push' =>$new_kode,
    //     ':inisial' =>$admin,
    //     ':isi'  =>$isi));
    //   if (!$stmt) {
    //     # code...
    //     echo "data tidak masuk.";
    //   } else{
       
    //   }
    // }
  }
?>

<div class="page-title">
  <div class="title_left">
    <h3>Make a Push! <span class="text-danger"><span class="fa fa-bullseye"></span></span></h3>
    <hr>
  </div>
</div>

<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Inbox</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div id="composeNew" style="display: none;">
          <?php
            include_once "ajx/compose_new_push.php";
          ?>
        </div>
      </div>
      <div class="x_content">
        <div class="row">

          <div id="listKiri" class="col-sm-3 mail_list_column">
              <button id="compose" type="button" class="btn btn-sm btn-success btn-block">COMPOSE</button>
            <hr>

            <?php 
              include_once 'ajx/tampil_push_left.php';
            ?>
            
          </div>
          
          <div id="listKanan" class="col-sm-9 mail_view" style="display: none;">
              <div class="inbox-body">
    

            <?php 
              include_once 'ajx/tampil_push_right.php';
            ?>
            </div>
          </div>

        </div>

         
      </div>
    </div>
  </div>


<div class="modal fade" id="newCompose" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Push</h4>
      </div>
      <div class="modal-body">

        <form  method="post" action="" class="form-horizontal form-label-left">
            <div class="form-group">
                <label for="kepada" class="control-label col-md-3 col-sm-3 col-xs-12">Kepada</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="kepada" type="text" name="txt_kepada" class="form-control col-md-7 col-xs-12" placeholder="input nomor KTP" required autofocus>
                  <input id="admin" type="hidden" name="txt_admin" class="form-control col-md-7 col-xs-12" value="<?php echo $admin_id;?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="kepada" class="control-label col-md-3 col-sm-3 col-xs-12">Subject</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="subject" type="text" name="txt_subject" class="form-control col-md-7 col-xs-12" placeholder="" required >
                </div>
            </div>
          
          <hr>
          
          <div class="form-group">
                <label for="kepada" class="control-label col-md-3 col-sm-3 col-xs-12">Subject</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea name="txt_isi" rows="9" class="form-control col-md-7 col-xs-12"> 
                    
                  </textarea>
                </div>
            </div>
        </div>
        <div class="panel-footer">
          <button class="btn btn-lg btn-primary" type="submit" name="addPush" id="kirim">
            <span class="fa fa-send"></span> Kirim
          </button>
        </div>
        </form>


      </div>
      
    </div>
  </div>
</div>

