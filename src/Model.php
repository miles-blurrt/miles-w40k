<?php

class Model
{
	private $ballisticSkill = 0;
	private $leadership = 0;
	private $aliveCount = 0;
	private $WeaponsArray = [];
	private $coordinates = ['x'=>0,'y'=>0,'z'=>0];
	private $hitPoints = 0;
	
	public function getHitPointsRemaining()
	{
		return($this->hitPoints);
	}
	
	public function getCooridinates()
	{
		return($this->coordinates);
	}
	
	public function setCoordinates($coordinates)
	{
		$this->coordinates = $coordinates;
	}
	
	public function getWeaponShotCount($FiringWeapon,$TargetUnit)
	{
		$distance = $this->getDistance($this,$TargetUnit);
		
		return($FiringWeapon->getShotsCount($distance));
	}
	
	public function getDistance(Model $ModelB)
	{
		$ModelACoords = $this->getCooridinates();
		$ModelBCoords = $ModelB->getCooridinates();
		$xDistance = $ModelACoords['x']-$ModelBCoords['x'];
		$yDistance = $ModelACoords['y']-$ModelBCoords['y'];
		$zDistance = $ModelACoords['z']-$ModelBCoords['z'];
		
		$xDistance = $xDistance * $xDistance;
		$yDistance = $yDistance * $yDistance;
		$zDistance = $zDistance * $zDistance;
		
		$distance = sqrt($xDistance + $yDistance + $zDistance);
		
		return($distance);
	}
	
	public function getBallisticSkill()
	{
		return($this->ballisticSkill);
	}
	
	public function getLeadership()
	{
		return($this->leadership);
	}
	
	public function hasWeapon(Weapon $Weapon)
	{
		return(isset($WeaponsArray[$Weapon->getID()]));
	}
	
	
}
