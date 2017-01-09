<?php

class Combat
{
	private $hasBSExtraShot = false;
	private $usedBSExtraShot = false;
	private $extraShotMode = false;
	
	private $result = 
	[
		'friendly_wounds' => 0,
		'enemy_dead' => 0
	];

	
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
		$totalShots = $this->TargetUnit->getOverwatchShotCount($this->FiringUnit);
	    $hitResult = $this->getHitResults($totalShots);
	    $totalWounds = $this->getWoundsCount($hitResult['hits']);
	    $totalSaves = $this->getSavesCount($totalWounds);
	    $unsavedWounds = $totalWounds - $totalSaves;
	    
	    if($unsavedWounds<0)
	    	$unsavedWounds = 0;    
	    
	    $this->result['friendly_wounds'] = $unsavedWounds;
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
	
	public function savesWound($strength,$ap,$targetSave,$roll)
	{
		$minRollRequired = 0;
		
		if($strength==$targetSave)
			$minRollRequired = 4;
		else
		{
			if($strength<$targetSave)
			{
				$minRollRequired = 4+($targetSave-$strength);
			}
			else
			{
				$minRollRequired = 4-($strength - $targetSave);
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
		if($this->FiringWeapon->getAP()<=$this->TargetModel->getArmourSave())
			return(0);
			
		$rolls = $this->RollingDice->getRolls($woundsCount);
		
		$saves = 0;
        
        foreach($rolls as $thisRoll)
        {
	        
	        $saveResult = $this->savesWound($this->FiringWeapon->getStrength(),$this->FiringWeapon->getAP(),$this->TargetModel->getArmourSave(),$thisRoll);
	        if($saveResult == 'save')
	        	$saves++;
        }
        
        return $saves;
	}	
}
