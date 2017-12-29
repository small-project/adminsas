<br/>
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
<?php while ($category = $cat->fetch(PDO::FETCH_LAZY)) {
  
  $idcat = $category['id_category'];

  $querysub = "SELECT * FROM tb_subcategory INNER JOIN tb_category ON tb_category.id_category = tb_subcategory.id_category WHERE tb_category.id_category = :id";
  $sub = $config->runQuery($querysub);
  $sub->execute(array(
    ':id' => $idcat
  ));
  ?>
  <div class="menu_section">
    <h3 style="text-transform: uppercase;"><?=$category['name']?></h3>

    <ul class="nav side-menu">
      <?php while ( $subcat = $sub->fetch(PDO::FETCH_LAZY)) {

        $data = $subcat['id_subcategory'];
        if ($category['id_roles'] == '5' && in_array($subcat['id_subcategory'], ['2', '7', '13'])) {
          # code...
          $label = " display: block; ";
        }
        elseif($category['id_roles'] != '5')
        {
          $label = " display: block; ";
        }
        else{
          $label = "display: none;";
        }

        if (!empty($urltype[1]) ) {
          if ($urltype[1] == $subcat['link']) {
            # code...
          $active = "current-page";
          }
          else{
            $active = "";
          }
        }else{
          $active = "";
        }
        ?>
      <li class="<?=$active?>" style="text-transform: capitalize; <?=$label?>" >
        <a href="?p=<?=$subcat['link']?>" ><i class="fa <?=$subcat['icon']?>"></i> <?=$subcat['name_sub']?> </a>
      </li>
      <?php } ?>
    </ul>
  
  </div>
<?php } ?>
</div>
<!-- /sidebar menu -->

<br />



    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>
