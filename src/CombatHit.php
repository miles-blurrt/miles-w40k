<?php

class CombatHit
{
	function __construct($FiringModel, $FiringWeapon, $TargetUnit)
    {
	    $this->FiringModel = $FiringModel;
		$this->FiringWeapon = $FiringWeapon;
		$this->TargetUnit = $TargetUnit;
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
	
	function getResult($roll)
	{
		if($this->causesWound($this->FiringWeapon->getStrength(),$this->TargetUnit->getToughness(),$roll))
			return('wound');
		else
			return('miss');
	}
	
}
