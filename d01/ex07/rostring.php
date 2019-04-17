#!/usr/bin/php
<?PHP
function ft_strsplit($str)
{
	$array = array_values(array_filter(explode(" ", $str)));
	return($array);
}
if ($argc >= 2)
{
	$i = 1;
	$arr = array();
	while ($i < count($argv))
	{
		$splitted = ft_strsplit($argv[$i]);
		$arr = array_merge($arr, $splitted);
		$i++;
	}
	$l = count($arr);
	$x = 1;
	while ($x <= $l - 1)
	{
		print "$arr[$x] ";
		$x++;
	}
	print "$arr[0]\n";
}
?>
