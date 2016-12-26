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
    
    function let(\ModelInfantry $FiringModel, \WeaponBolter $FiringWeapon, \ModelInfantry $TargetModel)
    {
   		$this->beConstructedWith($FiringModel,$FiringWeapon,$TargetModel);
    }
}
