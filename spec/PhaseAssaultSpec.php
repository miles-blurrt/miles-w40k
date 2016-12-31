<?php

namespace spec;

use PhaseAssault;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PhaseAssaultSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PhaseAssault::class);
    }
}
