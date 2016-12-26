<?php

abstract class Weapon
{
	private $id = "";
	private $strength = 0;
	private $maxDistance;
	private $shotsCount = 0;
	
	public function getStrength()
	{
		return($this->strength);
	}
	
	public function getShotsCount($distance)
	{
		if($distance<=$this->maxDistance)
			return($this->shotsCount);
	}
	
	public function getID()
	{
		return($this->id);
	}
	
	public function getAP()
	{
		return($this->ap);
	}
}
