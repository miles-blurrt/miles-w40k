<?php

class CombatWound
{
	function __construct($FiringWeapon, $TargetModel)
    {
	    $this->FiringWeapon = $FiringWeapon;
		$this->TargetModel = $TargetModel;
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
	
	public function getResult($roll)
	{
		if($this->savesWound($this->FiringWeapon->getStrength(),$this->TargetModel->getArmourSave(),$roll))
			return('save');
		else
			return('wound');
	}
}
