<?php

namespace spec;

use Unit;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UnitSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Unit::class);
    }
}
