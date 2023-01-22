<?php

$server	="sql209.epizy.com";
$user	="epiz_33422259";
$db		="epiz_33422259_lifelink";
$psswd	="QhrqqFBV3bs";

$conn = new mysqli($server,$user,$psswd,$db);

if($conn->connect_error)
{
	$error="Database connection Failed. Please try again Later...";
}

?>
