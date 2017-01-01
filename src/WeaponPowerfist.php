<?php

class WeaponPowerfist extends Weapon
{
	use WeaponUnwieldy;
	
	private $strength = 4;
	var $closeCombat = true;
	private $id = "powerfist";
	
	public function __construct($buildParams=[])
	{
		
	}
	
}
