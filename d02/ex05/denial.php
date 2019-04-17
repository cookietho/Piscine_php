#!/usr/bin/php
<?PHP
if ($argc == 3 && file_exists($argv[1]) == true)
{
	$file = fopen($argv[1], "r");
	while ($file && !feof($file))
		$arr[] = explode(";", fgets($file));
	$header = $arr[0];
	unset($arr[0]);
	$arr = array_map('array_filter', $arr);
	$arr = array_filter($arr);
	for($n = 0; $n < count($header); $n++)
	{
		if ($header[$n] == "nom")
			$header[$n] = "last_name";
		if ($header[$n] == "prenom")
			$header[$n] = "name";
	}
	foreach ($header as $i => $value)
		$header[$i] = trim($value);
	$index = array_search($argv[2], $header);
	if ($index === false)
		exit();
	foreach ($header as $header_i => $header_value)
	{
		$tmp = array();
		foreach ($arr as $value)
		{
			if (isset($value[$index]))
				$tmp[trim($value[$index])] = trim($value[$header_i]);
		}
		$$header_value = $tmp;
	}
	$stdin = fopen("php://stdin", "r");
	while($stdin && !feof($stdin))
	{
		echo ("Enter your command: ");
		$command = fgets($stdin);
		eval($command);
	}
	fclose($stdin);
}
else
	exit();
?>
