<?php

class WeaponPowerclaw extends Weapon
{
	use WeaponUnwieldy;
	
	private $strength = 4;
	var $closeCombat = true;
	private $id = "powerclaw";
	private $ap = 2;
	
	public function __construct($buildParams=[])
	{
		
	}
	
}
