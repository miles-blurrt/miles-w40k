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
	
	
	public function getHitsCount($FiringUnit,$RollingDice,int $shotCount)
	{
		$rolls = $RollingDice->getRolls($shotCount);
		$hitResult = $FiringUnit->unitShotHits($rolls);
		
		$totalHits = $hitResult['hit'];
		if($hitResult['extra_shot']>0)
		{
			$shots = $hitResult['extra_shot'];
			$rolls = $this->getRolls($shotCount);
			$hitResult = $FiringUnit->unitShotHits($rolls);
			$totalHits += $hitResult['hit'];
		}
		
		return($totalHits);
	}
	
	public function getWoundsCount($FiringWeapon,$TargetUnit,$RollingDice,int $hitsCount)
	{
		$rolls = $RollingDice->getRolls($hitsCount);
		$woundResult = $FiringUnit->unitShotWounds($FiringWeapon,$TargetUnit,$rolls);
		
		return($woundResult);
	}

    public function getSavesCount($FiringWeapon,$TargetUnit,$RollingDice,int $woundsCount)
    {
	    $rolls = $RollingDice->getRolls($woundsCount);
		$savesResult = $TargetUnit->unitSavesWounds($FiringWeapon,$rolls);
		return($savesResult);
    }


}
