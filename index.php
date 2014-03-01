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
<form>
	<div>
	Age
	<select>
<?php
for($ageIndex = 1; $ageIndex < 6; $ageIndex++){
	echo('<option>'.$loadedFiles[6][3][$ageIndex].'</option>');
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
			$rooms[] = $roomName;
			$roomLine++;
		}
?>
	<select>
<?php
	foreach($rooms as $room){
		echo('<option>'.$room.'</option>');
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

 
