<?php

namespace spec;

use Turn;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TurnSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Turn::class);
    }
}
