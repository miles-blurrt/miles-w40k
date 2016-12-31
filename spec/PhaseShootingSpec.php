<?php

namespace spec;

use PhaseShooting;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PhaseShootingSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PhaseShooting::class);
    }
    
   
}
