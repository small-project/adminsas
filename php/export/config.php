<?php
require '../../vendors/fpdf/fpdf.php';

/**
 *
 */
class PDF extends FPDF
{

  // function __construct(argument)
  // {
  //   # code...
  // }
  // protected $col = 0;
  // protected $y0;

  // function Header()
  // {
  //   # code...
  //   global $title;
  //
  //   $this->SetFont('Arial','B',15);
  //   $w = $this->GetStringWidth($title)+6;
  //   $this->SetX((210-$w)/2);
  //   $this->SetDrawColor(0,80,180);
  //   $this->SetFillColor(230,230,0);
  //   $this->SetTextColor(220,50,50);
  //   $this->SetLineWidth(1);
  //   $this->Cell($w,9,$title,1,1,'C',true);
  //   $this->Ln(10);
  //   // Save ordinate
  //   $this->y0 = $this->GetY();
  // }
  function Header()
	{
		//Logo
		$this->Image('../../../images/img.jpg',10,8);
		//Arial bold 15
		$this->SetFont('Arial','B',15);
		//pindah ke posisi ke tengah untuk membuat judul
		$this->Cell(80);
		//judul
		$this->Cell(30,10,'LAPORAN REKAPITULASI PENERIMAAN MAHASISWA BARU',0,0,'C');
		//pindah baris
		$this->Ln(20);
		//buat garis horisontal
		$this->Line(10,25,200,25);
	}
}


?>
