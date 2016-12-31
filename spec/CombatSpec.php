<?php

namespace spec;

use Combat;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CombatSpec extends ObjectBehavior
{
	function let(\Unit $FiringUnit, \WeaponBolter $FiringWeapon, \Unit $TargetUnit)
    {
   		$this->beConstructedWith($FiringUnit,$FiringWeapon,$TargetUnit);
    }
   
    function it_is_initializable()
    {
        $this->shouldHaveType(Combat::class);
    }
    
    function it_calculates_a_wound_correctly()
    {
	    $this->causesWound(4,4,4)->shouldReturn(true);
	    $this->causesWound(3,4,4)->shouldReturn(false);
	    
	    $this->causesWound(3,3,4)->shouldReturn(true);
	    
	    $this->causesWound(4,5,4)->shouldReturn(false);
	    $this->causesWound(4,5,5)->shouldReturn(true);
	    $this->causesWound(5,5,4)->shouldReturn(true);
	    
	    $this->causesWound(4,4,2)->shouldReturn(false);
    }
    
    function it_resolves_a_wound_result(\Unit $FiringUnit, \WeaponBolter $FiringWeapon, \ModelInfantry $TargetModel, \RollingDice $RollingDice)
    {
	    $FiringWeapon->getStrength()->willReturn(5);
	    $TargetModel->getToughness()->willReturn(5);
	    $RollingDice->getRolls(3)->willReturn([2,4,3]);
	    $this->beConstructedWith($FiringUnit,$FiringWeapon,$TargetModel,$RollingDice);
	    $this->getWoundsCount(3)->shouldReturn(1);
    }
}
