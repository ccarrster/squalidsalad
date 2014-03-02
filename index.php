<?php
require_once('data.php');
require_once('safetydata.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Squalid Salad: Age Specific Child Safety
	</title>
	<style type="text/css">
		.shadowy{
			box-shadow: 4px 4px 2px #888888;
		}

		.hovery{
				border:2px solid #ffffff;
		}
		.hovery:hover{
				border:2px solid #00ff00;
		}
		.fadey{
				background: -moz-linear-gradient(top, #eeeeee 0%, #ffffff 100%);
				background: -webkit-linear-gradient(top, #eeeeee 0%,#ffffff 100%);
				background: -o-linear-gradient(top, #eeeeee 0%,#ffffff 100%);
				background: -ms-linear-gradient(top, #eeeeee 0%,#ffffff 100%);
				background: linear-gradient(top, #eeeeee 0%,#ffffff 100%);
				width:850px;
				margin:0px auto;
		}
	</style>

	<script type="text/javascript">
		var injuryData = new Array();
		var tips = new Array();
		<?php
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
			echo('var ageTips = new Array();'."\n");
			foreach($ageData['categories'] as $categoryName=>$categoryData){
				echo('var rooms = new Array();'."\n");
				$infoCount = 0;
				foreach($categoryData as $info){
					echo('rooms['.$infoCount.'] = "'.utf8_decode($info).'";'."\n");
					$infoCount++;
				}
				echo('ageTips['.$ageCount.'] = rooms;'."\n");
				$ageCount++;
			}
			echo('tips['.$tipCount.'] = ageTips;'."\n");
			$tipCount++;
		}

		?>




		var selectedAge = null;
		var selectedAgeRange = null;
		var selectedRoom = null;

		function getAgeRoomPercent(age, room){
			return injuryData[room][age];
		}

		function refreshInjuryData(age, ageRange){
			selectedAgeRange = ageRange;
			for(var i = 0; i < 5; i++){
				var ageElement = document.getElementById('age' + i);
				ageElement.style.border = 'solid 2px #ffffff';
			}
			var ageElement = document.getElementById('age' + ageRange);
			ageElement.style.border = 'solid 2px #0000ff';
			selectedAge = age;
			for(i = 0; i < 5; i++){
				element = document.getElementById('percent' + i);
				element.innerHTML = getAgeRoomPercent(age, i) + ' of injuries';
			}
			if(selectedRoom != null){
				refreshTips(selectedRoom);
			}
		}

		function getTipsFor(age, room){
			var result = '<ol style="padding:5px;">';
			for(var i = 0; i < tips[age][room].length; i++){
					var color = '#dddddd';
					if(i % 2 == 0){
						color = '#cccccc';
					}
					result += '<li style="background-color:'+color+';">' + tips[age][room][i] + '</li>';
			}
			result += '</ol>';
			return result;
		}

		function refreshTips(roomId){
			for(var i = 0; i < 5; i++){
				var ageElement = document.getElementById('room' + i);
				ageElement.style.border = 'solid 2px #ffffff';
			}
			var ageElement = document.getElementById('room' + roomId);
			ageElement.style.border = 'solid 2px #0000ff';
			if(selectedAgeRange != null){
				element = document.getElementById('tips');
				element.innerHTML = getTipsFor(selectedAgeRange, roomId);
				var ageTipsElement = document.getElementById('ageTips');
				ageTipsElement.innerHTML = ' for ages ' + nameForAge(selectedAgeRange) + ' in the ' + nameForRoom(roomId);
			} else {
				alert('Select an age range first');
			}
			selectedRoom = roomId;
		}

		var ageNames = new Array('0-6 Months', '6-12 Months', '1-3 Years', '3-5 Years', '5+ Years');

		function nameForAge(ageId){
			return ageNames[ageId];
		}

		var roomNames = new Array('Outdoors', 'Kitchen', 'Bedroom', 'Bathroom', 'Living Room');

		function nameForRoom(roomId){
			return roomNames[roomId];
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
<body style="font-family:Arial; font-weight: bold; font-size: 14px;">
<div style="text-align:center;" class="fadey">
<h1><span style="color:#663333;">Squalid</span> <span style="color:#003300;">Salad</span></h1>
<h2>Making your home safer.</h2>
</div>

<div class="fadey" style="line-height: 18px;">
	<ol>
		<li>Choose an age group to see how often injuries happen in each area of your home</li>
		<li>Then choose an area of your home to get tips on how to make the area safer for the selected age group</li>
	</ol>
</div>
<div style="width:850px; margin:0px auto;">
	<div id="age0" class="hovery" style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshInjuryData(0, 0);"><div style="position:absolute; bottom:6px; right:125px;" ><img alt="roundy" src="pillleft.png"/></div><img alt="a child" class="shadowy" style="width:155px; height:288px;" src="age06.png"><div style="position:absolute; bottom:10px; right:20px; width:105px; color:#ffffff; background-color:#003300; vertical-align: middle; line-height:28px;">0-6 Months</div><div style="position:absolute; bottom:6px; right:1px;" ><img alt="roundy" src="pillright.png"/></div><div style="position:absolute; bottom:10px; right:15px;" ><img alt="arrow" src="arrow.png"></div></div>
	<div id="age1" class="hovery" style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshInjuryData(0, 1);"><div style="position:absolute; bottom:6px; right:125px;" ><img alt="roundy" src="pillleft.png"/></div><img alt="a child" class="shadowy" style="width:155px; height:288px;" src="age612.png"><div style="position:absolute; bottom:10px; right:20px; color:#ffffff; background-color:#003300; vertical-align: middle; line-height:28px; width:105px;">6-12 Months</div><div style="position:absolute; bottom:6px; right:1px;" ><img alt="roundy" src="pillright.png"/></div><div style="position:absolute; bottom:10px; right:15px;" ><img alt="arrow" src="arrow.png"></div></div>
	<div id="age2" class="hovery" style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshInjuryData(0, 2);"><div style="position:absolute; bottom:6px; right:125px;" ><img alt="roundy" src="pillleft.png"/></div><img alt="a child" class="shadowy" style="width:155px; height:288px;" src="age13.png"><div style="position:absolute; bottom:10px; right:20px; color:#ffffff; background-color:#003300; vertical-align: middle; line-height:28px; width:105px;">1-3 Years</div><div style="position:absolute; bottom:6px; right:1px;" ><img alt="roundy" src="pillright.png"/></div><div style="position:absolute; bottom:10px; right:15px;" ><img alt="arrow" src="arrow.png"></div></div>
	<div id="age3" class="hovery" style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshInjuryData(0, 3);"><div style="position:absolute; bottom:6px; right:125px;" ><img alt="roundy" src="pillleft.png"/></div><img alt="a child" class="shadowy" style="width:155px; height:288px;" src="age35.png"><div style="position:absolute; bottom:10px; right:20px; color:#ffffff; background-color:#003300; vertical-align: middle; line-height:28px; width:105px;">3-5 Years</div><div style="position:absolute; bottom:6px; right:1px;" ><img alt="roundy" src="pillright.png"/></div><div style="position:absolute; bottom:10px; right:15px;" ><img alt="arrow" src="arrow.png"></div></div>
	<div id="age4" class="hovery" style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshInjuryData(1, 4);"><div style="position:absolute; bottom:6px; right:125px;" ><img alt="roundy" src="pillleft.png"/></div><img alt="a child" class="shadowy" style="width:155px; height:288px;" src="age5p.png"><div style="position:absolute; bottom:10px; right:20px; color:#ffffff; background-color:#003300; vertical-align: middle; line-height:28px; width:105px;">5+ Years</div><div style="position:absolute; bottom:6px; right:1px;" ><img alt="roundy" src="pillright.png"/></div><div style="position:absolute; bottom:10px; right:15px;" ><img alt="arrow" src="arrow.png"></div></div>
</div>
<div style="clear:both;"></div>

<div style="width:850px; margin:0px auto;">
	<div id="room0" class="hovery" style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshTips(0);"><div style="position:absolute; bottom:6px; right:125px;" ><img alt="roundy" src="pillleft.png"/></div><img alt="outside" class="shadowy" style="width:155px; height:90px;" src="outdoors.png"><div style="position:absolute; bottom:10px; right:20px; color:#ffffff; background-color:#003300; vertical-align: middle; line-height:28px; width:105px;">Outdoors</div><div style="position:absolute; color:#ffffff; background-color:#663333; top:10px; left:10px;" id="percent3"></div><div style="position:absolute; bottom:6px; right:1px;" ><img alt="roundy" src="pillright.png"/></div><div style="position:absolute; bottom:10px; right:15px;" ><img alt="arrow" src="arrow.png"></div></div>
	<div id="room1" class="hovery" style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshTips(1);"><div style="position:absolute; bottom:6px; right:125px;" ><img alt="roundy" src="pillleft.png"/></div><img alt="kitchen" class="shadowy" style="width:155px; height:90px;" src="kitchen.png"><div style="position:absolute; bottom:10px; right:20px; color:#ffffff; background-color:#003300; vertical-align: middle; line-height:28px; width:105px;">Kitchen</div><div style="position:absolute; color:#ffffff; background-color:#663333; top:10px; left:10px;" id="percent2"></div><div style="position:absolute; bottom:6px; right:1px;" ><img alt="roundy" src="pillright.png"/></div><div style="position:absolute; bottom:10px; right:15px;" ><img alt="arrow" src="arrow.png"></div></div>
	<div id="room2" class="hovery" style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshTips(2);"><div style="position:absolute; bottom:6px; right:125px;" ><img alt="roundy" src="pillleft.png"/></div><img alt="bedroom" class="shadowy" style="width:155px; height:90px;" src="bedroom.png"><div style="position:absolute; bottom:10px; right:20px; color:#ffffff; background-color:#003300; vertical-align: middle; line-height:28px; width:105px;">Bedroom</div><div style="position:absolute; color:#ffffff; background-color:#663333; top:10px; left:10px;" id="percent0"></div><div style="position:absolute; bottom:6px; right:1px;" ><img alt="roundy" src="pillright.png"/></div><div style="position:absolute; bottom:10px; right:15px;" ><img alt="arrow" src="arrow.png"></div></div>
	<div id="room3" class="hovery" style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshTips(3);"><div style="position:absolute; bottom:6px; right:125px;" ><img alt="roundy" src="pillleft.png"/></div><img alt="bathroom" class="shadowy" style="width:155px; height:90px;" src="bathroom.png"><div style="position:absolute; bottom:10px; right:20px; color:#ffffff; background-color:#003300; vertical-align: middle; line-height:28px; width:105px;">Bathroom</div><div style="position:absolute; color:#ffffff; background-color:#663333; top:10px; left:10px;" id="percent1"></div><div style="position:absolute; bottom:6px; right:1px;" ><img alt="roundy" src="pillright.png"/></div><div style="position:absolute; bottom:10px; right:15px;" ><img alt="arrow" src="arrow.png"></div></div>
	<div id="room4" class="hovery" style="cursor:pointer; float:left; position:relative; padding:5px;" onclick="refreshTips(4);"><div style="position:absolute; bottom:6px; right:125px;" ><img alt="roundy" src="pillleft.png"/></div><img alt="livingroom" class="shadowy" style="width:155px; height:90px;" src="livingroom.png"><div style="position:absolute; bottom:10px; right:20px; color:#ffffff; background-color:#003300; vertical-align: middle; line-height:28px; width:105px;">Living room</div><div style="position:absolute; color:#ffffff; background-color:#663333; top:10px; left:10px;" id="percent4"></div><div style="position:absolute; bottom:6px; right:1px;" ><img alt="roundy" src="pillright.png"/></div><div style="position:absolute; bottom:10px; right:15px;" ><img alt="arrow" src="arrow.png"></div></div>
</div>
<div style="clear:both;"></div>
<div class="fadey">
<h2 style="text-align:center">Safety Tips <span id="ageTips"></span></h2>
</div>
<div class="fadey" id="tips" style="line-height: 18px;"></div>
<div class="fadey" style="line-height: 18px;">
	<p>If there is a current emergency call 911.</p>
	<p>Contact registered nurses via telephone. <a href="http://www.cwhn.ca/en/yourhealth/provincialhealthlines">http://www.cwhn.ca/en/yourhealth/provincialhealthlines</a></p>
	<p>Poison Control centres. <a href="http://www.safemedicationuse.ca/tools_resources/poison_centres.html">http://www.safemedicationuse.ca/tools_resources/poison_centres.html</a></p>
	<p>First aid manuals. <a href="http://firstaid-cpr.net/">http://firstaid-cpr.net/</a></p>
</div>
<div>Chris Carr <a href="mailto:ccarrster@gmail.com">ccarrster@gmail.com</a> <a href="about.php">About</a></div>
</body>
</html>

 
