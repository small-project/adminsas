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

        <!-- footer content -->
        </div>
        <footer>
          <div class="pull-right">
            <span class="fa fa-copyright"></span> <a href="www.sinergiadhikarya.co.id">Website</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <?php
      include_once 'php/footer.php';
    ?>
