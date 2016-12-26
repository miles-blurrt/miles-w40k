<?php

namespace spec;

use PhaseMovement;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PhaseMovementSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PhaseMovement::class);
    }
    
    function let()
    {
	    $Model = new TestModel();
	    $this->beConstructedWith($Model);
    }
}

