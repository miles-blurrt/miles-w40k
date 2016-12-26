<?php

class PhaseShooting
{
	
	
	public function __construct()
	{

		
	}
	
	public function resolveUnitShooting($FiringUnit, $FiringWeapon, $TargetUnit, $RollingDice)
	{
		$result =
		[
			'enemy_dead' => 0	
		];
		
		$shotCount = $FiringUnit->getUnitShotCount($FiringWeapon,$TargetUnit);
		foreach($FiringUnit->getModelsCanShoot($FiringWeapon,$TargetUnit) as $FiringModel)
		{
			$hitsCount = $this->getHitsCount($TargetUnit,$RollingDice,$shotCount);
			
			$woundsCount = $this->getWoundsCount($FiringWeapon,$TargetUnit,$RollingDice,$hitsCount);
			
			$savesCount = $this->getSavesCount($FiringWeapon,$TargetUnit,$RollingDice,$woundsCount);
			
			$result['enemy_dead'] = $woundCount - $saveCount;
			if($result['enemy_dead']<0)
				$result['enemy_dead'] = 0;
		}

		return($result);
	
	}
	
	
	
	
	


}
