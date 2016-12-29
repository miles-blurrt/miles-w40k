<?php

class Unit
{
	private $ModelArray = [];
	
	public function __construct(array $ModelArray=null)
	{
		$this->ModelArray = $ModelArray;
		
	}
	
    public function getModelsCanShoot(Weapon $FiringWeapon, Unit $TargetUnit)
    {
	    $Models = [];
	    foreach($this->getModels() as $Model)
	    {
		    if($Model->hasWeapon($FiringWeapon))
		    	$Models[] = $Model;
	    }
	    
	    return($Models);
    }
    
    public function getModels()
    {
	    return($ModelArray);
    }
    
    public function getWeaponShotCount($FiringWeapon,$TargetUnit)
    {
	    $shotCount = 0;
	    foreach($this->FiringModels->getModelsCanShoot($FiringWeapon, $TargetUnit) as $Model)
	    {
		    $shotCount+=$Model->getWeaponShotCount($FiringWeapon,$TargetUnit);
	    }
	    
	    return($shotCount);
    }
	
	public function getUnitBallisticSkill()
	{
		// @TODO: Resolve to the most common BS in the unit
		$this->ModelArray[0]->getBallisticSkill();	
	}
	
}
