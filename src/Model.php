<?php

class Model
{
	private $ballisticSkill = 0;
	private $weaponSkill = 0;
	private $leadership = 0;
	private $aliveCount = 0;
	private $WeaponsArray = [];
	private $coordinates = ['x'=>0,'y'=>0,'z'=>0];
	private $hitPoints = 0;
	private $overwatchUsedThisTurn = false;
	
	public function __construct(array $WeaponsArray=[])
	{
		$this->setWeapons($WeaponsArray);
	}
	
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
	
	public function canOverwatchUnit($TargetUnit)
	{
		if($this->overwatchUsedThisTurn(true)==false)
			return(false);
			
		$Weapon = $this->getPrimaryWeapon();
		if($Weapon->canSnapFire())
		{
			$this->setOverwatchUsedThisTurn(true);
			return(true);
		}
	}
	
	public function overwatchUsedThisTurn()
	{
		return($this->overwatchUsedThisTurn);
	}
	
	public function setOverwatchUsedThisTurn($value)
	{
		$this->overwatchUsedThisTurn = $value;
	}
	public function getPrimaryWeapon()
	{
		return($this->WeaponsArray[0]);
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
	
	public function getWeaponSkill()
	{
		return($this->weaponSkill);
	}
	
	public function getLeadership()
	{
		return($this->leadership);
	}
	
	public function hasWeapon(Weapon $Weapon)
	{
		return(isset($WeaponsArray[$Weapon->getID()]));
	}
	
	
	public function setWeapons(array $WeaponsArray=[])
	{
		$PrimaryWeapon = Weapon::getPrimary($WeaponsArray);
		foreach($WeaponsArray as $index=>$thisWeapon)
		{
			$this->WeaponsArray = $WeaponsArray[$index];
			
			if($PrimaryWeapon==$thisWeapon)
				$this->PrimaryWeapon = &$this->WeaponsArray[$index];
		}
		
		
		
	}
	
	
	
}
