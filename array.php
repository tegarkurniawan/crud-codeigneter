<?php
$array = array(array('id'=>1,'image'=> array('url'=> '1.jpg')), array('id'=>2,'image'=> array('url'=> '2.jpg')));
$singleArray = array();
foreach ($array as $a){
	foreach ($a as $value) {
		foreach ($value as $b) {
			array_push($singleArray, $b);
		}
	     	
	}     
}
var_dump($singleArray);