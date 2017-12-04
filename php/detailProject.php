<?php
$id = $_GET['id'];

$query = 'SELECT * FROM tb_kerjasama_perusahan WHERE nomor_kontrak = :nomor ';

$stmt = $config->runQuery($query);
$stmt->execute(array(':nomor' => $id));

$data = $stmt->fetch(PDO::FETCH_LAZY);
echo "<pre>";
print_r($data);
echo "</pre>";
 ?>
