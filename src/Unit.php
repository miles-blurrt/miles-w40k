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
	
   
    
    public function getModels()
    {
	    return($this->ModelArray);
    }
    
    public function getWeaponSkill()
    {
	    // @TODO: Resolve to the most common WS in the unit
		$this->ModelArray[0]->getWeaponSkill();
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
