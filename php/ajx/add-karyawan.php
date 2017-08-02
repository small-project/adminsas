<?php

$id = $_GET['id'];
$kode = $_GET['kode'];
$total = $_GET['jml'];

include_once '../../config/api.php';
$kelas = new Admin();

$data = $kelas->runQuery("SELECT * FROM tb_kerjasama_perusahan WHERE nomor_kontrak = :nomor");
$data->execute(array(
    ':nomor' => $kode
));

$row = $data->fetch(PDO::FETCH_LAZY);
$nomor_pendaftaran = $row['kode_perusahaan'];

    if (empty($id)){
        echo "<script>
            alert('Nomor NIP belum ada!');
            window.location.href='../../index.php?p=select-karyawan&id=".$kode."';
            </script>";
    }else{

            $sql = "INSERT INTO tb_list_karyawan (kode_list_karyawan, no_nip) VALUES (:kode, :id)";
            $stmt = $kelas->runQuery($sql);

            $stmt->execute(array(
                ':kode'		=> $kode,
                ':id'   => $id));

            if (!$stmt) {
                # code...
                echo "gagal";
            } else {

                $query = "UPDATE tb_karyawan SET status = '1' WHERE no_ktp = :data";
                $stmt = $kelas->runQuery($query);
                $stmt->execute(array(
                    ':data' => $id));

                //cek ke tb_job jika total karyawan terpenuhi
                $cek = "SELECT kode_list_karyawan FROM tb_list_karyawan WHERE kode_list_karyawan = :kode";
                $dt = $kelas->runQuery($cek);
                $dt->execute(array(
                    ':kode' =>$kode
                ));
                if ($dt->rowCount() == $total){
                    $in = "UPDATE tb_temporary_perusahaan SET status = '4' WHERE no_pendaftaran = :pendaftaran";
                    $input = $kelas->runQuery($in);
                    $input->execute(array(
                        ':pendaftaran' => $nomor_pendaftaran
                    ));
                    echo "<script>
                        alert('Karyawan Berhasil ditambahkan!');
                        window.location.href='../../index.php?p=select-karyawan&id=".$kode."';
                    </script>";
                }else{
                    echo "<script>
                        alert('Karyawan Berhasil ditambahkan!');
                        window.location.href='../../index.php?p=select-karyawan&id=".$kode."';
                    </script>";
                }
            }
        }
?>

