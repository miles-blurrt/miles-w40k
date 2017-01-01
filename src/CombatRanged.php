<?php

class CombatRanged extends Combat
{
	private $hasBSExtraShot = false;
	private $usedBSExtraShot = false;
	private $extraShotMode = false;
	
		
	
	function __construct($FiringUnit, $FiringWeapon, $TargetUnit, $RollingDice=null)
    {
	    $this->FiringUnit = $FiringUnit;
		$this->FiringWeapon = $FiringWeapon;
		$this->TargetUnit = $TargetUnit;
	    
	    if($this->FiringUnit->getUnitBallisticSkill()>=6)
	    	$this->hasBSExtraShot = true;
	    	
	    if($RollingDice==null)
			$this->RollingDice = new RollingDice();
		else
			$this->RollingDice = $RollingDice;
    }
    
    public function resolveShooting()
    {
	    $totalShots = $this->getWeaponShotCount();
	    $hitResult = $this->getHitResults($totalShots);
	    $totalWounds = $this->getWoundsCount($hitResult['hits']);
	    $totalSaves = $this->getSavesCount($totalWounds);
	    $unsavedWounds = $totalWounds - $totalSaves;
	    
	    if($unsavedWounds<0)
	    	$unsavedWounds = 0;
	    
	    $this->result['enemy_wounds'] = $unsavedWounds;
	}
	
	

	public function getHitResults($totalAttempts)
	{
		$shootingResult = 
	    [
		    'extra_shots' => 0,
		    'hits' => 0,		    
		    'misses' => 0
	    ];
	    
        foreach($this->RollingDice->getRolls($totalAttempts) as $thisRoll)
        {
	        $shootingResult[$this->getShotResult($thisRoll)]++;;
        }
        
        return($shootingResult);
        
	}

	public function shotHits($roll,$modelBallisticSkill)
	{
		if($roll==1)
			return(false);
		
		if($this->hasBSExtraShot && !($this->usedBSExtraShot))
			$minRollRequired = 2;
		else
		{
			if($this->extraShotMode)
				$modelBallisticSkill -= 5;
				
			$minRollRequired = 7 - $modelBallisticSkill;
			
		}
		
		if($minRollRequired<2)
			$minRollRequired = 2;
					
		return($roll>=$minRollRequired);
	}
	
	public function getShotResult()
	{
		$rollResult = $this->RollingDice->getRoll();
		
		if($this->shotHits($rollResult,$this->FiringUnit->getUnitBallisticSkill()))
			return('hit');
		
		if($this->hasBSExtraShot && !($this->usedBSExtraShot))
		{
			$this->usedBSExtraShot = true;
			$this->extraShotMode = true;
			return('extra_shot');
		}
		
		return('miss');
	}
	
	
	public function getOverwatchShotCount()
	{
		$shotCount = 0;
		foreach($this->FiringUnit->getModels() as $Model)
		{
			if($Model->canOverwatchUnit($TargetUnit))
			{
				$shotCount+=$Model->getOverwatchShotCount();
			}
		}

	    return($shotCount);
	}
	
	public function getWeaponShotCount()
    {
	    $shotCount = 0;
	    foreach($this->getModelsCanShoot() as $Model)
	    {
		    $shotCount+=$Model->getWeaponShotCount($FiringWeapon,$TargetUnit);
	    }
	    
	    return($shotCount);
    }
    
    public function getModelsCanShoot()
    {
	    $Models = [];
	    foreach($this->getModels() as $Model)
	    {
		    if($Model->hasWeapon($FiringWeapon))
		    	$Models[] = $Model;
	    }
	    
	    return($Models);
    }
    
    
	
}
