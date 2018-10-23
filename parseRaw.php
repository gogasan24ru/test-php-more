<?php
mb_internal_encoding("UTF-8");
$filename = $argv[1];
$str=(file_get_contents($filename));
$mathces=Array();
preg_match_all('/>[А-Я]{8}</', $str, $matches);
$matches=array_unique($matches[0]);

foreach($matches as &$value)
{
	$value= mb_strtolower(trim($value,'><'));
	file_put_contents("words.lib",$value.PHP_EOL,FILE_APPEND);
}

print_r($matches);

?>
