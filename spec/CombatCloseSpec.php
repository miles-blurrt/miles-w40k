<?php

namespace spec;

use CombatClose;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CombatCloseSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CombatClose::class);
    }
    
    function let(\Unit $FiringUnit, \WeaponBolter $FiringWeapon, \Unit $TargetUnit)
    {
   		$this->beConstructedWith($FiringUnit,$FiringWeapon,$TargetUnit);
    }
    
    function it_determines_successful_charge(\Unit $FiringUnit, \Unit $TargetUnit,\RollingDice $RollingDice)
    {
	    $this->beConstructedWith($FiringUnit,null,$TargetUnit,$RollingDice);
	    $minDistance = $FiringUnit->minChargeRequired($TargetUnit);
	    
    }
}
