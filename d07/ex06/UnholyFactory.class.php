<?PHP

	class UnholyFactory
	{
		private $soldierlist = array();

		public function absorb($type)
		{
		   if (get_parent_class($type) == "Fighter")
		   {
		  		if (array_key_exists($type->get_name(), $this->soldierlist))
					print("(Factory already absorbed a fighter of type " . $type->get_name() . ")" . PHP_EOL);
				else
				{
					print("(Factory absorbed a fighter of type " . $type->get_name() . ")" . PHP_EOL);
					$this->soldierlist[$type->get_name()] = $type;
				}
			}
			else
				print("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
		}
		public function fabricate($name)
		{
			if (array_key_exists($name, $this->soldierlist))
			{
				print("(Factory fabricates a fighter of type " . $name . ")" . PHP_EOL);
				return ($this->soldierlist[$name]);
			}
			else
			{
				print("(Factory hasn't absorbed any fighter of type " . $name . ")" . PHP_EOL);
            	return null;
			}
		}
	}
?>
