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