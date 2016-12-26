<?php

abstract class Model
{
	private $ballisticSkill = 0;
	private $aliveCount = 0;
	
	public function setAliveCount($aliveCount)
	{
		$this->aliveCount = $aliveCount;
	}
	
	public function getAliveCount()
	{
		return($this->aliveCount);
	}
	public function getBallisticSkill()
	{
		return($this->ballisticSkill);
	}
	
	
}
