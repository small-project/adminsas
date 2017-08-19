<?php 

include_once 'config/api.php';
$delete = new Admin();

if(isset($_POST['add'])){

}elseif(isset($_GET['del'])){

    $kd = $_GET['del'];
    
    $sql = "DELETE FROM tb_jenis_pekerjaan WHERE kd_pekerjaan = :kode ";

    $stmt = $delete->runQuery($sql);
    $stmt->execute(array(
        ':kode' => $kd
    ));

    if(!$stmt){

    }else{
        echo "<script>
        alert('Input Data Success!');
        window.location.href='?p=pekerjaan';
        </script>";
    }

}else{
    echo '<div class="col-md-8 col-md-offset-2">';
    echo '<div class="alert alert-danger alert-dismissable">';
    echo '<a href="?p=pekerjaan" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
    echo '<strong>Warning!</strong> You have no power here Gandalf.';
  echo '</div>';
  echo '</div>';
}

?>

