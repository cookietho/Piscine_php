#!/usr/bin/php
<?PHP
if ($argc >= 2)
{
	$file = file_get_contents($argv[1]);
	$string = $file;
	preg_match_all("/<a(.*)a>/", $string, $array1);
	$y = 0;
	while ($y < count($array1[0]))
	{
		preg_match("/\"(.*)\"/U", $array1[0][$y], $sub_array1);
		$new_sub_array1[$y] = strtoupper($sub_array1[0]);
		$new_sub_array1[$y] = str_replace($sub_array1[0], $new_sub_array1[$y], $array1[0][$y]);
		$string = str_replace($array1[0][$y], $new_sub_array1[$y], $string);
		$y++;
	}
	preg_match_all("/<a(.*)a>/U", $string, $array1);
	$y = 0;
	while ($y < count($array1[0]))
	{
		preg_match("/>(.*)</U", $array1[0][$y], $sub_array2);
		$new_sub_array1[$y] = strtoupper($sub_array2[0]);
		$new_sub_array1[$y] = str_replace($sub_array2[0], $new_sub_array1[$y], $array1[0][$y]);
		$string = str_replace($array1[0][$y], $new_sub_array1[$y], $string);
		$y++;
	}
	echo $string;
}
?>
