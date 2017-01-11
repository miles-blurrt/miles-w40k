<?php

trait WeaponTraitPistol
{
	public $closeCombat = true;
	public $canSnapFire = true;
	
	public function getFireAssaultOptionsOverride($fireState)
	{
		return(true);
	}
}