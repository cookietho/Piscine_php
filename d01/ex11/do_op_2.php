#!/usr/bin/php
<?PHP
if ($argc != 2)
{
	print "Incorrect Parameters\n";
	exit();
}
if ($argc == 2)
{
	if (strpos($argv[1], "+") == true)
		$arr = explode("+", $argv[1]);
	else if (strpos($argv[1], "-") == true)
		$arr = explode("-", $argv[1]);
	else if (strpos($argv[1], "*") == true)
		$arr = explode("*", $argv[1]);
	else if (strpos($argv[1], "/") == true)
		$arr = explode("/", $argv[1]);
	else if (strpos($argv[1], "%") == true)
		$arr = explode("%", $argv[1]);
	else
	{
		print "Syntax Error\n";
		exit();
	}
	if (sizeof($arr) == 2)
	{
		if (ctype_digit(trim($arr[0], ' \s\t')) == true && ctype_digit(trim($arr[1], ' \s\t')) == true)
		{
			if (strpos($argv[1], '+') == true)
				$value = intval($arr[0]) + intval($arr[1]);
			if (strpos($argv[1], '-') == true)
				$value = intval($arr[0]) - intval($arr[1]);
			if (strpos($argv[1], '*') == true)
				$value = intval($arr[0]) * intval($arr[1]);
			if (strpos($argv[1], '/') == true)
				$value = intval($arr[0]) / intval($arr[1]);
			if (strpos($argv[1], '%') == true)
				$value = intval($arr[0]) % intval($arr[1]);
			print "$value\n";
		}
		else
		{
			print "Syntax Error\n";
			exit();
		}
	}
	else
	{
		print "Syntax Error\n";
		exit();
	}
}
?>
