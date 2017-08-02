<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 04/06/2017
 * Time: 10:57
 */
$kode = $_POST['id'];

include_once '../../config/api.php';
$data = new Admin();

// Generate Kode
    $id = "kode_detail_job"; $tbName = "tb_job"; $kode2 = "DTL";
    $sql = "SELECT MAX(RIGHT(". $id . ", 4)) AS max_id FROM " . $tbName . " ORDER BY ". $id ." ";
    $stmt = $data->runQuery($sql);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_LAZY);
    $id = $row['max_id'];
    $sort_num = (int) substr($id, 1, 6);
    $sort_num++;
    $new_code = sprintf("$kode2%04s", $sort_num);
// End Generate Kode

    $query = "UPDATE tb_job SET kode_detail_job = :data WHERE nomor_kontrak = :id";
    $dt = $data->runQuery($query);
    $dt->execute(array(
        ':data' => $new_code,
        ':id'   => $kode
    ));
    if ($dt){
        echo "Kode Berhasil di Generate!";
    } else{
        echo "Kode tidak berhasil!";
    }
//echo $new_code;
?>