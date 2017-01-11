<?php

class WeaponPowerclaw extends Weapon
{
	use WeaponTraitUnwieldy;
	
	private $strength = 4;
	private $id = "powerclaw";
	private $ap = 2;
	
	public function __construct($buildParams=[])
	{
		
	}
	
}
