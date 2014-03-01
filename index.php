<?php
require_once('data.php');
require_once('safetydata.php');
?>
<html>
<head>
	<title>
		Squalid Salad: Age Specific Child Safety
	</title>
	<style>
		.shadowy{
			box-shadow: 4px 4px 2px #888888;
		}
	</style>

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
				element.innerHTML = getAgeRoomPercent(age, i) + ' of injuries';
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
<h1>SqualidSalad</h1>
<ul>
<li>Age Specific Home Child Safety</li>
</ul>
<div>
	<ol>
		<li>Choose an age group to see how often injuries happen in each area of your home</li>
		<li>Then choose an area of your home to get tips on how to make the area safer for the selected age group</li>
	</ol>
</div>
<div>
	<div style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshInjuryData(0, 0);"><img class="shadowy" src="age06.png"/><div style="position:absolute; bottom:10px; right:10px; background-color:green;">0-6 Months<img style="padding:2px;" src="arrow.png"/></div></div>
	<div style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshInjuryData(0, 1);"><img class="shadowy" src="age612.png"/><div style="position:absolute; bottom:10px; right:10px; background-color:green;">6-12 Months<img style="padding:2px;" src="arrow.png"/></div></div>
	<div style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshInjuryData(0, 2);"><img class="shadowy" src="age13.png"/><div style="position:absolute; bottom:10px; right:10px; background-color:green;">1-3 Years<img style="padding:2px;" src="arrow.png"/></div></div>
	<div style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshInjuryData(0, 3);"><img class="shadowy" src="age35.png"/><div style="position:absolute; bottom:10px; right:10px; background-color:green;">3-5 Years<img style="padding:2px;" src="arrow.png"/></div></div>
	<div style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshInjuryData(1, 4);"><img class="shadowy" src="age5p.png"/><div style="position:absolute; bottom:10px; right:10px; background-color:green;">5+ Years<img style="padding:2px;" src="arrow.png"/></div></div>
</div>
<div style="clear:both;"></div>

<div>
	<div style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshTips(0);"><img class="shadowy" src="bedroom.png"/><div style="position:absolute; bottom:10px; right:10px; background-color:green;">Bedroom<img style="padding:2px;" src="arrow.png"/></div><div style="position:absolute; background-color:red; top:10px; left:10px;" id="percent0"></div></div>
	<div style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshTips(1);"><img class="shadowy" src="bathroom.png"/><div style="position:absolute; bottom:10px; right:10px; background-color:green;">Bathroom<img style="padding:2px;" src="arrow.png"/></div><div style="position:absolute; background-color:red; top:10px; left:10px;" id="percent1"></div></div>
	<div style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshTips(2);"><img class="shadowy" src="kitchen.png"/><div style="position:absolute; bottom:10px; right:10px; background-color:green;">Kitchen<img style="padding:2px;" src="arrow.png"/></div><div style="position:absolute; background-color:red; top:10px; left:10px;" id="percent2"></div></div>
	<div style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshTips(3);"><img class="shadowy" src="outdoors.png"/><div style="position:absolute; bottom:10px; right:10px; background-color:green;">Outdoors<img style="padding:2px;" src="arrow.png"/></div><div style="position:absolute; background-color:red; top:10px; left:10px;" id="percent3"></div></div>
	<div style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshTips(4);"><img class="shadowy" src="livingroom.png"/><div style="position:absolute; bottom:10px; right:10px; background-color:green;">Living room<img style="padding:2px;" src="arrow.png"/></div><div style="position:absolute; background-color:red; top:10px; left:10px;" id="percent4"></div></div>
</div>
<div style="clear:both;"></div>
<div>
Safety Tips
</div>
<div id="tips"></div>
<div>Chris Carr <a href="mailto:ccarrster@gmail.com"/>ccarrster@gmail.com</a></div>
</body>
</html>

 
