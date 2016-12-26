<?php

namespace spec;

use WeaponBolter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WeaponBolterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(WeaponBolter::class);
    }
}
