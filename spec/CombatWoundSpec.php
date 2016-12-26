<?php

namespace spec;

use CombatWound;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CombatWoundSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CombatWound::class);
    }
}
