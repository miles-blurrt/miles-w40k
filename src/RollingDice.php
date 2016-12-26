<?php

class RollingDice
{
	public function getRolls($rolls=1,$die=6)
	{
		$result = [];
		do
		{
			$result[] = rand(rand(1,$die));
			$rolls--;
			
		} while ($rolls>0);
		
		return($result);
	}
}
