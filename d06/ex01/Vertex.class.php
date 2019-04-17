<?PHP

require_once '../ex00/Color.class.php';

Class Vertex {

	private $_x;
	private $_y;
	private $_z;
	private $_w = 1;
	private $_color;
	public static $verbose = False;

	function __toString() {
		$str = sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f", $this->getX(), $this->getY(), $this->getZ(), $this->getW());
		if (self::$verbose === TRUE) {
			$str = $str . ", " . $this->_color;
		}
		$str = $str . " )";
		return $str;
	}

	function __construct($ver_arr) {
		$this->_x = $ver_arr['x'];
		$this->_y = $ver_arr['y'];
		$this->_z = $ver_arr['z'];

		if (isset($ver_arr['w']) && !empty($ver_arr['w']))
			$this->_w = $ver_arr['w'];
		if (isset($ver_arr['color']) && !empty($ver_arr['color'])) {
			$this->_color = $ver_arr['color'];
		}
		else {
			$this->_color = new Color(array('red' => 255, 'green' => 255, 'blue' => 255));
		}
		if (Vertex::$verbose == TRUE)
			printf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, Color ( red: %3d, green: %3d, blue: %3d ) ) constructed\n", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue);
	}

	function __destruct() {
		if (Vertex::$verbose == TRUE)
			printf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, Color ( red: %3d, green: %3d, blue: %3d ) ) destructed\n", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue);
	}

	public static function doc() {
		return file_get_contents("Vertex.doc.txt");
	}

	public function getX()
	{
		return $this->_x;
	}

	public function getY()
	{
		return $this->_y;
	}

	public function getZ()
	{
		return $this->_z;
	}
	public function getW()
	{
		return $this->_w;
	}

}

?>
