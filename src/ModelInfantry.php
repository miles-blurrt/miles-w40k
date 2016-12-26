<?php

class ModelInfantry extends Model
{
	public $isRetreating = false;
	public $toughness = 0;
	public $ballisticSkill = 0;
	
	
	
	
	
	
    public function canMoveNormally()
    {
        if($this->isRetreating==true)
        	return false;
        	
        return true;
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
