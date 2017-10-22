<?php
		/* include autoloader */
		require_once 'dompdf/autoload.inc.php';
		include_once '../config/api.php';
    use Dompdf\Dompdf;

    /* instantiate and use the dompdf class */
    $dompdf = new Dompdf();

    $html .='<tr style="background-color: #055294; color: #fff;">
    <td colspan="3">Total Nilai: </td>
    <td colspan="2">GRADE Total: </td>
    </tr></table></div>';

    $dompdf->loadHtml($html);

    /* Render the HTML as PDF */
    $dompdf->render();
    $dompdf->stream('' ,array("Attachment" => false));
    ?>

<!-- <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Data Diri</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-3">Nama Lengkap</div>
      <div class="col-md-3">Arfan Azhari</div>
      <div class="col-md-3">Email</div>
      <div class="col-md-3">afz60.30@gmail.com</div>
    </div>
    <div class="col-md-12">
      <div class="col-md-3">Nama Lengkap</div>
      <div class="col-md-3">Arfan Azhari</div>
      <div class="col-md-3">Email</div>
      <div class="col-md-3">afz60.30@gmail.com</div>
    </div>
    <div class="col-md-12">
      <div class="col-md-3">Nama Lengkap</div>
      <div class="col-md-3">Arfan Azhari</div>
      <div class="col-md-3">Email</div>
      <div class="col-md-3">afz60.30@gmail.com</div>
    </div>
    <div class="col-md-12">
      <div class="col-md-3">Nama Lengkap</div>
      <div class="col-md-3">Arfan Azhari</div>
      <div class="col-md-3">Email</div>
      <div class="col-md-3">afz60.30@gmail.com</div>
    </div>
    <div class="col-md-12">
      <div class="col-md-3">Nama Lengkap</div>
      <div class="col-md-3">Arfan Azhari</div>
      <div class="col-md-3">Email</div>
      <div class="col-md-3">afz60.30@gmail.com</div>
    </div>
  </div>
  <table class="table table hover">
    <thead>
      <th>contoh</th>
      <th>contoh</th>
      <th>contoh</th>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>1</td>
        <td>1</td>
      </tr>
    </tbody>
  </table>
</div>
  </body>
</html> -->
