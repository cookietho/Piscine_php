<?PHP

Class Tyrion extends Lannister {

	function sleepWith($who) {
		if ($who instanceof Sansa) {
			print("Let's do this." . PHP_EOL);
		} else {
			print("Not even if I'm drunk !" . PHP_EOL);
		}
	}
}

?>
