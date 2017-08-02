<?php
$id = $_GET['id'];

$data  = new Admin();
$sql = "SELECT tb_kerjasama_perusahan.nomor_kontrak, tb_kerjasama_perusahan.total_karyawan, tb_temporary_perusahaan.nama_perusahaan, tb_temporary_perusahaan.kode_perusahaan, tb_temporary_perusahaan.nama_perusahaan, tb_temporary_perusahaan.kebutuhan, tb_temporary_perusahaan.kode_pekerjaan, tb_jenis_pekerjaan.nama_pekerjaan, tb_kategori_pekerjaan.nama_kategori FROM tb_kerjasama_perusahan LEFT JOIN tb_temporary_perusahaan ON tb_temporary_perusahaan.no_pendaftaran=tb_kerjasama_perusahan.kode_perusahaan LEFT JOIN tb_jenis_pekerjaan ON tb_jenis_pekerjaan.kd_pekerjaan=tb_temporary_perusahaan.kode_pekerjaan LEFT JOIN tb_kategori_pekerjaan ON tb_kategori_pekerjaan.kode_kategori=tb_temporary_perusahaan.kebutuhan WHERE tb_kerjasama_perusahan.nomor_kontrak = :kode";
$stmt = $data->runQuery($sql);
$stmt->execute(array(
	':kode'	=> $id));
