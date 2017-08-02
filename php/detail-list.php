<?php
$kode = $_GET['id'];

$query = "SELECT tb_job.nomor_kontrak, tb_list_karyawan.no_nip, tb_karyawan.nama_depan, tb_karyawan.nama_belakang FROM tb_job INNER JOIN tb_list_karyawan ON tb_list_karyawan.kode_list_karyawan=tb_job.nomor_kontrak INNER JOIN tb_karyawan ON tb_karyawan.no_NIK=tb_list_karyawan.no_nip WHERE tb_job.nomor_kontrak = ':nomor_kontrak'";
$conn = new Karyawan();
$stmt = $conn->runQuery($query);
$stmt->execute(array(
    ':nomor_kontrak' => $kode
));
while ($col = $stmt->fetch(PDO::FETCH_LAZY)){
    echo $col['no_nip'];
};
?>
<br/>
<h4 class="page-header">List berdasarkan Karyawan</h4>


<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#1" aria-expanded="true" aria-controls="1">
                    Collapsible Group Item #1
                </a>
            </h4>
        </div>
        <div id="1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
            </div>
        </div>
    </div>
</div>