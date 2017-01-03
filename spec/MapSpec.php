<?php

namespace spec;

use Map;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MapSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Map::class);
    }
    
    function it_calculates_model_new_position()
    {
	    $existingCoordinates = ['x'=>1.0,'y'=>2.0,'z'=>0.0];
	    $distance = 2;
	    $degrees=90;
	    $elevation=0;
	    $newCoordinates = ['x'=>1.00,'y'=>4.00,'z'=>0.00];
	    $this->getNewCoordinates($existingCoordinates,$distance,$degrees,$elevation)->shouldReturn($newCoordinates);
	    
	    $existingCoordinates = ['x'=>5.0,'y'=>5.0,'z'=>0.0];
	    $distance = 5;
	    $degrees=135;
	    $elevation=0;
	    $newCoordinates = ['x'=>1.46,'y'=>8.54,'z'=>0.00];
	    $this->getNewCoordinates($existingCoordinates,$distance,$degrees,$elevation)->shouldReturn($newCoordinates);
	    
	    $existingCoordinates = ['x'=>5.0,'y'=>5.0,'z'=>0.0];
	    $distance = 5;
	    $degrees=135;
	    $elevation=1;
	    $newCoordinates = ['x'=>1.46,'y'=>8.54,'z'=>1.00];
	    $this->getNewCoordinates($existingCoordinates,$distance,$degrees,$elevation)->shouldReturn($newCoordinates);
    }
}
