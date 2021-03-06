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
    
    function it_fires_two_shots_under_12_distance()
    {
	    $this->getShotsCount(3)->shouldEqual(2);
    }
}
