<!-- top navigation -->
<?php
$sql = "SELECT tb_push.kd_push, tb_push.subject, tb_push.dari, tb_push.kepada, tb_push.create_date, tb_subject_push.nama_subject, tb_detail_push.read_date, tb_detail_push.pesan FROM tb_push INNER JOIN tb_subject_push ON tb_subject_push.kd_subject = tb_push.subject INNER JOIN tb_detail_push ON tb_detail_push.kd_detail = tb_subject_push.kd_subject WHERE tb_push.dari = :adminId AND tb_detail_push.read_date = '' ";
$stmt = $config->runQuery($sql);
$stmt->execute(array(
        'adminId' => $admin_id
));

$totalPesan = $stmt->rowCount();
?>
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="images/<?php echo $rowAdmin['picture']; ?>" alt=""><?php echo $rowAdmin['nama_admin']; ?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="javascript:;"> Profile</a></li>
            <li>
              <a href="javascript:;">
                <span class="badge bg-red pull-right">50%</span>
                <span>Settings</span>
              </a>
            </li>
            <li><a href="javascript:;">Help</a></li>
            <li><a href="logout.php?logout=true"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
        </li>

        <li role="presentation" class="dropdown">
          <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-envelope-o"></i>
            <span class="badge bg-green"><?=$totalPesan?></span>
          </a>
          <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
        <?php while($row = $stmt->fetch(PDO::FETCH_LAZY)) {?>
            <li>
              <a>
                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                <span>
                  <span style="font-size: 18px;"><b><?=$row['nama_subject']?></b></span>

                </span>
                <span class="message">
                  <?php
                    $pesan = $row['pesan'];
                    if(strlen($pesan) > 30){
                        $isiPesan = substr($pesan, 0, -30);
                    }else{
                        $isiPesan = $row['pesan'];
                    }

                    echo $isiPesan;
                  ?>
                </span>
                  <span class="time">Read At: <?=$row['read_date']?></span>
              </a>
            </li>
        <?php } ?>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->