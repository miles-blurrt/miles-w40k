<?php

trait WeaponRapidFire 
{
	function getShotsCount($distance)
	{
		if($distance<=12)
			return(2);
		if($distance<=24)
			return(1);
		
		return(0);	
	}
}