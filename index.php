<?php
$file = fopen('chirpp-schirpt-eng1.csv', 'r');
while(($array = fgetcsv($file)) !== false){
	var_dump($array);
}
?>

 
