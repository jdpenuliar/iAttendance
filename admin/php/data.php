<?php
	include("../include/DBConfigs.php");
	//generates xml contents from php
	header("Content-type: text/xml");
	echo "<?xml version='1.0' encoding='UTF-8' standalone='yes' ?>";
	//this displays to the html
	echo '<response>';
		$classDBRelatedFunctions->functionInternInfo($_GET['userID']);
		//$classDBRelatedFunctions->functionInternInfo(4);
		//$classDBRelatedFunctions->functionInternInfo(4);
	echo '</response>';

?>