<?php

class Combat
{
	private $hasBSExtraShot = false;
	private $usedBSExtraShot = false;
	private $extraShotMode = false;
	
	private $result = [];
	
	function __construct($FiringUnit, $FiringWeapon, $TargetUnit, $RollingDice=null)
    {
	    $this->FiringUnit = $FiringUnit;
		$this->FiringWeapon = $FiringWeapon;
		$this->TargetUnit = $TargetUnit;
	    
	    if($this->FiringUnit->getBallisticSkill()>=6)
	    	$this->hasBSExtraShot = true;
	    	
	    if($RollingDice==null)
			$this->RollingDice = new RollingDice();
		else
			$this->RollingDice = $RollingDice;
    }
    
    public function resolveResult()
    {
	    $result = 
	    [
			'enemy_dead' => 0  
	    ];
	    $FiringModels = $this->FiringUnit->getModelsCanShoot($FiringWeapon,$TargetUnit);
	    $totalShots = $this->getShotCount($FiringModels);
	    $hitResult = $this->getHitResult($totalShots);
	    $totalWounds = $this->getWoundsCount($hitResult['hit']);
	    $totalSaves = $this->getSavesCount($totalWounds);
	    $kills = $totalWounds - $totalSaves;
	    
	    if($kills<0)
	    	$kills = 0;
	    elseif($kills>count($TargetUnit->getModels()))
	    	$kills = count($TargetUnit->getModels());
	    
	    $result['enemy_dead'] = $kills;
	    
	    return($result);
	    
	}
	
	public function getShotCount(array $FiringModels)
    {
	    $shotCount = 0;
	    foreach($FiringModels as $Model)
	    {
		    $shotCount+=$Model->getWeaponShotCount($FiringWeapon,$TargetUnit);
	    }
	    
	    return($shotCount);
	    	
    }
    
	public function getHitResult($totalShots)
	{
		$shootingResult = 
	    [
		    'extra_shot' => 0,
		    'hit' => 0,		    
		    'miss' => 0
	    ];
	    
        foreach($this->RollingDice->getRolls($totalShots) as $thisRoll)
        {
	        $shootingResult[$this->getShotResult($thisRoll)]++;;
	        
        }
        
        return($shootingResult);
        
	}
	
	public function getWoundsCount(int $hitsCount)
	{
		$rolls = $this->RollingDice->getRolls($hitsCount);
		$woundResult = $this->FiringUnit->unitShotWounds($this->FiringWeapon,$this->TargetUnit,$rolls);
		
		return($woundResult);
	}

    public function getSavesCount(int $woundsCount)
    {
	    $rolls = $this->RollingDice->getRolls($woundsCount);
		$savesResult = $this->TargetUnit->unitSavesWounds($this->FiringWeapon,$rolls);
		return($savesResult);
    }
    
    
    
    /*
    public function getHitsCount()
	{
		//$rolls = $RollingDice->getRolls($shotCount);
		$hitResult = $FiringUnit->unitShootingResult();
		
		$totalHits = $hitResult['hit'];
		if($hitResult['extra_shot']>0)
		{
			$shots = $hitResult['extra_shot'];
			$rolls = $this->getRolls($shotCount);
			$hitResult = $FiringUnit->unitShootingResult($rolls);
			$totalHits += $hitResult['hit'];
		}
		
		return($totalHits);
	}
	*/
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
	
	
	
	public function getShotResult($roll)
	{
		if($this->shotHits($roll,$this->FiringUnit->getBallisticSkill()))
			return('hit');
		
		if($this->hasBSExtraShot && !($this->usedBSExtraShot))
		{
			$this->usedBSExtraShot = true;
			$this->extraShotMode = true;
			return('extra_shot');
		}
		
		return('miss');
	}
	
	public function causesWound($weaponStrength,$targetToughness,$roll)
	{
		$minRollRequired = 0;
		
		if($weaponStrength==$targetToughness)
			$minRollRequired = 4;
		else
		{
			if($weaponStrength<$targetToughness)
			{
				$minRollRequired = 4+($targetToughness-$weaponStrength);
			}
			else
			{
				$minRollRequired = 4-($weaponStrength - $targetToughness);
			}
		}
		
		if($minRollRequired<2)
			$minRollRequired = 2;
		
		if($minRollRequired>6)
			$minRollRequired = 6;
		
			
		return($roll>=$minRollRequired);
	}
	
	function getWoundResult($roll)
	{
		if($this->causesWound($this->FiringWeapon->getStrength(),$this->TargetUnit->getToughness(),$roll))
			return('wound');
		else
			return('miss');
	}
	
	public function savesWound($weaponStrength,$targetSave,$roll)
	{
		$minRollRequired = 0;
		
		if($weaponStrength==$targetSave)
			$minRollRequired = 4;
		else
		{
			if($weaponStrength<$targetSave)
			{
				$minRollRequired = 4+($targetSave-$weaponStrength);
			}
			else
			{
				$minRollRequired = 4-($weaponStrength - $targetSave);
			}
		}
		
		if($minRollRequired<2)
			$minRollRequired = 2;
		
		if($minRollRequired>6)
			$minRollRequired = 6;
		
			
		return($roll>=$minRollRequired);
	}
	
	/*
	public function getSaveResult($roll)
	{
		if($this->savesWound($this->FiringWeapon->getStrength(),$this->TargetModel->getArmourSave(),$roll))
			return('save');
		else
			return('wound');
	}
	*/
	
	
}
