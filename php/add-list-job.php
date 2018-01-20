<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 03/06/2017
 * Time: 15:15
 */
$kode = $_GET['name'];

    $id = "kode_detail_job"; $tbName = "tb_job"; $kode2 = "DTL";
    $sql = "SELECT MAX(RIGHT(". $id . ", 4)) AS max_id FROM " . $tbName . " ORDER BY ". $id ." ";
    $stmt = $config->runQuery($sql);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_LAZY);
    $id = $row['max_id'];
    $sort_num = (int) substr($id, 1, 6);
    $sort_num++;
    $new_code = sprintf("$kode2%04s", $sort_num);

    $query = "SELECT * FROM tb_job WHERE nomor_kontrak = :kode ";
    $done = $config->runQuery($query);
    $done->execute(array(':kode' => $kode));

    
?>

  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>List Job Project
          <small>Baru</small>
        </h2>

        <div class="clearfix"></div>
      </div>

      <div class="x_content" id="formJudul1">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        <form method="post" id="formJudul" class="form-horizontal" data-parsley-validate="">

          <div class="input-group col-md-12 col-xs-12">
            <input type="hidden" class="form-control" name="txtSPK" id="txtSPK" value="<?=$kode?>" readonly>
          </div>

          <div class="input-group col-md-12 col-xs-12">
            <input type="hidden" class="form-control" name="txtID" id="txtID" value="<?=$new_code?>" readonly>
          </div>
          <div class="input-group col-md-12 col-xs-12">
            <input type="text" class="form-control" name="txtJudul" id="txtJudul" placeholder="Title Jobs" data-parsley-minlength="6" data-parsley-maxlength="100" data-parsley-required-message="Title is required" required autocomplete="off">
         
          </div>
          <div class="from-group">
          <button type="submit" id="addJudul" class="addJudul from-control btn-block btn btn-info">Add a Job <span class="fa fa-fw fa-plus"></span></button>
          </div>
          
        </form >
        </div>
      </div>
    </div>

    <div class="x_panel">
      <div class="x_title">
        <h2>Project</h2>
        <div class="clearfix"></div>
      </div>

      <div class="x_content" id="listPanel">
      <?php  while($row = $done->fetch(PDO::FETCH_LAZY)){ ?>

        <div class="panel-group" role="tablist" id="listDetail">
          <div class="panel panel-default " >
          <a href="#<?=$row['kode_detail_job']?>" class="" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="collapseListGroup1">
              <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
                  <h4 class="panel-title">
                       <?=$row['title']?> 
                       <div class="pull-right" style="display: inline;">
                    <button class="btn btn-xs btn-default" id="removeTitle" data-id="<?=$row['id']?>" data-toggle="tooltip" data-placement="left" title="Remove Title"><span class="fa fa-fw fa-trash-o"></span></button>
                      </div> 
                    </h4>
                    
              </div>
              </a>
              <div class="panel-collapse collapse" role="tabpanel" id="<?=$row['kode_detail_job']?>" aria-labelledby="collapseListGroupHeading1" aria-expanded="false" style="">
                <br/>
              <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2 col-sm-offset-2" id="formDetail">
                  <form class="form-horizontal form-label-left input_mask" id="detailJob" data-parsley-validate="">
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" class="form-control" name="txtKodeDetail" id="txtKodeDetail" value="<?=$row['kode_detail_job']?>" readonly>
                          <input type="hidden" class="form-control" name="txtAdmin" id="txtAdmin" value="<?=$admin_id?>" readonly>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="txtKegiatan" id="txtKegiatan" placeholder="Nama Kegiatan" data-parsley-minlength="6" data-parsley-maxlength="100" data-parsley-required-message="This value is required" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                      <textarea id="txtDeskripsi" placeholder="Deskripsi Kegiatan/Job" required="required" class="form-control" name="txtDeskripsi" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <textarea id="txtKeterangan" placeholder="Keterangan Kegiatan" required="required" class="form-control" name="txtKeterangan" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3 col-xs-offset-12">
                        <button type="submit" name="addDetail" class="btn btn-block btn-info" id="addDetail">Tambah <span class="fa fa-fw fa-plus"></span></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
                  <br/>
                  <div class="x_content" style="padding-bottom: 2%; padding-left: 1%; padding-right: 1%;">
                    <table class="table" id="tableDetail">
                        <thead>
                            <tr>
                                <th width="30%">Kegiatan</th>
                                <th width="40%">Deskripsi</th>
                                <th width="40%">Keterangan</th>
                                <th width="10%">#</th>  
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $detail = $row['kode_detail_job'];
                        
                          $detaildata = "SELECT * FROM tb_list_job where kode_detail_job = :dd";
                          $sys = $config->runQuery($detaildata);
                          $sys->execute(array(':dd' => $detail));
                          
                          $total = $sys->rowCount();
                          if($total > 0 ){
                                  while($data = $sys->fetch(PDO::FETCH_LAZY)){
                                    ?>
                                        <tr style="text-transform: capitalize;">
                                            <td><?=$data['nama_job']?></td>
                                            <td><?=$data['deskripsi_job']?></td>
                                            <td><?=$data['keterangan']?></td>
                                            <td>
                                              <button type="button" id="removeDetail" data-id="<?=$data['id']?>" data-toggle="tooltip" data-placement="right" title="Remove" class="btn btn-danger btn-xs"><span class="fa fa-fw fa-minus-square"></span></button>
                                            </td>
                                        </tr>
                                      <?php
                                }
                           }else{?>
                              <tr>
                                  <td colspan="4">Kegiatan belum ada.</td>
                              </tr>

                           <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="clearfix"></div>

                  <div class="panel-footer">Footer</div>
              </div>
          </div>
      </div>
      <?php } ?>
      </div>
    </div>
  </div>