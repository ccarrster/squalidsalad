<?php
$loadedFiles = array();
for($index = 1; $index < 8; $index++){
	$loadedFiles[] = loadCSV('chirpp-schirpt-eng'.$index.'.csv');
}

function loadCSV($path){
	$result = array();
	$file = fopen($path, 'r');
	while(($array = fgetcsv($file)) !== false){
		$result[] = $array;
	}
	fclose($file);
	return $result;
}
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
<div>Chris Carr <a href="mailto:ccarrster@gmail.com"/>ccarrster@gmail.com</a></div>
</body>
</html>

 
