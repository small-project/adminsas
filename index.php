<!-- conth -->
<?php
  include_once 'config/session.php';
  include_once 'config/api.php';
  $user_admin = new Login();
  $config = new Admin();

  $admin_id = $_SESSION['user_session'];

  $stmt = $user_admin->runQuery("SELECT * FROM tb_admin WHERE username=:user_id");
  $stmt->execute(array(":user_id"=>$admin_id));

  $rowAdmin=$stmt->fetch(PDO::FETCH_ASSOC);
  $kd_admin = $rowAdmin['username'];

  // sidebarquery
    $category = "SELECT * FROM  tb_category INNER JOIN tb_staff ON tb_staff.id_category = tb_category.id_category WHERE tb_staff.id_roles = :idstaff";
    $cat = $config->runQuery($category);
    $cat->execute(array(
      ':idstaff'  => $rowAdmin['id_role']
      ));
  // endsidebar

    // readurl
    $url = "$_SERVER[REQUEST_URI]";
    $url = explode('/', $url);
    $urltype = explode('=', $url[2]);
    // endread

  // total calon karyawan
    $calon = "SELECT * FROM tb_karyawan";
    $test = "SELECT * FROM tb_info_test";
    $interview = "SELECT * FROM tb_info_interview";
    $karyawan = 'SELECT * FROM tb_karyawan WHERE tb_karyawan.no_NIK != ""';
    $calon = $config->CountQuery($calon);
    $karyawan = $config->CountQuery($karyawan);
    $test = $config->CountQuery($test);
    $interview = $config->CountQuery($interview);
    

    $totalCalonKaryawan = $calon->rowCount();
    $totalKaryawan = $karyawan->rowCount();
    $totalTest = $test->rowCount();
    $totalInterview = $interview->rowCount();
  // 

  include_once 'php/header.php';
  include_once 'php/side-navbar.php';
  include_once 'php/top-navbar.php';

?>
        <!-- page content -->
        <div class="right_col" role="main">
          <?php
            include_once 'php/page.php';
          ?>

        </div>
        <!-- /page content -->

       
    <?php
      include_once 'php/footer.php';
    ?>
