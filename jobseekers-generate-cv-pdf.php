<?php include("includes/config.php"); 
checkuserlogin(); 

	ob_start();
	include('jobseekers-generate-cv--details.php');
	$output = ob_get_contents();
	ob_end_clean();
	include('tcpdf/examples/tcpdf_include.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
		$image_file = 'ejn.png';
		$this->Image($image_file, 15, 10, 0, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', 'B', 20);
		// Title
		$this->Cell(0, 10, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', '', 6);
		// Page number
		$this->Cell(0, 10, '', 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}


// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('JobSeakers');
$pdf->SetTitle('JobSeakers - CV');
$pdf->SetSubject('JobSeakers');
$pdf->SetKeywords('JobSeakers Admin, RWS, GT, PDF, Print');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, '20', PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 8);

// Start First Page Group
$pdf->startPageGroup();


$pdf->AddPage();
$pdf->writeHTML($output, true, false, true, false, '');


//$filename = 'JobSeakers-CV-For-'.$_SESSION["USER"]['Firstname'].'-'.$_SESSION["USER"]['Lastname'].'-'.date("d-m-Y-H-i-s").'.pdf';
$filename = 'JobSeakers-CV-For-'.$_SESSION["USER"]['Fullname'].'-'.date("d-m-Y-H-i-s").'.pdf';
$pdf->Output($filename, 'I');	

?>