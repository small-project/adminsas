<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 04/06/2017
 * Time: 12:27
 */
include_once '../config/api.php';
$delete = new Perusahaan();
$id = $_GET['id'];
$kode = $_GET['kode'];
echo $id;

    $sql = "DELETE FROM tb_list_job WHERE id = :id";
    $stmt = $delete->runQuery($sql);
    $stmt->execute(array(
        ':id'   => $id
    ));
    if ($stmt){
        echo "<script>
    alert('Delete Data Success!');
    window.location.href='../?p=add-list-job&name=" . $kode . "';
    </script>";
    }else{
        echo "<script>
    alert('Delete Data Gagal!');
    window.location.href='../?p=add-list-job&name=" . $kode . "';
    </script>";
    }