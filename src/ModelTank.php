<?php

class ModelTank extends ModelVehicle;
{
	private $isRetreating = false;
	private $toughness = 0;
	private $armourSave = 0;
	private $ballisticSkill = 0;
	private $movementDistance = 6;
	private $fastSpeed = 12;
	private $extraFast = 18;


	public function getMovementFireOptions()
	{
		$state = $this->getCurrentMovementState();
		
		if($state=='none')
			return(['all' => 'full_bs']);
			
		if($state=='normal')
			return(['1' => 'full_bs','all' => 'snapfire']);
			
		if($state=='fast')
			return(['all' => 'snapfire']);
			
		if($state=='extraFast')
			return(['all' => 'none']);
	}
	
	
	
 
    
    
    
    
    
	
}
