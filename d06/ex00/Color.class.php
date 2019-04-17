<?PHP

Class Color {

	public $red;
	public $green;
	public $blue;
	public static $verbose = False;

	function __toString() {
		return(sprintf("Color( red: %3d, green: %3d, blue: %3d )", $this->red, $this->green, $this->blue));
	}

	function __construct($arr_color) {
		if (isset($arr_color['red']) && isset($arr_color['green']) && isset($arr_color['blue']))
		{
			$this->red = intval($arr_color['red']);
			$this->green = intval($arr_color['green']);
			$this->blue = intval($arr_color['blue']);
		}
		else if (isset($arr_color['rgb']))
		{
			$rgb = ($arr_color['rgb']);
			list($this->red, $this->green, $this->blue) = sscanf($rgb, "#%02x%02x%02x");
		}
		if (Color::$verbose == TRUE)
			printf("Color( red: %3d, green: %3d, blue: %3d ) constructed.\n", $this->red, $this->green, $this->blue);
	}

	function __destruct() {
		if (Color::$verbose == TRUE)
			printf("Color( red: %3d, green: %3d, blue: %3d ) destructed.\n", $this->red, $this->green, $this->blue);
	}

	public static function doc() {
	return file_get_contents("Color.doc.txt");
	}

	function add($arr_color) {
		return (new Color(array('red'=>$this->red + $arr_color->red, 'green'=>$this->green + $arr_color->green, 'blue'=>$this->blue + $arr_color->blue)));
	}

	function sub($arr_color) {
		return (new Color(array('red'=>$this->red - $arr_color->red, 'green'=>$this->green - $arr_color->green, 'blue'=>$this->blue - $arr_color->blue)));
	}

	function mult($what) {
		return (new Color(array('red'=>$this->red * $what, 'green'=>$this->green * $what, 'blue'=>$this->blue * $what)));
	}
}
?>
