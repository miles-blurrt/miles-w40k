<?php

class Weapon
{
	private $id = "";
	private $strength = 0;
	private $maxDistance;
	private $shotsCount = 0;
	private $canSnapFire = false;
	private $priorityRanking = 0;
	private $overwatchShotCount = 1;
	private $ap = 0;
	var $closeCombat = false;
	
	
	public function getOverwatchShotCount()
	{
		return($this->overwatchShotCount);
	}
	
	public function __construct($buildParams=[])
	{
		foreach($buildParams as $param=>$value)
		{
			$this->{$param} = $value;
		}
	}
	
	public function isCloseCombat()
	{
		return($this->closeCombat);
	}
	public function getStrength()
	{
		return($this->strength);
	}
	
	
	public function getPriority()
	{
		return($this->priorityRanking);
	}
	
	public function setPriority($priority)
	{
		$this->priorityRanking = $priority;
	}
	
	
	public function getShotsCount($distance)
	{
		if($distance<=$this->maxDistance)
			return($this->shotsCount);
	}
	
	public function canSnapFire()
	{
		return($this->canSnapFire);
	}
	
	public function getID()
	{
		return($this->id);
	}
	
	public function getAP()
	{
		return($this->ap);
	}
	
	public function getInitativeOverride()
	{
		return(false);	
	}
	
	static function getPrimary($WeaponsArray)
	{
		$highestPriority = 0;
		$PriorityWeapon = null;
		
		foreach($WeaponsArray as $thisWeapon)
		{
			if($thisWeapon->getPriority()>$highestPriority)
			{
				$highestPriority = $thisWeapon->getPriority();
				$PriorityWeapon = $thisWeapon;
			}
		}
		
		return($PriorityWeapon);
	}
	
	static function getCloseCombatWeapon($WeaponsArray)
	{
		foreach($WeaponsArray as $thisWeapon)
		{
			if($thisWeapon->isCloseCombat())
			{
				return($thisWeapon);
			}
		}
		
	}
}
