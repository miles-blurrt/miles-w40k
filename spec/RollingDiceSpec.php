<?php

namespace spec;

use RollingDice;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RollingDiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(RollingDice::class);
    }
}
