<?php

class ModelInfantry extends Model
{
	private $isRetreating = false;
	private $toughness = 0;
	private $armourSave = 0;
	private $ballisticSkill = 0;
	private $movementDistance = 6;
	
	public function getMovementFireOptions()
	{
		$state = $this->getCurrentMovementState();
		
		if($state=='none')
			return(['all' => 'full_bs']);
			
		if($state=='normal')
			return(['all' => 'full_bs']);
	}
	
	public function getToughness()
	{
		return($this->toughness);
	}
	
	public function getArmourSave()
	{
		return($this->armourSave);
	}
	
 
    
    public function resolveCombatShot(CombatShot $CombatShot)
    {
	    if($this->shotHits($CombatShot->getRoll()))
			$CombatShot->addHit();
	    	    
	    return($CombatShot);
    }
    
    public function resolveCombatHit(CombatHit $CombatHit)
    {
	    if($this->causesWound($CombatHit->getWeaponStrength(),$CombatHit->getRoll()))
			$CombatHit->addWound();
	    	    
	    return($CombatHit);
    }
    
    
    
	
}
