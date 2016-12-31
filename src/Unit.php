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
    
    public function getUnitWeaponSkill()
    {
	    $weaponSkillCount = [];
	    foreach($this->getModels() as $Model)
	    {
		    $weaponSkill = $Model->getWeaponSkill();
		    if(!isset($weaponSkillCount[$weaponSkill]))
		    	$weaponSkillCount[$weaponSkill]=1;
		    else
		    	$weaponSkillCount[$weaponSkill]++;
	    }
		
		arsort($weaponSkillCount);
		reset($weaponSkillCount);
		$mostCommon = key($weaponSkillCount);
		
		return($mostCommon);
    }
	
	public function getUnitBallisticSkill()
	{
		$ballisticSkillCount = [];
	    foreach($this->getModels() as $Model)
	    {
		    $ballisticSkill = $Model->getBallisticSkill();
		    if(!isset($ballisticSkillCount[$ballisticSkill]))
		    	$ballisticSkillCount[$ballisticSkill]=1;
		    else
		    	$ballisticSkillCount[$ballisticSkill]++;
		}
		
		arsort($ballisticSkillCount);
		reset($ballisticSkillCount);
		$mostCommon = key($ballisticSkillCount);
		
		return($mostCommon);
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
