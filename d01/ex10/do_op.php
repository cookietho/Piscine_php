#!/usr/bin/php
<?PHP
if ($argc != 4)
{
	print "Incorrect Parameters\n";
}
if ($argc == 4)
{
	if (trim($argv[2], ' \s\t') == '+')
		$value = (intval(trim($argv[1], ' \s\t')) + intval(trim($argv[3], ' \s\t')));
	else if (trim($argv[2], ' \s\t') == '-')
		$value = (intval(trim($argv[1], ' \s\t')) - intval(trim($argv[3], ' \s\t')));
	else if (trim($argv[2], ' \s\t') == '*')
		$value = (intval(trim($argv[1], ' \s\t')) * intval(trim($argv[3], ' \s\t')));
	else if (trim($argv[2], ' \s\t') == '/')
		$value = (intval(trim($argv[1], ' \s\t')) / intval(trim($argv[3], ' \s\t')));
	else if (trim($argv[2], ' \s\t') == '%')
		$value = (intval(trim($argv[1], ' \s\t')) % intval(trim($argv[3], ' \s\t')));
	print "$value\n";
}
?>
