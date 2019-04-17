#!/usr/bin/php
<?PHP
date_default_timezone_set('America/Los_Angeles');
$file = fopen("/var/run/utmpx", "r");
$un_data = [];
while ($data = fread($file, 628))
{
	$data = unpack("a256user/a4id/a32line/ipid/itype/itime/a256host/i16pad", $data);
	if ($data['type'] == 7)
		$un_data[] = $data;
}
sort($un_data);
$i = 0;
while ($i < count($un_data))
{
	echo ($un_data[$i]['user'] . "  ");
	echo ($un_data[$i]['line'] . "  ");
	echo (date("M d H:i", $un_data[$i]['time']). "\n");
	$i++;
}
?>
