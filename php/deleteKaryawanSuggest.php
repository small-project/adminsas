<?php
    require '../config/api.php';
    $delete = new Perusahaan();

    $id = $_GET['id'];
    $kode = $_GET['kode'];

    $link = $_GET['spk'];
        // echo $id . '-' . $kode;
    $sql = "DELETE FROM tb_list_karyawan WHERE no_nip=:id AND kode_list_karyawan=:kode";
    $stmt = $delete->runQuery($sql);
    $stmt->execute(array(
        ':id'	=>$id,
        ':kode' =>$kode
    ));
    if (!$stmt) {
        # code...
        echo "Data Tidak berhasil di hapus.";
    }else{
        echo "<script>
            alert('Karyawan Berhasil di Hapus!');
            window.location.href='../?p=select-karyawan&id=".$link."';
            </script>";
    }

?>