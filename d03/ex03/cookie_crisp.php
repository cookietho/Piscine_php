<?PHP
switch ($_GET['action'])
{
case ("set"):
	if ($_GET['name'] && $_GET['value'])
	{
		setcookie($_GET['name'], $_GET['value'], time() + 86400);
		exit ();
	}
case ("get"):
	if ($_GET['name'] && $_COOKIE[$_GET['name']])
	{
		echo ($_COOKIE[$_GET['name']]."\n");
		exit ();
	}
case ("del"):
	if ($_GET['name'] && !$_GET['value'])
	{
		setcookie($_GET['name'], "", 1);
		exit ();
	}
}
?>
