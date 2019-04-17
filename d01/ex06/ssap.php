#!/usr/bin/php
<?PHP
function ft_strsplit($str)
{
	$array = array_values(array_filter(explode(" ", $str)));
	sort($array);
	return($array);
}

if ($argc >= 2)
{
	$i = 0;
	$arr = array();
	while (++$i < count($argv))
	{
		$splitted = ft_strsplit($argv[$i]);
		$arr = array_merge($arr, $splitted);
	}
	sort($arr);
	$x = -1;
	while (++$x < count($arr))
	{
		printf ("$arr[$x]\n");
	}
}
?>
