<?php
require_once('data.php');
require_once('safetydata.php');
?>
<html>
<head>
	<title>
		DemoFirst - SqualidSalad
	</title>
	<script language="javascript">
		var injuryData = new Array();
		var tips = new Array();
		<?php
		/*
		5 Bathroom
		6 Bedroom
		9 Kitchen
		10 Livingroom
		19 Garden/Yard
		*/
		$rooms = array(6, 5, 9, 19, 10);
		$roomCount = 0;
		foreach($rooms as $room){
			echo('injuryData['.$roomCount.'] = new Array(');
			for($age = 1; $age < 3; $age++){
				echo("'".number_format(getPercentAgeRoom($age, $room), 2)."%'");
				if($age < 2){
					echo(', ');
				}
			}
			echo(');');
			$roomCount++;
		}

		$tipCount = 0;
		foreach($safetyData as $ageData){
			$ageCount = 0;
			echo('var ageTips = new Array();');
			foreach($ageData['categories'] as $categoryName=>$categoryData){
				echo('var rooms = new Array();');
				$infoCount = 0;
				foreach($categoryData as $info){
					echo('rooms['.$infoCount.'] = "'.$info.'";');
					$infoCount++;
				}
				echo('ageTips['.$ageCount.'] = rooms;');
				$ageCount++;
			}
			echo('tips['.$tipCount.'] = ageTips;');
			$tipCount++;
		}

		?>




		var selectedAge = null;
		var selectedAgeRange = null;

		function getAgeRoomPercent(age, room){
			return injuryData[room][age];
		}

		function refreshInjuryData(age, ageRange){
			selectedAgeRange = ageRange;
			selectedAge = age;
			for(i = 0; i < 5; i++){
				element = document.getElementById('percent' + i);
				element.innerHTML = ' ' + getAgeRoomPercent(age, i);
			}
		}

		function getTipsFor(age, room){
			var result = '<ul>';
			for(var i = 0; i < tips[age][room].length; i++){
					result += '<li>' + tips[age][room][i] + '</li>';
			}
			result += '</ul>';
			return result;
		}

		function refreshTips(roomId){
			if(selectedAgeRange != null){
				element = document.getElementById('tips');
				element.innerHTML = getTipsFor(selectedAgeRange, roomId);
			} else {
				alert('Select an age range first');
			}
		}

	</script>
<?php

function getPercentAgeRoom($age, $room){
	global $loadedFiles;
	$percentOfTotal = $loadedFiles[3][$room][$age];
	$roomCount = count($loadedFiles[3]) - 1;
	$percentAgeTotal = $loadedFiles[3][$roomCount][$age];
	$percentUnknown = $loadedFiles[3][4][$age];
	return $percentOfTotal * (100 / ($percentAgeTotal - $percentUnknown));
}
?>


</head>
<body>
<h1>DemoFirst - SqualidSalad</h1>
Problem: Unintentional Injuries of Children
<ul>
<li>Age Specific Home Child Proofing</li>
</ul>
<div>
	<div style="float:left; position:relative; padding:5px;" onclick="refreshInjuryData(0, 0);"><img src="age06.jpg"/><div style="position:absolute; bottom:10px; right:10px; background-color:green;">0-6 Months<img style="padding:2px;" src="arrow.png"/></div></div>
	<div style="float:left; position:relative; padding:5px;" onclick="refreshInjuryData(0, 1);"><img src="age612.jpg"/><div style="position:absolute; bottom:10px; right:10px; background-color:green;">6-12 Months<img style="padding:2px;" src="arrow.png"/></div></div>
	<div style="float:left; position:relative; padding:5px;" onclick="refreshInjuryData(0, 2);"><img src="age13.jpg"/><div style="position:absolute; bottom:10px; right:10px; background-color:green;">1-3 Years<img style="padding:2px;" src="arrow.png"/></div></div>
	<div style="float:left; position:relative; padding:5px;" onclick="refreshInjuryData(0, 3);"><img src="age35.jpg"/><div style="position:absolute; bottom:10px; right:10px; background-color:green;">3-5 Years<img style="padding:2px;" src="arrow.png"/></div></div>
	<div style="float:left; position:relative; padding:5px;" onclick="refreshInjuryData(1, 4);"><img src="age5p.jpg"/><div style="position:absolute; bottom:10px; right:10px; background-color:green;">5+ Years<img style="padding:2px;" src="arrow.png"/></div></div>
</div>
<div style="clear:both;"></div>

<div>
	<div style="float:left; padding:5px;" onclick="refreshTips(0);"><img src="bedroom.jpg"/><div>Bedroom<span id="percent0"></span></div></div>
	<div style="float:left; padding:5px;" onclick="refreshTips(1);"><img src="bathroom.jpg"/><div>Bathroom<span id="percent1"></span></div></div>
	<div style="float:left; padding:5px;" onclick="refreshTips(2);"><img src="kitchen.jpg"/><div>Kitchen<span id="percent2"></span></div></div>
	<div style="float:left; padding:5px;" onclick="refreshTips(3);"><img src="outdoors.jpg"/><div>Outdoors<span id="percent3"></span></div></div>
	<div style="float:left; padding:5px;" onclick="refreshTips(4);"><img src="livingroom.jpg"/><div>Living room<span id="percent4"></span></div></div>
</div>
<div style="clear:both;"></div>
<div id="tips"></div>
<div>Chris Carr <a href="mailto:ccarrster@gmail.com"/>ccarrster@gmail.com</a></div>
</body>
</html>

 
