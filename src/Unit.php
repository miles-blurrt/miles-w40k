<?php

class Unit
{
	private $ModelArray = [];
	
	public function __construct(array $ModelArray=null)
	{
		$this->ModelArray = $ModelArray;
		
	}
	
	public function engageRangedCombat(Weapon $FiringWeapon, Unit $TargetUnit)
	{
		$this->Combat = new Combat($this,$FiringWeapon,$TargetUnit);
		return($this->Combat->resolveResult());
	}
	
	
    
    public function getModelsCanShoot(Weapon $FiringWeapon, Unit $TargetUnit)
    {
	    $Models = [];
	    foreach($this->getModels() as $Model)
	    {
		    if($Model->hasWeapon($FiringWeapon))
		    	$Models[] = $Model;
	    }
	    
	    return($Models);
    }
    
    public function getModels()
    {
	    return($ModelArray);
    }
    
    
	
	public function unitShotWounds($FiringWeapon,$TargetUnit,$rolls)
	{
		$CombatHit = new CombatHit($this,$FiringWeapon,$TargetUnit);
		$woundsCount = 0;
	    
        foreach($rolls as $thisRoll)
        {
	        $woundResult = $CombatHit->getResult($thisRoll);
	        	
	        if($woundResult=='wound')
	        	$woundsCount++;
        }
        
        return($woundsCount);
	}
	
	public function unitSavesWounds($FiringWeapon,$rolls)
	{
		$CombatWound = new CombatWound($FiringWeapon,$this);
		$saves = 0;
        
        foreach($rolls as $thisRoll)
        {
	        $saveResult = $CombatWound->getResult($thisRoll);
	        if($saveResult == 'save')
	        	$saves++;
        }
        
        return $saves;
	}
}
