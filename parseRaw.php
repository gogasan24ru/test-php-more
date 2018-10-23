<?php
mb_internal_encoding("UTF-8");
$filename = $argv[1];
$str=(file_get_contents($filename));
$mathces=Array();
preg_match_all('/>[а-яА-Я]{8}</', $str, $matches);
$matches=array_unique($matches[0]);
foreach($matches as &$value)
{
	$value= strtolower(trim($value,'><'));
}
print_r($matches);

?>