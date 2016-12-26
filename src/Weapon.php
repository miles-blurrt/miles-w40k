<?php

abstract class Weapon
{
	private $strength = 0;
	
	public function getStrength()
	{
		return($this->strength);
	}
	
	public function getAP()
	{
		return($this->ap);
	}
}
