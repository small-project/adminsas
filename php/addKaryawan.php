<?php
include_once '../config/api.php';
$config = new Perusahaan();
$nik = $_GET['id'];
$spk = $_GET['kode'];

$dt = "SELECT * FROM tb_kerjasama_perusahan WHERE kode_list_karyawan = :kode";
$mg = $config->runQuery($dt);
$mg->execute(array(':kode' => $spk));
$col = $mg->fetch(PDO::FETCH_LAZY);
$nomor_kontrak = $col['nomor_kontrak'];

    $sql = "INSERT INTO tb_list_karyawan (kode_list_karyawan, no_nip) VALUES (:spk, :nik)";
    $stmt = $config->runQuery($sql);
    $stmt->execute(array(
        ':spk'  => $spk,
        ':nik'  => $nik
    ));
    if ($stmt){

      $query = "UPDATE tb_karyawan SET tb_karyawan.status = '1' WHERE no_ktp = :nomor ";
      $ls = $config->runQuery($query);
      $ls->execute(array(
        ':nomor' => $nik
      ));

      if ($ls) {
        # code...
        
        echo "<script>
    alert('Karyawan Berhasil di Add!');
    window.location.href='?p=select-karyawan&id=" . $nomor_kontrak . "';
    </script>";
  } else{
    echo "<script>
alert('Tidak berhasil update!');
window.location.href='?p=select-karyawan&id=" . $nomor_kontrak . "';
</script>";
  }

    }else{
        echo "<script>
    alert('Data tidak berhasil di Add!');
    window.location.href='?p=select-karyawan&id=" . $nomor_kontrak . "';
    </script>";
    }
 ?>
