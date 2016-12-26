<?php

class Combat
{
	private $hasBSExtraShot = false;
	private $usedBSExtraShot = false;
	private $extraShotMode = false;
	
	private $result = [];
	
	function __construct($FiringModel, $FiringWeapon, $TargetUnit)
    {
	    $this->FiringModel = $FiringModel;
		$this->FiringWeapon = $FiringWeapon;
		$this->TargetUnit = $TargetUnit;
	    
	    if($this->FiringModel->getBallisticSkill()>=6)
	    	$this->hasBSExtraShot = true;
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
	

	
	public function getShotResult($roll)
	{
		if($this->shotHits($roll,$this->FiringModel->getBallisticSkill()))
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
	
	public function getSaveResult($roll)
	{
		if($this->savesWound($this->FiringWeapon->getStrength(),$this->TargetModel->getArmourSave(),$roll))
			return('save');
		else
			return('wound');
	}

	
	
}
