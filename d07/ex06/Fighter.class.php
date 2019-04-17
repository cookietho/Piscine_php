<?PHP

    class Fighter
    {
        private $soldier;

        public function __construct($name)
        {
            $this->soldier = $name;
        }

        public function get_name()
        {
            return ($this->soldier);
        }
    }
?>
