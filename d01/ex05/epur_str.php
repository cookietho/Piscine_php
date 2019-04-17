#!/usr/bin/php
<?PHP
if ($argc == 2)
{
	$array = array_filter(explode(" ", $argv[1]));
	$str = implode(" ", $array);
	echo ("$str\n");
}
?>
