<?php

class Unit
{
	private $ModelArray = [];
	
	public function __construct(array $ModelArray=null)
	{
		$this->ModelArray = $ModelArray;
	}
	
	public function getUnitShotCount(Weapon $FiringWeapon, Unit $TargetUnit)
    {
	    $shotCount = 0;
	    foreach($this->getModelsCanShoot($FiringWeapon,$TargetUnit) as $thisModel)
	    {
		    $shotCount+=$thisModel->getWeaponShotCount($FiringWeapon,$TargetUnit);
	    }
	    
	    return($shotCount);
	    	
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
    
    public function unitShotHits($rolls)
	{
		$CombatShot = new CombatShot($this);
		
		$shootingResult = 
	    [
		    'extra_shot' => 0,
		    'hit' => 0,		    
		    'miss' => 0
	    ];
	    
        foreach($rolls as $thisRoll)
        {
	        $shootingResult[$CombatShot->getResult($thisRoll)]++;;
	        
        }
        
        return($shootingResult);
        
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
