<?php

class Unit
{
	private $ModelArray = [];
	
	public function __construct(array $ModelArray=null,$RollingDice=null)
	{
		$this->ModelArray = $ModelArray;
		
		if($RollingDice==null)
			$this->RollingDice = new RollingDice();
		else
			$this->RollingDice = $RollingDice;
		
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
	    return($this->ModelArray);
    }
    
    public function getWeaponShotCount($FiringWeapon,$TargetUnit)
    {
	    $shotCount = 0;
	    foreach($this->getModelsCanShoot($FiringWeapon, $TargetUnit) as $Model)
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
	
	public function getUnitLeadership()
	{
		// @TODO: Resolve to the highest leadership in the unit
		$highestLeadership = 0;
		foreach($this->ModelArray as $Model)
		{
			$modelLeadership = $Model->getLeadership();	
			if($modelLeadership>$highestLeadership)
				$highestLeadership = $modelLeadership;
		}
		
		return($modelLeadership);
	}
	
	public function passesLeadershipTest()
	{
		$roll = $this->RollingDice->getRoll(12);
		if($roll<=$this->getUnitLeadership())
			return(true);
		else
			return(false);
	}
	
	
	public function getOverwatchShotCount($TargetUnit)
	{
		$shotCount = 0;
		foreach($this->ModelArray as $Model)
		{
			if($Model->canOverwatchUnit($TargetUnit))
				$shotCount++;
		}
		
	    
	    return($shotCount);
	}
	
	public function minDistance($TargetUnit)
	{
		$minDistance = 100;
		foreach($this->getModels() as $thisModel)
		{
			foreach($TargetUnit->getModels() as $targetmodel)
			{
				if($thisModel->getDistance($targetmodel) < $minDistance)
					$minDistance = $minDistance;
			}
		}
		
		return($minDistance);
	}
	
	public function advanceToBaseContact($TargetUnit,$distance)
	{
		
	}
	
	
}
