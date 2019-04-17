<?PHP

include_once('IFighter.class.php');

Class NightsWatch {
	private $var = array();

	public function __construct() {
		$this->var = array();
	}

	public function recruit($who) {
		if ($who instanceof IFighter) {
			array_push($this->var, $who);
		}
	}

	public function fight() {
		foreach ($this->var as $who) {
			$who->fight();
		}
	}
}
?>
