<?PHP
if ($_POST['submit'] != "OK" || !$_POST['login'] || !$_POST['passwd'])
{
	echo "ERROR\n";
	exit();
}
if (!file_exists("../private") || !file_exists("../private/passwd"))
{
	mkdir("../private");
}
if (file_exists("../private/passwd"))
{
	$unseri_user = unserialize(file_get_contents("../private/passwd"));
	if ($unseri_user)
	{
		foreach ($unseri_user as $key => $value)
		{
			if ($value['login'] === $_POST['login'])
			{
				echo "ERROR\n";
				exit();
			}
		}
	}
}
$user['login'] = $_POST['login'];
$user['passwd'] = hash('whirlpool', $_POST['passwd']);
$unseri_user[] = $user;
file_put_contents("../private/passwd", serialize($unseri_user));
echo "OK\n";
?>
