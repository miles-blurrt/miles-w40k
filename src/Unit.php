<?php

class Unit
{
	private $ModelArray = [];
	private $DeadModelArray = [];
	private $hasEngagedCloseCombatThisTurn = false;
	private $id;
	private $chargingDistance;
	
	public function __construct(array $ModelArray=null,$RollingDice=null)
	{
		$this->ModelArray = $ModelArray;
		
		if($RollingDice==null)
			$this->RollingDice = new RollingDice();
		else
			$this->RollingDice = $RollingDice;
		
		$this->id = spl_object_hash($this);
	}
	
	public function isVehicleUnit()
	{
		return($this->ModelArray[0]->isVehicle());
	}
	
	public function getId()
	{
		return($this->id);
	}
	
	public function setCloseCombatEngagedThisTurn()
	{
		$this->hasEngagedCloseCombatThisTurn = true;
	}
	
	public function hasCloseCombatEngagedThisTurn()
	{
		return($this->hasEngagedCloseCombatThisTurn);
	}
	
	public function setChargingDistance($distance)
	{
		$this->chargingDistance = $distance;
	}
    
    public function getChargingDistance()
	{
		return($this->chargingDistance);
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
	
	public function getUnitToughnessLevel()
	{
		$toughnessLevelCount = [];
	    foreach($this->getModels() as $Model)
	    {
		    $toughnessLevel = $Model->getToughnessLevel();
		    if(!isset($toughnessLevelCount[$toughnessLevel]))
		    	$toughnessLevelCount[$toughnessLevel]=1;
		    else
		    	$toughnessLevelCount[$toughnessLevel]++;
		}
		
		arsort($toughnessLevelCount);
		reset($toughnessLevelCount);
		$mostCommon = key($toughnessLevelCount);
		
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
	
	public function getUnitStrength()
	{
		$strengthCount = [];
	    foreach($this->getModels() as $Model)
	    {
		    $strength = $Model->getStrength();
		    if(!isset($strengthCount[$strength]))
		    	$strengthCount[$strength]=1;
		    else
		    	$strengthCount[$strength]++;
		}
		
		arsort($strengthCount);
		reset($strengthCount);
		$mostCommon = key($strengthCount);
		
		return($mostCommon);
	}
	
	public function getUnitArmourSave()
	{
		$armourSaveCount = [];
	    foreach($this->getModels() as $Model)
	    {
		    $armourSave = $Model->getArmourSave();
		    if(!isset($armourSaveCount[$armourSave]))
		    	$armourSaveCount[$armourSave]=1;
		    else
		    	$armourSaveCount[$armourSave]++;
		}
		
		arsort($armourSaveCount);
		reset($armourSaveCount);
		$mostCommon = key($armourSaveCount);
		
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
	
	public function advanceUnitToBaseContact($TargetUnit,$distance)
	{
		foreach($this->getModels() as $thisModel)
		{
			$thisModel->advanceToBaseContact($TargetUnit);
		}
	}
	
	public function getModelsAtCloseCombatinitiativeStep($initiativeStep)
	{
		$matchingModels = [];
		foreach($this->getModels() as $thisModel)
		{
			if($thisModel->getCloseCombatinitiativeLevel()==$initiativeStep)
				$matchingModels[]=&$thisModel;
		}
		
		return($matchingModels);
	}
	
}
