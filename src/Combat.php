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
	    
	    if($this->FiringUnit->getUnitBallisticSkill()>=6)
	    	$this->hasBSExtraShot = true;
	    	
	    if($RollingDice==null)
			$this->RollingDice = new RollingDice();
		else
			$this->RollingDice = $RollingDice;
    }
    
    public function resolveOverwatch()
	{
		$result = 
	    [
			'firingunit_dead' => 0  
	    ];
	    
	    $totalShots = $this->TargetUnit->getOverwatchShotCount($this->FiringUnit);
	    $hitResult = $this->getHitResults($totalShots);
	    $totalWounds = $this->getWoundsCount($hitResult['hits']);
	    $totalSaves = $this->getSavesCount($totalWounds);
	    $kills = $totalWounds - $totalSaves;
	    
	    if($kills<0)
	    	$kills = 0;
	    elseif($kills>count($TargetUnit->getModels()))
	    	$kills = count($TargetUnit->getModels());
	    
	    $result['enemy_dead'] = $kills;
	    
	    return($result);
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
	
	public function getWoundsCount(int $hitsCount)
	{
		$rolls = $this->RollingDice->getRolls($hitsCount);
		
		$woundsCount = 0;
	    
        foreach($rolls as $thisRoll)
        {
	        $woundResult = $this->causesWound($this->FiringWeapon->getStrength(),$this->TargetUnit->getToughness(),$thisRoll);
	        	
	        if($woundResult=='wound')
	        	$woundsCount++;
        }
        
        return($woundsCount);
	}
	
	public function getSavesCount($woundsCount)
	{
		$rolls = $this->RollingDice->getRolls($woundsCount);
		
		$saves = 0;
        
        foreach($rolls as $thisRoll)
        {
	        $saveResult = $this->savesWound($this->FiringWeapon->getStrength(),$this->TargetModel->getArmourSave(),$thisRoll);
	        if($saveResult == 'save')
	        	$saves++;
        }
        
        return $saves;
	}	
}
