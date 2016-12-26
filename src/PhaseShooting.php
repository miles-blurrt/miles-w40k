<?php

class PhaseShooting
{
	var $shootingResult = [];
	
	public function __construct(\ModelInfantry $FiringModel, \WeaponBolter $FiringWeapon, \ModelInfantry $TargetModel)
	{
		$this->FiringModel = $FiringModel;
		$this->FiringWeapon = $FiringWeapon;
		$this->TargetModel = $TargetModel;
		
		$this->CombatShot = new CombatShot($FiringModel);
		$this->CombatHit = new CombatHit($FiringModel, $FiringWeapon, $TargetModel);
		$this->CombatWound = new CombatWound($FiringModel, $FiringWeapon, $TargetModel);
		
		
	}
	
	
	
    public function resolveShotsToHitCount(array $rolls)
    {
	    $hits = 0;
	    
        foreach($rolls as $thisRoll)
        {
	        $hitResult = $this->CombatShot->getResult($thisRoll);
	        if($hitResult=='extra_shot')
	        	$hitResult = $this->CombatShot->getResult($thisRoll);
	        	
	        if($hitResult=='hit')
	        	$hits++;
        }
        
        return($hits);
    }
    
    public function resolveHitsToWoundCount(array $rolls)
    {
	    $wounds = 0;
	    
        foreach($rolls as $thisRoll)
        {
	        $woundResult = $this->CombatHit->getResult($thisRoll);
	        	
	        if($woundResult=='wound')
	        	$wounds++;
        }
        
        return($wounds);
    }

    public function resolveWoundSaves(array $rolls)
    {
	    $saves = 0;
        
        foreach($rolls as $thisRoll)
        {
	        $saveResult = $this->CombatWound->getResult($thisRoll);
	        if($saveResult == 'saved')
	        	$saves++;
        }
        
        return $saves;
    }

    public function getShootingResult()
    {
        // TODO: write logic here
    }
}
