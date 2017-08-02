<?php
 $admin_id = $_SESSION['user_session'];
?>
<div class="row">
  <div class="col-md-2 col-sm-3 col-xs-12"></div>
  <div class="col-md-8 col-sm-6 col-xs-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
          <h2>New Push !</h2>
        </div>
        <div class="panel-body">
          <form  method="post" action="" class="form-horizontal form-label-left">
            <div class="form-group">
                <label for="kepada" class="control-label col-md-3 col-sm-3 col-xs-12">Kepada</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="kepada" type="text" name="txt_kepada" class="form-control col-md-7 col-xs-12" placeholder="input nomor KTP" id="kepada" required autofocus>
                  <input id="admin" type="hidden" name="txt_admin" class="form-control col-md-7 col-xs-12" value="<?php echo $admin_id;?>" >
                </div>
            </div>

<!--             <div class="ui-widget">
            <label for="skills">Tag your nama Karyawan: </label>
            <input id="skills" name="txt_nama" size="50" required>
        </div> -->

            <div class="form-group">
                <label for="kepada" class="control-label col-md-3 col-sm-3 col-xs-12">Subject</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="subject" type="text" name="txt_subject" class="form-control col-md-7 col-xs-12" placeholder="" required >
                </div>
            </div>
          
          <hr>

       
          <textarea name="txt_isi" class="ckeditor" id="isiPush" ></textarea>


        <div class="panel-footer">
          <button class="btn btn-lg btn-primary" type="submit" id="kirim" name="addPush">
            <span class="fa fa-send"></span> Kirim
          </button>
        </div>
        </form>
      </div>
  </div>
  <div class="col-md-2 col-sm-3 col-xs-12"></div>
</div>

<hr>