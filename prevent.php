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
$prevention = array();
$stairs = array();
$stairs[] = 'A handrail, or one on each side of the stairs';
$stairs[] = 'A properly installed carpet or traction mat on each step';
$stairs[] = 'Gates at the top and bottom of the stairwell';
$stairs[] = 'Well lit stairwell';
$stairs[] = 'Keep the stairwell and landing free from objects to step on';
$kitchen = array();
$kitchen[] = 'Turn your pot handles in';
$kitchen[] = 'Get safety locks for your cub board doors/drawers';
$kitchen[] = 'Gate off the area';
$prevention['KITCHEN'] = $kitchen;
if($percentOfAge > 5){
	echo('<div>Injuries in '.$loadedFiles[3][$room][0].' are very common for this age group. We suggest investing in some preventative actions.</div>');
	if(isset($prevention[$loadedFiles[3][$room][0]])){
		foreach($prevention[$loadedFiles[3][$room][0]] as $suggestion){
			echo('<div>'.$suggestion.'</div>');
		}
	}
}
?>
 
