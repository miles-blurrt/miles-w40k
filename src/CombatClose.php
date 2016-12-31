<?php

class CombatClose
{
	function __construct($FiringUnit, $FiringWeapon, $TargetUnit, $RollingDice=null)
    {
	    $this->FiringUnit = $FiringUnit;
		$this->FiringWeapon = $FiringWeapon;
		$this->TargetUnit = $TargetUnit;
	    	
	    if($RollingDice==null)
			$this->RollingDice = new RollingDice();
		else
			$this->RollingDice = $RollingDice;
    }
    
    function chargeSuccessfull()
    {
	    $distanceRequired = $this->FiringUnit->minDistance($this->TargetUnit);
	    $chargeDistance = $this->RollingDice->getRollsTotal(2);
	    if($chargeDistance>=$distanceRequired)
	    {
		    $this->FiringUnit->advanceToBaseContact($this->TargetUnit,$chargeDistance);
		    return(true);
	    }
	    else
	    	return(false);
    }
    
    public function closeCombatHits()
	{
		$roll = $this->RollingDice->getRoll();
		
		if($roll==1)
			return(false);
		
		$minRollRequired = 7 - $this->FiringUnit->getUnitWeaponSkill();
		
		if($minRollRequired<2)
			$minRollRequired = 2;
					
		return($roll>=$minRollRequired);
	}
}
