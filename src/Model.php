<?php

abstract class Model
{
	private $ballisticSkill = 0;
	private $aliveCount = 0;
	private $WeaponsArray = [];
	
	public function setAliveCount($aliveCount)
	{
		$this->aliveCount = $aliveCount;
	}
	
	public function getAliveCount()
	{
		return($this->aliveCount);
	}
	
	public function getWeaponShotCount($FiringWeapon,$TargetUnit)
	{
		$distance = $this->getDistance($this,$TargetUnit);
		
		return($FiringWeapon->getShotsCount($distance));
	}
	
	public function getDistance(Model $ModelA, Model $ModelB)
	{
		return(5);	
	}
	
	public function getBallisticSkill()
	{
		return($this->ballisticSkill);
	}
	
	public function hasWeapon(Weapon $Weapon)
	{
		return(isset($WeaponsArray[$Weapon->getID()]));
	}
	
	
}
