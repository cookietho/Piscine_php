#!/usr/bin/php
<?PHP
if ($argc == 2)
{
	$dir = strstr($argv[1], 'w');
	mkdir ($dir);
	$path =getcwd();
	$url = curl_init($argv[1]);
	$str = file_get_contents($argv[1]);
	preg_match_all("/<img src=\"(.*?)\/(.*?)g\"/", $str, $array);
	$url_array = [];
	$x = 0;
	while ($x < count($array[0]))
	{
		$url_array = $array[0];
		$x++;
	}
	$new_url_array = explode("<img src=", $url_array[0]);
	$new_url_array2 = explode("<img src=", $url_array[1]);
	preg_match('/\"(.*?)\"/', $new_url_array[1], $new_new_url_array);
	$img1 = file_get_contents($new_new_url_array[1]);
	file_put_contents("$path/$dir/42_logo_black.svg", $img1);
}
?>
