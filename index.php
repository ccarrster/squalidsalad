<?php
require_once('data.php');
?>
<html>
<body>
<h1>DemoFirst - SqualidSalad</h1>
Problem: Unintentional Injuries of Children
<ul>
<li>SqualidSalad provides suggestions for preventative measures to keep children safe</li>
<li>SqualidSalad provides quick access to FirstAid information</li>
<li>SqualidSalad provides emergency contact info, hospital and clinic locations</li>
</ul>
<form method='post' action="prevent.php">
	<div>
	Age
	<select name="age">
<?php
for($ageIndex = 1; $ageIndex < 6; $ageIndex++){
	echo('<option value="'.$ageIndex.'">'.$loadedFiles[6][3][$ageIndex].'</option>');
}
?>
	</select>
	</div>

	<div>
	Area of activity
		<?php
		$rooms = array();
		$roomLine = 4;
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

 
