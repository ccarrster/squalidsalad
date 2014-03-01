<?php
require_once('data.php');
require_once('safetydata.php');
$age = $_POST['age'];
$sentAge = $age;
if($age == '5+ Y'){
	$age = 2;
} else {
	$age = 1;
}
//TODO age does not map up... so we are going to use age 1 or 2... only 2 if it's 5+
$room = $_POST['room'];
$ageGroup = $loadedFiles[6][3][$age];
echo('<div>Age group '.$sentAge.'</div>');
$percentOfTotal = $loadedFiles[3][$room][$age];
$roomCount = count($loadedFiles[3]) - 1;
$percentAgeTotal = $loadedFiles[3][$roomCount][$age];

$percentUnknown = $loadedFiles[3][4][$age];

$percentOfAge = $percentOfTotal * (100 / ($percentAgeTotal - $percentUnknown));
echo('<div>Percent of Unintentional Injuries in ' . $loadedFiles[3][$room][0] . ' ' . $percentOfAge . '%</div>');

if($percentOfAge > 5){
	echo('<div>Injuries in '.$loadedFiles[3][$room][0].' are very common for this age group. We suggest investing in some preventative actions.</div>');
}

foreach($safetyData as $ageData){
	if($ageData['age'] == $sentAge){
		foreach($ageData['categories'] as $categoryName=>$categoryData){
			if (strcasecmp($categoryName, $loadedFiles[3][$room][0]) == 0) {
				foreach($categoryData as $info){
					echo('<div>'.$info.'</div>');
				}
			}
		}
	}
}

?>
 
