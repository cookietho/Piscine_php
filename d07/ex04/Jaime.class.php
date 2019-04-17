<?PHP

Class Jaime extends Lannister {

	function sleepWith($who) {
		if ($who instanceof Tyrion) {
			print ("Not even if I'm drunk !" . PHP_EOL);
		} else if ($who instanceof Sansa) {
			print ("Let's do this." . PHP_EOL);
		} else {
			print ("With pleasure, but only in a tower in Winterfell, then." . PHP_EOL);
		}
	}
}

?>