while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
	# code...

	$noKontrak = $row['nomor_kontrak'];
	$jmlh_karyawan = $row['total_karyawan'];


        $cek = "SELECT kode_list_karyawan FROM tb_list_karyawan WHERE kode_list_karyawan = :kode";
    $tes = $data->runQuery($cek);
    $tes->execute(array(
        ':kode' =>$id
    ));
    //cek jika jumlah nilai spk sudah ada
   if ($tes->rowCount() == $jmlh_karyawan){
        ?>
        <div class="col-md-6 col-lg-offset-3">
            <div class="well">
                <h4 class="text-danger">INFORMATION</h4>
                <p>Total Jumlah Karyawan yang dibutuhkan untuk Nomor SPK <span class="label label-primary"><?php echo $id ;?></span> sudah terpenuhi!</p>
                <hr>
                <p>Silahkan untuk menginput <a href="?p=add-list-job&name=<?php echo $id; ?>"><span class="label label-danger"><strong>LIST PEKERJAAN</strong></span></a> Karyawan.</p>
            </div>
        </div>
        <?php
    }else{
	if (!empty($row['kode_pekerjaan'])) {
        # code...
        //cek untuk available calon karyawan

        $kodePekerjaan = $row['kode_pekerjaan'];
        $dt = "SELECT tb_karyawan.no_ktp, tb_karyawan.no_NIK, tb_karyawan.nama_depan, tb_karyawan.nama_belakang,tb_karyawan.status, tb_apply_pekerjaan.kd_pekerjaan, tb_jenis_pekerjaan.nama_pekerjaan, tb_info_test.kode_test, tb_info_interview.kd_interview, tb_karyawan.nilai FROM tb_karyawan 
LEFT JOIN tb_apply_pekerjaan ON tb_apply_pekerjaan.no_ktp=tb_karyawan.no_ktp
LEFT JOIN tb_jenis_pekerjaan ON tb_jenis_pekerjaan.kd_pekerjaan=tb_apply_pekerjaan.kd_pekerjaan
LEFT JOIN tb_info_test ON tb_info_test.no_ktp = tb_karyawan.no_ktp
LEFT JOIN tb_info_interview ON tb_info_interview.no_ktp = tb_karyawan.no_ktp WHERE tb_karyawan.status = '' AND tb_apply_pekerjaan.kd_pekerjaan = :data ";
        $stmt = $data->runQuery($dt);
        $stmt->execute(array(
            ':data' => $kodePekerjaan));
        if ($stmt->rowCount() == 0) {
            //jika hasil tidak ada untuk kategori pekerjaan
            ?>
            <div class="col-md-6 col-lg-offset-3">
                <div class="well">
                    <h4 class="text-danger"><strong>INFORMATION</strong></h4>
                    <p>Karyawan yang sesuai dengan posisi <span class="label label-primary"><?php echo $row['nama_pekerjaan'] ;?></span> belum tersedia!</p>
                    <hr>
                    <p>Silahkan untuk membuat pengajuan request <a href=""><span class="label label-danger"><strong>LIST LOKER</strong></span></a> untuk posisi <span class="label label-danger"><?php echo $row['nama_pekerjaan'] ;?></span>.</p>
                </div>
            </div>
            <?php
        } else {
            ?>


            <h2>Pilih Karyawan</h2>
            <hr>
            <p>Select Karyawan untuk bekerja pada Perusahaan <strong><?php echo $row['nama_perusahaan']; ?></strong>
                dengan NOMOR KONTRAK <strong><?php echo $row['nomor_kontrak']; ?></strong>.</p>
            <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                    <thead>
                    <tr class="headings">
                        <th class="column-title">Nomor KTP</th>
                        <th class="column-title">Nomor NIP</th>
                        <th class="column-title">Nama Karyawan</th>
                        <th class="column-title">Pekerjaan</th>
                        <th class="column-title">Hasil Ujian</th>
                        <th class="column-title">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $query = "SELECT tb_karyawan.no_ktp, tb_karyawan.no_NIK, tb_karyawan.nama_depan, tb_karyawan.nama_belakang,tb_karyawan.status, tb_apply_pekerjaan.kd_pekerjaan, tb_jenis_pekerjaan.nama_pekerjaan, tb_info_test.kode_test, tb_info_interview.kd_interview, tb_karyawan.nilai FROM tb_karyawan 
LEFT JOIN tb_apply_pekerjaan ON tb_apply_pekerjaan.no_ktp=tb_karyawan.no_ktp
LEFT JOIN tb_jenis_pekerjaan ON tb_jenis_pekerjaan.kd_pekerjaan=tb_apply_pekerjaan.kd_pekerjaan
LEFT JOIN tb_info_test ON tb_info_test.no_ktp = tb_karyawan.no_ktp
LEFT JOIN tb_info_interview ON tb_info_interview.no_ktp = tb_karyawan.no_ktp WHERE tb_karyawan.status = '' AND tb_apply_pekerjaan.kd_pekerjaan = :data ";
                    $stmt = $data->runQuery($query);
                    $stmt->execute(array(
                        ':data' => $kodePekerjaan));
                    if ($stmt->rowCount() == '0') {
                        # code...
                        ?>
                        <tr>
                            <td colspan="5">Data tidak ada</td>
                        </tr>
                        <?php
                    } else {
                        while ($col = $stmt->fetch(PDO::FETCH_LAZY)) {
                            # code...
                            if ($col['nilai'] == '1') {
                                $hasil = '<span class="label label-success">Lulus</span>';
                            } elseif ($col['nilai'] == '0') {
                                $hasil = '<span class="label label-danger">Gagal</span>';
                            } else {
                                $hasil = '<span class="label label-default">belum ujian</span>';
                            }

                            ?>


                            <tr class="even pointer">


                                <td><?php echo $col['no_ktp']; ?></td>
                                <td><?php echo $col['no_NIK']; ?></td>
                                <td>
                                    <a href="?p=detail-karyawan&id=<?php echo $col['no_ktp']; ?>"><?php echo $col['nama_depan']; ?><?php echo $col['nama_belakang']; ?></a>
                                </td>
                                <td><?php echo $col['nama_pekerjaan']; ?></td>
                                <td><?php echo $hasil; ?></td>
                                <td>
                                    <a href="php/ajx/add-karyawan.php?id=<?php echo $col['no_NIK']; ?>&kode=<?php echo $row['nomor_kontrak']; ?>&jml=<?php echo $jmlh_karyawan; ?>">
                                        <button class="btn btn-xs btn-primary"><span class="fa fa-fw fa-plus"></span>
                                            Add
                                        </button>
                                    </a>
                                </td>

                            </tr>
                        <?php }
                    } ?>
                    </tbody>
                </table>
            </div>

            <?php }
        }
    else {

        $query = "SELECT tb_karyawan.no_ktp, tb_karyawan.no_NIK, tb_karyawan.nama_depan, tb_karyawan.nama_belakang,tb_karyawan.status, tb_apply_pekerjaan.kd_pekerjaan FROM tb_karyawan
LEFT JOIN tb_apply_pekerjaan ON tb_apply_pekerjaan.no_ktp=tb_karyawan.no_ktp WHERE tb_karyawan.status = '' AND tb_apply_pekerjaan.kd_pekerjaan = :data";
        $stmt = $data->runQuery($query);
        $stmt->execute(array(
            ':data' => $kodePekerjaan));

        ?>
        <div class="col-md-6 col-lg-offset-3">
            <div class="well">
                <h4 class="text-danger" style="font-weight: bold;">INFORMATION</h4>
                <p>Total Jumlah Karyawan yang dibutuhkan adalah <span
                            class="label label-primary"><?php echo $row['total_karyawan']; ?></span> belum terpenuhi!
                </p>
                <hr>
                <p>Dikarenakan Calon Karyawan untuk posisi <span
                            class="label label-danger"><?php echo $row['nama_kategori']; ?></span> belum tersedia!</p>
            </div>
        </div>


        <?php
    }
    	}
} ?>