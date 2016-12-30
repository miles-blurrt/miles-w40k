<?php

namespace spec;

use Model;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ModelSpec extends ObjectBehavior
{
    
    function it_calculates_distance_between_two_models()
    {
	    $this->setCoordinates(["x"=>1,"y"=>1,"z"=>1]);
	    $TargetModel = new Model();
	    $TargetModel->setCoordinates(["x"=>3,"y"=>1,"z"=>1]);
	    
	    $this->getDistance($TargetModel)->shouldReturn(2.0);
    }
}
