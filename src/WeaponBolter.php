<?php

class WeaponBolter extends Weapon
{
	use WeaponTraitRapidfire;
	
	private $strength = 4;
	private $ap = 5;
	private $id = "bolter";
	private $shotsCount=2;
	private $maxDistance = 24;
	private $priorityRanking = 8;
	private $overwatchShotCount = 2;
	
	
}
