<?PHP

require_once('../ex02/Vector.class.php');

class Matrix
{
	const IDENTITY = 1;
	const SCALE = 2;
	const RX = 3;
	const RY = 4;
	const RZ = 5;
	const TRANSLATION = 6;
	const PROJECTION = 7;
	public $matrix;
	private $type;
	public static $verbose = FALSE;

	public function __construct(array $kwargs)
	{
		for ($i = 0; $i < 4; $i++) {
			for ($j = 0; $j < 4; $j++) {
				$this->matrix[$i][$j] = 0;
			}
		}
		if (array_key_exists('preset', $kwargs)) {
			if ($kwargs['preset'] == self::IDENTITY) {
				$this->createIdentity();
				$this->type = "IDENTITY";
			}
			else if ($kwargs['preset'] == self::SCALE) {
				if (array_key_exists('scale', $kwargs)) {
					$this->createScale($kwargs['scale']);
					$this->type = "SCALE preset";
				}
			} else if ($kwargs['preset'] == self::RX || $kwargs['preset'] == self::RY || $kwargs['preset'] == self::RZ) {
				if (array_key_exists('angle', $kwargs)) {
					$this->createIdentity();
					$this->createRotation($kwargs['angle'], $kwargs['preset']);
				}
			} else if ($kwargs['preset'] == self::TRANSLATION) {
				if (array_key_exists('vtc', $kwargs)) {
					$this->type = "TRANSLATION preset";
					$this->createIdentity();
					$this->createTranslation($kwargs['vtc']);
				}
			} else if ($kwargs['preset'] == self::PROJECTION) {
				if (array_key_exists('fov', $kwargs) && array_key_exists('ratio', $kwargs) && array_key_exists('near', $kwargs) && array_key_exists('far', $kwargs)) {
					$this->type = "PROJECTION preset";
					$this->createProjection($kwargs['fov'], $kwargs['ratio'], $kwargs['near'], $kwargs['far']);
				}
			}
		}
		if (self::$verbose === TRUE) {
			print ("Matrix ". $this->type ." instance constructed" . PHP_EOL);
		}
	}

	public function __destruct()
	{
		if (self::$verbose === TRUE) {
			print ("Matrix instance destructed". PHP_EOL);
		}
	}

	private function createIdentity() {
		$this->matrix[0][0] = 1;
		$this->matrix[1][1] = 1;
		$this->matrix[2][2] = 1;
		$this->matrix[3][3] = 1;
	}

	private function createScale($factor)
	{
		$this->matrix[0][0] = floatval($factor);
		$this->matrix[1][1] = floatval($factor);
		$this->matrix[2][2] = floatval($factor);
		$this->matrix[3][3] = 1.0;
	}

	private function createRotation($angle, $preset)
	{
		$a = floatval($angle);
		if ($preset == self::RX) {
			$this->type = "Ox ROTATION preset";
			$this->matrix[0][0] = 1.0;
			$this->matrix[1][1] = cos($a);
			$this->matrix[1][2] = -sin($a);
			$this->matrix[2][1] = sin($a);
			$this->matrix[2][2] = cos($a);
		} else if ($preset == self::RY) {
			$this->type = "Oy ROTATION preset";
			$this->matrix[0][0] = cos($a);
			$this->matrix[0][2] = sin($a);
			$this->matrix[1][1] = 1;
			$this->matrix[2][0] = -sin($a);
			$this->matrix[2][2] = cos($a);
		} else if ($preset == self::RZ) {
			$this->type = "Oz ROTATION preset";
			$this->matrix[0][0] = cos($a);
			$this->matrix[0][1] = -sin($a);
			$this->matrix[1][0] = sin($a);
			$this->matrix[1][1] = cos($a);
			$this->matrix[2][2] = 1;
		}
	}

	private function createTranslation(Vector $v) {
		$this->matrix[0][3] = $v->getX();
		$this->matrix[1][3] = $v->getY();
		$this->matrix[2][3] = $v->getZ();
		$this->matrix[3][3] = 1;
	}

