<?php
	include("../include/DBConfigs.php");
	//generates xml contents from php
	header("Content-type: text/xml");
	echo "<?xml version='1.0' encoding='UTF-8' standalone='yes' ?>";
	//this displays to the html
	echo '<response>';
		$classDBRelatedFunctions->functionWeeklyReport($_GET['userID'],$_GET['startDate'],$_GET['endDate']);
		//$classDBRelatedFunctions->functionWeeklyReport($_GET['userID']);
		//$classDBRelatedFunctions->functionWeeklyReport(4,"2016-05-9 00:00:00","2016-05-11 23:59:00");
	echo '</response>';

?>