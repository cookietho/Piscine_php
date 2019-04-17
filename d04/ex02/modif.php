<?PHP
if ($_POST['submit'] != "OK" || !$_POST['login'] || !$_POST['oldpw'] || !$_POST['newpw'])
{
	echo "ERROR\n";
	exit();
}
if (!file_exists("../private") || !file_exists("../private/passwd"))
{
	echo "ERROR\n";
	exit();
}
$re_user['login'] = $_POST['login'];
$re_user['oldpw'] = hash('whirlpool', $_POST['oldpw']);
$re_user['newpw'] = hash('whirlpool', $_POST['newpw']);
if (file_exists("../private/passwd"))
{
	$user = unserialize(file_get_contents("../private/passwd"));
	if ($user)
	{
		foreach ($user as $key => $value)
		{
			if ($value['login'] == $re_user['login'] && $value['passwd'] == $re_user['oldpw'])
			{
				if ($re_user['newpw'] != $re_user['oldpw'])
					$user[$key]['passwd'] = $re_user['newpw'];
				file_put_contents("../private/passwd", serialize($user));
				echo "OK\n";
				exit();
			}
		}
	}
}
echo "ERROR\n";
exit();
?>
