#!/usr/bin/php
<?PHP
function ft_order($s1, $s2)
{
	$a = str_split(strtolower(($s1)));
	$b = str_split(strtolower(($s2)));
	$i = -1;
	while ($a[++$i] && $b[$i])
	{
		if (ctype_alpha($a[$i]))
		{
			if (ctype_alpha($b[$i]) && $a[$i] != $b[$i])
				return ($a[$i] < $b[$i]) ?  0 : 1;
			else if (!ctype_alpha($b[$i]))
				return 0;
		}
		else if (is_numeric($a[$i]))
		{
			if (ctype_alpha($b[$i]))
				return 1;
			if (is_numeric($b[$i]) && $a[$i] != $b[$i])
				return ($a[$i] < $b[$i]) ? 0 : 1;
			else if (!is_numeric($b[$i]))
				return 0;
		}
		else
		{
			if (ctype_alpha($b[$i]) || is_numeric($b[$i]))
				return 1;
			if ($a[$i] > $b[$i])
				return 1;
		}
	}
	if (!$a[$i] && $b[$i])
		return 0;
	return 0;
}

function ft_strsplit($str)
{
	$array = array_values(array_filter(explode(" ", $str)));
	return($array);
}

$i = 0;
$arr = array();
if ($argc >= 2)
{
	while (++$i < count($argv))
	{
		$splitted = ft_strsplit($argv[$i]);
		$arr = array_merge($arr, $splitted);
	}
	usort($arr, 'ft_order');
	$x = 0;
	while ($x < count($arr))
	{
		print "$arr[$x]\n";
		$x++;
	}
}
?>
