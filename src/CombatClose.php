<?php

class CombatClose
{
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
}
