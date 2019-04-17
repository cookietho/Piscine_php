#!/usr/bin/php
<?PHP
while (1)
{
	echo ("Enter a number: ");
	$nbr = trim(fgets(STDIN));
	if (feof(STDIN))
	{
		echo ("\n");
		exit();
	}
	if (is_numeric($nbr))
	{
		if ($nbr % 2 == 0)
			print "The number $nbr is even\n";
		else
			print "The number $nbr is odd\n";
	}
	else
		print "'$nbr' is not a number\n";
}
?>
