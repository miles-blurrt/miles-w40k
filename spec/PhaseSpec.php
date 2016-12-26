<?php

namespace spec;

use Phase;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PhaseSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Phase::class);
    }
    
    function let()
    {
	    $Model = new TestModel();
	    $this->beConstructedWith($Model);
    }
    
    
}

class TestModel 
{
	
}
