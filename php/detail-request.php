<?php
	$kode = $_GET['name'];

  if (isset($_POST['addStatus'])) {
    # code...
    date_default_timezone_set('Asia/Jakarta');
    $pendaftaran = $_POST['txt_kode'];
    $status = $_POST['txt_status'];
    $tanggal = date("Y-m-d h:i:s");

    if ($status == '') {
      # code...
      echo "pilih dulu.";
    }else{
      $db = new Admin();
      $sql = "UPDATE tb_temporary_perusahaan SET kd_status = :kode, tanggal = :tgl WHERE no_pendaftaran = :kd";
      $stmt= $db->runQuery($sql);
      $stmt->execute(array(
        ':kode'   => $status,
        ':tgl'    => $tanggal,
        ':kd'     => $pendaftaran));
      if (!$stmt) {
        # code...
        echo "data masuk";
      }else {
        print "<script>window.location='index.php?p=new-request';</script>";
      }
    }
  }
?>

<div class="x_content">

      

      <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action table-responsive">
          <thead>
            <tr class="headings">
              
              <th class="column-title">Nama Perusahaan </th>
              <th class="column-title">Kebutuhan </th>
              <th class="column-title">Jenis Pekerjaan </th>
              <th class="column-title">Contact Person </th>
              <th class="column-title">Tanggal Pengajuan </th>
              <th class="column-title">Status </th>
              <th class="column-title no-link last"><span class="nobr">Action</span>
              </th>
              <th class="bulk-actions" colspan="7">
                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
              </th>
            </tr>
          </thead>

          <tbody>
          <?php 
          $list = new Admin();
          $query = "SELECT tb_temporary_perusahaan.no_pendaftaran, tb_temporary_perusahaan.kode_perusahaan, tb_temporary_perusahaan.nama_perusahaan, tb_temporary_perusahaan.cp, tb_temporary_perusahaan.phone, tb_temporary_perusahaan.email, tb_temporary_perusahaan.create_date, tb_temporary_perusahaan.status, tb_jenis_pekerjaan.nama_pekerjaan, tb_kategori_pekerjaan.nama_kategori FROM tb_temporary_perusahaan LEFT JOIN tb_jenis_pekerjaan ON tb_jenis_pekerjaan.kd_pekerjaan=tb_temporary_perusahaan.kode_pekerjaan LEFT JOIN tb_kategori_pekerjaan ON tb_kategori_pekerjaan.kode_kategori=tb_temporary_perusahaan.kebutuhan WHERE tb_temporary_perusahaan.no_pendaftaran = :kode";
          $stmt = $list->runQuery($query);
          $stmt->execute(array(
            ':kode' =>$kode));

          

          if ($stmt->rowCount() == "") {
            # code...
            ?>
            <tr>
              <td colspan="8">
                <center><span class="text-danger"> Data Tidak ada.</span></center>
              </td>
            </tr>
            <?php
          } else {
          while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
            # code...
            if ($row['status'] == "0") {
              # code...
              $st = '<span class="label label-default">Old Company</span>';
              $label = 'Details';
            }else{
              $st = '<span class="label label-success">New Company</span>';
              $label = 'Entry';

            }
          
          ?>
            <tr class="even pointer">
              
              <td class="col-md-2"><?php echo $row['nama_perusahaan']; ?> </td>
              <td class="col-md-2"><?php echo $row['nama_kategori']; ?> </td>
              <td class="col-md-1"><?php echo $row['nama_pekerjaan']; ?> </td>
              <td class="col-md-3"><strong><span class="text-danger"><?php echo $row['cp']; ?> | <?php echo $row['phone']; ?></span></strong></td>
              <td class="col-md-2"><?php echo $row['create_date']; ?></td>
              <td class="col-md-1 a-right a-right ">
                <?php  echo $st;?>
              </td>
              <td class=" col-md-1">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm"><span class="fa fa-fw fa-plus"></span> tambah status</button>

                <a href="php/delete-request.php?id=<?php echo $row['no_pendaftaran']; ?>" onClick="return confirm('Yakin data akan dihapus?')" >
                  <button type="button" class="btn btn-danger btn-xs">
                  <i class="fa fa-remove">  </i>  Delete
                </button>
              </a>
              </td>
            </tr>
            <?php }


          }
          ?>
          </tbody>
        </table>

      
      </div>
</div>


<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myModal">
 
    <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pilih Status</h4>
      </div>
      <div class="modal-body">
        <form class="form form-horizontal" action="" method="post">
          <div class="form-group">
          <input type="hidden" name="txt_kode" value="<?php echo $kode; ?>">
            <select class="form-control" name="txt_status">
              <option value="0" selected>-- pilih --</option>
              <?php
                $sql = "SELECT * FROM tb_status_request";
                $stmt = $list->runQuery($sql);
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                  # code...
                  ?>
              <option value="<?php echo $row['kd_stat']; ?>"> <?php echo $row['nama_status']; ?></option>
                  <?php
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <button class="btn btn-sm btn-success" type="submit" name="addStatus"><span class="fa fa-fw fa-send"></span> Submit</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
  </div>
</div>

