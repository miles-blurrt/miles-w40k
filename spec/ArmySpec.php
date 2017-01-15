<?php

namespace spec;

use Army;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ArmySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Army::class);
    }
}
