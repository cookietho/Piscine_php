<?PHP
function ft_is_sort($arr)
{
	$des = $arr;
	sort($des);
	if ($des == $arr)
		return (true);
	else
		return (false);
}
?>
