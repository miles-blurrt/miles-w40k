<?php

class RollingDice
{
	public function getRolls($rolls=1,$die=6)
	{
		$result = [];
		do
		{
			$result[] = $this->getRoll($die);
			$rolls--;
			
		} while ($rolls>0);
		
		return($result);
	}
	
	public function getRoll($die=6)
	{
		return(rand(1,$die));
	}
}
