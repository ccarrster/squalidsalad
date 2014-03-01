<?php
require_once('data.php');
$age = $_POST['age'];
$room = $_POST['room'];
$ageGroup = $loadedFiles[6][3][$age];
echo('<div>Age group '.$ageGroup.'</div>');
$percentOfTotal = $loadedFiles[3][$room][$age];
$roomCount = count($loadedFiles[3]) - 1;
$percentAgeTotal = $loadedFiles[3][$roomCount][$age];
$percentOfAge = $percentOfTotal * (100 / $percentAgeTotal);
echo('<div>Percent of Unintentional Injuries in ' . $loadedFiles[3][$room][0] . ' ' . $percentOfAge . '%</div>');
if($percentOfAge > 5){
	echo('<div>Injuries in '.$loadedFiles[3][$room][0].' are very common for this age group. We suggest investing in some preventative actions.</div>');
}
?>
 
