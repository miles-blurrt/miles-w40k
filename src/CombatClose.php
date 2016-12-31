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
}
