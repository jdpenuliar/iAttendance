<?
session_start();

$_SESSION['sessionViewWeeklyReportStartDate'] = $startDate = $_GET['viewWeeklyReportStartYearx'] . "-" . $_GET['viewWeeklyReportStartMonth'] . "-" . $_GET['viewWeeklyReportStartDay'] . "  00:00:00";
$_SESSION['sessionViewWeeklyReportEndDate'] = $endDate = $_GET['viewWeeklyReportEndYear'] . "-" . $_GET['viewWeeklyReportEndMonth'] . "-" . $_GET['viewWeeklyReportEndDay'] . " 23:59:00";
$_SESSION['sessionViewWeeklyReportUserID'];
	require_once("dompdf/dompdf_config.inc.php");
	spl_autoload_register('DOMPDF_autoload');
	function pdf_create($html, $filename, $paper, $orientation, $stream=TRUE)
	{
		$dompdf = new DOMPDF();
		$dompdf->set_paper($paper,$orientation);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream($filename.".pdf");
	}
	$filename = 'report';
	$dompdf = new DOMPDF();
	$html = file_get_contents("x.php"); 
	pdf_create($html,$filename,'A4','portrait');
?>