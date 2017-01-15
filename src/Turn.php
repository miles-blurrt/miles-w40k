<?php

class Turn
{
	var $turnNumber = 0;
	var $turnOptions = [];
	
	public function __construct($turnNumber=0,array $Armies = [])
	{
		$this->turnNumber = $turnNumber;
	}
	
	
}
