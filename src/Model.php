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
	private $initiativeLevel = 10;
	private $toughnessLevel = 0;
	private $closeCombatAttackCount = 0;
	private $strength = 0;
	private $armourSave = 0;
	private $baseSize = 0;
	private $baseType = '';
	private $movementDistance = 0;		
	private $currentMovementState = 'none';
	private $isVehicle = false;
	
	private $inBaseContact = false;
	
	public function __construct($params = [], array $WeaponsArray=[])
	{
		$this->setWeapons($WeaponsArray);
		foreach($params as $thisParam=>$value)
			$this->{$thisParam} = $value;
	}
	
	public function isVehicle()
	{
		return($this->isVehicle);
	}
	
	public function getCurrentMovementState()
	{
		return($this->currentMovementState);
	}
	
	public function getToughness()
	{
		return($this->toughness);
	}
	
	public function getArmourSave()
	{
		return($this->armourSave);
	}
	
	public function getBaseSize()
	{
		return($this->baseSize);
	}
	public function getMovementDistance()
	{
		return($this->movementDistance);
	}
	public function advanceToBaseContact(Unit $TargetUnit)
	{
		// @TODO: Do properly
		$this->inBaseContact = true;
	}
	
	public function inBaseContact()
	{
		return($this->inBaseContact);
	}
	
	public function getHitPointsRemaining()
	{
		return($this->hitPoints);
	}
	
	public function getCooridinates()
	{
		return($this->coordinates);
	}
	
	public function getCloseCombatinitiativeLevel()
	{
		$Weapon = \Weapon::getCloseCombatWeapon($this->WeaponsArray);
		if($Weapon->getInitativeOverride())
			$this->initiativeLevel = $Weapon->getInitativeOverride();
			
		return($this->initiativeLevel);
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
	
	public function getCloseCombatAttackCount()
	{
		return($this->closeCombatAttackCount);
	}
	
	public function getCloseCombatWeaponAP()
	{
		$Weapon = \Weapon::getCloseCombatWeapon($this->WeaponsArray);
		return($Weapon->getAP());
	}
	
	public function getOverwatchShotCount()
	{
		$shotCount = 0;
		$Weapon = $this->getPrimaryWeapon();	
		if($Weapon->canSnapFire())
		{
			$shotCount+=$Weapon->getOverwatchShotCount();
		}
		return($shotCount);
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
		// @TODO: Fix
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
	
	public function getStrength()
	{
		return($this->strength);
	}
	
	public function getToughnessLevel()
	{
		return($this->toughnessLevel);
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
			$this->WeaponsArray[$index] = $WeaponsArray[$index];
			
			if($PrimaryWeapon==$thisWeapon)
				$this->PrimaryWeapon = &$this->WeaponsArray[$index];
		}
		
		
		
	}
	public function resolveCombatShot(CombatShot $CombatShot)
    {
	    if($this->shotHits($CombatShot->getRoll()))
			$CombatShot->addHit();
	    	    
	    return($CombatShot);
    }
    
    public function resolveCombatHit(CombatHit $CombatHit)
    {
	    if($this->causesWound($CombatHit->getWeaponStrength(),$CombatHit->getRoll()))
			$CombatHit->addWound();
	    	    
	    return($CombatHit);
    }
	
	
	
	
	
}
