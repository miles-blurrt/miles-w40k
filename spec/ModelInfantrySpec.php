<?php

namespace spec;

use ModelInfantry;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ModelInfantrySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
	   $this->shouldHaveType(ModelInfantry::class);
    }
    
    
    
    
}
