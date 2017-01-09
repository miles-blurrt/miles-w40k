<?php

class CombatClose extends Combat
{
	private $attackingUnitChargeBonus = false;
	public $initiativeLevel = 0;
	
	function __construct($FiringUnit, $TargetUnit, $RollingDice=null)
    {
	    $this->FiringUnit = $FiringUnit;
		$this->TargetUnit = $TargetUnit;
	    	
	    if($RollingDice==null)
			$this->RollingDice = new RollingDice();
		else
			$this->RollingDice = $RollingDice;
    }
    

    public function resolveFightSubphase()
    {
	    $this->initiativeLevel = 10;
	    do
		{
			$AttackingUnitWoundsCaused = $this->getCloseCombatUnsavedWounds($this->FiringUnit,$this->TargetUnit,$this->attackingUnitChargeBonus);
			if(!$this->TargetUnit->hasCloseCombatEngagedThisTurn())
				$TargetUnitWoundsCaused = $this->getCloseCombatUnsavedWounds($this->FiringUnit,$this->TargetUnit);
			
			$this->initiativeLevel--;
			
			// TODO: Resolve Result
			$this->result['enemy_wounds']+=$AttackingUnitWoundsCaused;
			$this->result['friendly_wounds']+=$TargetUnitWoundsCaused;
			
			$this->FiringUnit->applyWounds($AttackingUnitWoundsCaused);	
			$this->TargetUnit->applyWounds($TargetUnitWoundsCaused);
				
		}
		while ($this->initiativeLevel>=1);
    }
    
    public function resolveNewCloseCombat()
    {
	    $this->resolveOverwatch();
	    $this->FiringUnit->applyWounds($this->result['friendly_wounds']);
	    if(!$this->FiringUnit->chargeSuccessfull)
	    	return;
	    	
	    $this->FiringUnit->advanceUnitToBaseContact();
	    
	    $this->attackingUnitChargeBonus = true;
	    
		$this->resolveFightSubphase();
		$this->attackingUnitChargeBonus = false;
		
    }

    /// Function below can be easily unit tested

    public function getCloseCombatUnsavedWounds($ThisUnit,$TargetUnit,$chargeBonus=false)
    {
	    $totalAttacks = 0;
	    
	    $FightingModels = $ThisUnit->getModelsAtCloseCombatinitiativeStep($this->initiativeLevel);
	    
	    $targetUnitWeaponSkill = $TargetUnit->getUnitWeaponSkill();
	    $chargeBonusAttacks = 0;
	    $unsavedWounds = 0;
	    
	    foreach($FightingModels as $thisModel)
	    {
		    $this->modelPileIn($thisModel,$TargetUnit);
		    if (!$this->modelInCloseCombatRange($thisModel,$TargetUnit))
		    	continue;
		    
		    $hits = 0;
		    
		    $modelWeaponSkill = $thisModel->getWeaponSkill();
		    
		    
		    $attacks = $thisModel->getCloseCombatAttackCount();
		    if($chargeBonus)
		    	$attacks+=1;
		    
		    $rolls = $this->RollingDice->getRolls($attacks);
		    foreach($rolls as $thisRoll)
		    {
			    if($this->closeCombatHits($modelWeaponSkill,$targetUnitWeaponSkill,$thisRoll))
			    	$hits++;
			    	
		    }
		    
		     $wounds = 0;
		    foreach($this->RollingDice->getRolls($hits) as $thisRoll)
		    {
			    if($this->causesWound($ThisUnit->getUnitStrength(),$TargetUnit->getUnitToughnessLevel(),$thisRoll))
			    	$wounds++;
		    }
		    
		    
		    foreach($this->RollingDice->getRolls($wounds) as $thisRoll)
		    {
			    if(!($this->savesCloseCombatWound($TargetUnit->getUnitArmourSave(),$thisModel->getCloseCombatWeaponAP(),$thisRoll)))
			    	$unsavedWounds++;
		    }
		    
	    }
	   
	    
	    
	   
		
		return($unsavedWounds);
	    
    }
    
    public function modelInCloseCombatRange($thisModel,$TargetUnit)
    {
	    // @TODO: Fix so returns if in base contact or 2 distance within a model that is
	    return true;
    }
    
    public function savesCloseCombatWound($ArmourSave,$weaponAP,$roll)
    {
	    if($weaponAP<=$ArmourSave)
	    	return(false);
	    	
	    if($roll==1)
			return(false);
		
		$minRollRequired = $ArmourSave;
		
		if($minRollRequired<2)
			$minRollRequired = 2;
		if($minRollRequired > 6)
			$minRollRequired = 6;
					
		return($roll>=$minRollRequired);
    }
    
    public function closeCombatHits($weaponSkill, $targetWeaponSkill, $thisRoll)
	{
		if($thisRoll==1)
			return(false);
		
		$minRollRequired = 4 - ($weaponSkill - $targetWeaponSkill);
		
		if($minRollRequired<2)
			$minRollRequired = 2;
		if($minRollRequired > 6)
			$minRollRequired = 6;
					
		return($thisRoll>=$minRollRequired);
	}
	
	 function chargeSuccessfull()
    {
	    $distanceRequired = $this->FiringUnit->minDistance($this->TargetUnit);
	    
	    $chargingDistance = $this->RollingDice->getRollsTotal(2);
	    	
	    if($chargingDistance>=$distanceRequired)
	        return(true);
	    else
	    	return(false);
    }
    
    public function modelPileIn($ThisModel,$TargetUnit)
	{
		// @TODO: Pile in 3 inches
	}
}
