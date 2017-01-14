<?php

namespace spec;

use CombatRanged;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CombatRangedSpec extends ObjectBehavior
{
    
   function let(\Unit $FiringUnit, \WeaponBolter $FiringWeapon, \Unit $TargetUnit,\RollingDice $RollingDice)
   {
   		$this->beConstructedWith($FiringUnit,$FiringWeapon,$TargetUnit,$RollingDice);
   }
   
    
    
    
    function it_calculates_a_hit_correctly()
    {
	    $this->shotHits(3,4)->shouldReturn(true);
	    
	    $this->shotHits(3,3)->shouldReturn(false);
	    $this->shotHits(4,3)->shouldReturn(true);
    }
    
    function it_resolves_hits(\Unit $FiringUnit, \WeaponBolter $FiringWeapon, \Unit $TargetUnit,\RollingDice $RollingDice)
    {
	    $FiringUnit->getUnitBallisticSkill()->willReturn(4);
	    
	    $this->beConstructedWith($FiringUnit,$FiringWeapon,$TargetUnit,$RollingDice);
	    $RollingDice->getRoll()->willReturn(3);
	    $this->getShotResult()->shouldReturn('hit');
	    $RollingDice->getRoll()->willReturn(2);
	    $this->getShotResult()->shouldReturn('miss');
    }
    
    
    function it_resolves_high_bs_miss(\Unit $FiringUnit, \WeaponBolter $FiringWeapon, \Unit $TargetUnit,\RollingDice $RollingDice)
    {
	    $FiringUnit->getUnitBallisticSkill()->willReturn(7);
	    $this->beConstructedWith($FiringUnit,$FiringWeapon,$TargetUnit,$RollingDice);
		$RollingDice->getRoll()->willReturn(1);
	    $this->getShotResult()->shouldReturn('extra_shot');
	    $RollingDice->getRoll()->willReturn(4);
	    $this->getShotResult()->shouldReturn('miss');
    }
    
    function it_resolves_high_bs_hit(\Unit $FiringUnit, \WeaponBolter $FiringWeapon, \Unit $TargetUnit,\RollingDice $RollingDice)
    {
    	// Hits second chance
	    $FiringUnit->getUnitBallisticSkill()->willReturn(7);
	    $this->beConstructedWith($FiringUnit,$FiringWeapon,$TargetUnit,$RollingDice);
	    $RollingDice->getRoll()->willReturn(1);
	    $this->getShotResult()->shouldReturn('extra_shot');
	    $RollingDice->getRoll()->willReturn(5);
	    $this->getShotResult()->shouldReturn('hit');
    }
    
    
    
    
    
    
    
  
}
