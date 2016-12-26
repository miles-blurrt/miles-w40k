<?php

abstract class Model
{
	private $ballisticSkill = 0;
	private $toughness = 0;
	
	public function getBallisticSkill()
	{
		return($this->ballisticSkill);
	}
	
	public function getToughness()
	{
		return($this->toughness);
	}
}
