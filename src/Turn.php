<?php

class Turn
{
	var $turnNumber = 0;
	var $turnOptions = [];
	var $currentPhaseName = '';
	var $Phase = null;
	
	var $phases = 
	[
		'movement',
		'shooting',
		'assault'
	];
		
	
	public function __construct($turnNumber=0,array $Armies = [])
	{
		$this->turnNumber = $turnNumber;
		$this->setupNextPhase();
	}
	
	public function setupNextPhase()
	{
		if($this->currentPhaseName=='')
			$this->currentPhaseName = 'deployment';
			
		$phaseClassName = 'Phase'.ucfirst($this->currentPhaseName);
		$this->Phase = new $phaseClassName();
	}
}

