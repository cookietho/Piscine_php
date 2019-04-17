<?PHP
function ft_split($arg)
{
	$array = explode(" ", $arg);
	sort($array);
	return(array_values(array_filter($array)));
}
?>
