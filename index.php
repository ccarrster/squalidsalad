<?php
require_once('data.php');
?>
<html>
<body>
<h1>DemoFirst - SqualidSalad</h1>
Problem: Unintentional Injuries of Children
<ul>
<li>Age Specific Home Child Proofing</li>
</ul>
<div><div style="float:left;"><img src="age06.jpg"/><div>0-6 Months</div></div><div style="float:left;"><img src="age612.jpg"/><div>6-12 Months</div></div><div style="float:left;"><img src="age13.jpg"/><div>1-3 Years</div></div><div style="float:left;"><img src="age35.jpg"/><div>3-5 Years</div></div><div style="float:left;"><img src="age5p.jpg"/><div>5+ Years</div></div></div>
<div style="clear:both;"></div>
<div><div style="float:left;"><img src="bedroom.jpg"/><div>Bedroom</div></div><div style="float:left;"><img src="bathroom.jpg"/><div>Bathroom</div></div><div style="float:left;"><img src="kitchen.jpg"/><div>Kitchen</div></div><div style="float:left;"><img src="outdoors.jpg"/><div>Outdoors</div></div><img src="livingroom.jpg"/><div>Living room</div></div></div>
<div style="clear:both;"></div>
<form method='post' action="prevent.php">
	<div>
	Age
	<select name="age">
		<option value="0-6 M">0-6 M</option>
		<option value="6-11 M">6-11 M</option>
		<option value="1-3 Y">1-3 Y</option>
		<option value="3-5 Y">3-5 Y</option>
		<option value="5+ Y">5+ Y</option>
	</select>
	</div>

	<div>
	Area of activity
		<?php
		$rooms = array();
		$roomLine = 5;
		while(($roomName = $loadedFiles[3][$roomLine][0]) != 'Total'){
			$theRoom = array();
			$theRoom['id'] = $roomLine;
			$theRoom['name'] = $roomName;
			$rooms[] = $theRoom;
			$roomLine++;
		}
?>
	<select name="room">
<?php
	foreach($rooms as $room){
		echo('<option value="'.$room['id'].'">'.$room['name'].'</option>');
	}
?>
	</select>
	</div>
	<div>
		<input type="submit"/>
	</div>
</form>
<div>Chris Carr <a href="mailto:ccarrster@gmail.com"/>ccarrster@gmail.com</a></div>
</body>
</html>

 