	private function createProjection($fov, $ratio, $n, $far) {
		$scale = tan($fov * 0.5 * M_PI / 180) * $n;
        $r = $ratio * $scale;
		$l = -$r;
        $t = $scale;
		$b = -$t;

		$this->matrix[0][0] = (2 * $n) / ($r - $l);
		$this->matrix[0][2] = ($r + $l) / ($r - $l);
		$this->matrix[1][1] = (2 * $n) / ($t - $b);
		$this->matrix[1][2] = ($t + $b) / ($t - $b);
		$this->matrix[2][2] = - (($far + $n) / ($far - $n));
		$this->matrix[2][3] = - ((2 * $far * $n) / ($far - $n));
		$this->matrix[3][2] = -1;

	}

	public function __toString()
	{
		$str = "M | vtcX | vtcY | vtcZ | vtxO" . PHP_EOL;
		$str .= "-----------------------------" . PHP_EOL;
		$str .= sprintf("x | %.2f | %.2f | %.2f | %.2f" . PHP_EOL, $this->matrix[0][0], $this->matrix[0][1], $this->matrix[0][2],$this->matrix[0][3]);
		$str .= sprintf("y | %.2f | %.2f | %.2f | %.2f" . PHP_EOL, $this->matrix[1][0], $this->matrix[1][1], $this->matrix[1][2],$this->matrix[1][3]);
		$str .= sprintf("z | %.2f | %.2f | %.2f | %.2f" . PHP_EOL, $this->matrix[2][0], $this->matrix[2][1], $this->matrix[2][2],$this->matrix[2][3]);
		$str .= sprintf("w | %.2f | %.2f | %.2f | %.2f", $this->matrix[3][0], $this->matrix[3][1], $this->matrix[3][2],$this->matrix[3][3]);
		return ($str);
	}

	public static function doc()
	{
		if (file_exists("Matrix.doc.txt")) {
			return (file_get_contents("Matrix.doc.txt") . PHP_EOL);
		}
	}

	public function getValueAt($x, $y) {
		if ($x < 4 && $x >= 0 && $y < 4 && $y >= 0) {
			return ($this->matrix[$x][$y]);
		}
		return (NAN);
	}

	public function mult(Matrix $rhs) {
		self::$verbose = FALSE;
		$ret = new Matrix(array());
		self::$verbose = TRUE;
		for($i = 0; $i < 4; ++$i) {
			for ($j = 0; $j < 4; ++$j) {
				for ($k = 0; $k < 4; ++$k) {
					$ret->matrix[$i][$j] += $this->matrix[$i][$k] * $rhs->getValueAt($k, $j);
				}
			}
		}
		return $ret;
	}

	public function transformVertex(Vertex $vtx) {
		$x = ($this->matrix[0][0] * $vtx->getX() +
			$this->matrix[0][1] * $vtx->getY() +
			$this->matrix[0][2] * $vtx->getZ() +
			$this->matrix[0][3] * $vtx->getW());
		$y = ($this->matrix[1][0] * $vtx->getX() +
			$this->matrix[1][1] * $vtx->getY() +
			$this->matrix[1][2] * $vtx->getZ() +
			$this->matrix[1][3] * $vtx->getW());
		$z = ($this->matrix[2][0] * $vtx->getX() +
			$this->matrix[2][1] * $vtx->getY() +
			$this->matrix[2][2] * $vtx->getZ() +
			$this->matrix[2][3] * $vtx->getW());
		$w = ($this->matrix[3][0] * $vtx->getX() +
			$this->matrix[3][1] * $vtx->getY() +
			$this->matrix[3][2] * $vtx->getZ() +
			$this->matrix[3][3] * $vtx->getW());
		return (new Vertex( array( 'x' => $x, 'y' => $y, 'z' => $z, 'w' => $w ) ) );
	}
}

?>
