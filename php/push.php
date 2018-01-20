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

      if (!$stmt) {
        # code...
        echo "<script>
        alert('Push Fail Send!');
        window.location.href='index.php?p=push';
        </script>";
      }
      else{
        echo "<script>
        alert('Push Has Send!');
        window.location.href='index.php?p=push';
        </script>";
      }
    }

    $nama = explode(',', $kepada);

    

    // ==============================
    
      
    // ==============================

    
    foreach ($nama as $key => $value) {

      $ch = curl_init();

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
      curl_setopt( $ch,CURLOPT_URL, 'http://sinergiadhikarya.co.id/public/api/push/message/?id='.$new_kode );
      

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
            
$result = curl_exec($ch);
            curl_close( $ch );
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

          <div id="listKiri" class="col-sm-8 col-sm-offset-2">
              <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                  <button id="compose" type="button" class="btn btn-sm btn-success btn-block">COMPOSE</button>
                </div>
              </div>
            <hr>

            <?php 
            $row_per_page = '10';
              $cek = new Admin();
              $sql = 'SELECT tb_push.kd_push, tb_push.subject, tb_push.dari, tb_push.kepada, tb_push.create_date, tb_subject_push.nama_subject, tb_detail_push.inisial,
tb_subject_push.isi, tb_subject_push.create_date, tb_admin.nama_admin, tb_karyawan.no_ktp, tb_karyawan.nama_depan, 
tb_karyawan.nama_belakang, tb_detail_push.read_date FROM tb_push
            INNER JOIN tb_subject_push ON tb_subject_push.kd_subject=tb_push.subject
            INNER JOIN tb_admin ON tb_admin.username = tb_push.dari
            INNER JOIN tb_karyawan ON tb_karyawan.no_ktp = tb_push.kepada
            INNER JOIN tb_detail_push ON tb_detail_push.kd_push = tb_push.kd_push
            WHERE tb_push.dari = :adminID AND tb_detail_push.inisial = :adminID
                ORDER BY tb_push.create_date DESC
              ';
              $stmt = $cek->runQuery($sql);
              $stmt->execute(array(
                ':adminID' => $admin_id
              ));

            if ($stmt->rowCount() == '0') {
              # code...
              ?>

            <div class="alert alert-info alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong>Hore!</strong> belum ada push
            </div>

              <?php
            }else {

              while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {

              
                $count = $row['read_date'];


                if ($count == NULL) {
    # code...
                 $label = '<i class="fa fa-circle"></i>';
                   }else{
                    $label = '<i class="fa fa-circle-o"></i>';
                  }
              
            ?>
                <a  href="?p=detailPesan&pesan=<?=$row['kd_push']?>" data-id="<?php echo $row['kd_push']; ?>" data-jd="<?php echo $row['subject']; ?>" data-kd = "<?php echo $row['kd_detail']; ?>" data-in = "<?php echo $row['inisial']; ?>" data-ps = "<?php echo $row['pesan']; ?>" data-cd = "<?php echo $row['create_date']; ?>" data-nama = "<?php echo $row['nama_depan']; ?> <?php echo $row['nama_belakang']; ?>">
                  <div class="mail_list">
                    <div class="left">
                      <?=$label?>
                    </div>
                    <div class="right">
                      <h3><?php echo $row['nama_subject']; ?> <small><?php echo $row['create_date']; ?></small></h3>
                      <p>Dari <?php echo $row['nama_admin']; ?> untuk <?php echo $row['nama_depan']; ?> <?php echo $row['nama_belakang']; ?></p>
                    </div>
                  </div>
                </a>
            <?php }
            }?>
            <?php
        
        // $stmt = $config->paginglink($sql, $row_per_page);

        
        ?>
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
                  <input id="admin" type="text" name="txt_admin" class="form-control col-md-7 col-xs-12" value="<?php echo $admin_id;?>" >
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

