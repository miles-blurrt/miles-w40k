<?php

class Map
{
	public $Models;
	public $DifficultTerrains;
	public $Buildings;
	
	
	

    public function getNewCoordinates($existingCoordinates,$distance, $degrees, $elevation)
    {
	    // @TODO: Resolve vertical movement properly
	    $existingCoordinates['x'] += round(cos(deg2rad($degrees)) * $distance,2);
      	$existingCoordinates['y'] += round(sin(deg2rad($degrees)) * $distance,2);
      	$existingCoordinates['z'] += $elevation;
		
		return($existingCoordinates);
    }


}
