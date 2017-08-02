<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 03/06/2017
 * Time: 15:15
 */
$kode = $_GET['name'];
$conn = new Admin();

    //input data
    if (isset($_POST['addJob'])){
        $title = $_POST['txt_title'];
        $admin = $_POST['txt_admin'];
        $kodeData = $_POST['txt_kode'];
        $tugas = $_POST['txt_tugas'];
        $tanggungJwb = $_POST['txt_tanggungJawab'];

        $sql = "INSERT INTO tb_list_job (kode_detail_job, nama_job, deskripsi_job, keterangan, kode_admin) VALUES (:kode, :nama, :deskripsi, :ket, :admin)";
        $stmt = $conn->runQuery($sql);
        $stmt->execute(array(
                ':kode'  => $kodeData,
                ':nama'  => $title,
                ':deskripsi' => $tugas,
                ':ket'   => $tanggungJwb,
                ':admin' => $admin
        ));
        if ($stmt) {
            echo "<script>
    alert('Input Data Success!" . $kode . "');
    window.location.href='?p=add-list-job&name=" . $kode . "';
    </script>";
        }
    }
    //end of input data

    $cek = "SELECT * FROM tb_job WHERE nomor_kontrak = :data";
    $cekData = $conn->runQuery($cek);
    $cekData->execute(array(
            ':data' => $kode
    ));
    $row = $cekData->fetch(PDO::FETCH_LAZY);
    $kode_detail = $row['kode_detail_job'];
    if (empty($kode_detail)) {
        ?>
        <div class="col-md-4 col-lg-offset-4">
            <button class="btn btn-block generateKode" data-id = "<?php echo $kode; ?>">Generate code</button>
        </div>
        <?php
    }else {
        $kodeDetail = $row['kode_detail_job'];
        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="x_panel">
                    <div class="x_title">
                        <h2 style="text-transform: uppercase;">input data list pekerjaan</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"></a>
                            <li><a class="collapse-link"></a>
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>
                        <form class="form-horizontal" method="post" action = "">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name ="txt_title" class="form-control" id="inputEmail3" placeholder="nama list pekerjaan" required>
                                    <input type="hidden" name ="txt_kode" class="form-control" id="inputEmail3" value="<?php echo $kodeDetail; ?>">
                                    <input type="hidden" name ="txt_admin" class="form-control" id="inputEmail3" value="<?php echo $kd_admin; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Tugas</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name = "txt_tugas" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Tanggung Jawab</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name = "txt_tanggungJawab" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name = "addJob" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="add list job"><span class="fa fa-fw fa-plus"></span></button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="x_panel">
                    <div class="x_title">
                        <h2 style="text-transform: uppercase;">list job </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"></a>
                            <li><a class="collapse-link"></a>
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>
                        <table class="table table-striped">
                            <thead>
                            <th>title</th>
                            <th>tugas</th>
                            <th>tanggung jawab</th>
                            <th>#</th>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT * FROM tb_list_job WHERE kode_detail_job = :kode";
                            $stmt = $conn->runQuery($sql);
                            $stmt->execute(array(
                                    ':kode' => $kodeDetail
                            ));
                            echo $kodeDetail;
                            while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['nama_job']; ?></td>
                                    <td><?php echo $row['deskripsi_job']; ?></td>
                                    <td><?php echo $row['keterangan']; ?></td>
                                    <td><a href="php/delete-addJob.php?id=<?php echo $row['id']; ?>&kode=<?php echo $kode; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="delete a job"><span class="fa fa-fw fa-trash"></span></button></a></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target=".modal-psikolog">finish
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <?php
    }
?>
