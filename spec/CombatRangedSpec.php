<?php

namespace spec;

use CombatRanged;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CombatRangedSpec extends ObjectBehavior
{
    
   function let(\Unit $FiringUnit, \WeaponBolter $FiringWeapon, \Unit $TargetUnit)
   {
   		$this->beConstructedWith($FiringUnit,$FiringWeapon,$TargetUnit);
   }
   
    
    
    
    function it_calculates_a_hit_correctly()
    {
	    $this->shotHits(3,4)->shouldReturn(true);
	    
	    $this->shotHits(3,3)->shouldReturn(false);
	    $this->shotHits(4,3)->shouldReturn(true);
    }
    
    function it_resolves_hits(\Unit $FiringUnit, \WeaponBolter $FiringWeapon, \Unit $TargetUnit)
    {
	    $FiringUnit->getUnitBallisticSkill()->willReturn(4);
	    
	    $this->beConstructedWith($FiringUnit,$FiringWeapon,$TargetUnit);
	    $this->getShotResult(3)->shouldReturn('hit');
	    $this->getShotResult(2)->shouldReturn('miss');
    }
    
    
    function it_resolves_high_bs_miss(\Unit $FiringUnit, \WeaponBolter $FiringWeapon, \Unit $TargetUnit)
    {
	    $FiringUnit->getUnitBallisticSkill()->willReturn(7);
	    $this->beConstructedWith($FiringUnit,$FiringWeapon,$TargetUnit);
	    $this->getShotResult(1)->shouldReturn('extra_shot');
	    $this->getShotResult(4)->shouldReturn('miss');
    }
    
    function it_resolves_high_bs_hit(\Unit $FiringUnit, \WeaponBolter $FiringWeapon, \Unit $TargetUnit)
    {
    	// Hits second chance
	    $FiringUnit->getUnitBallisticSkill()->willReturn(7);
	    $this->beConstructedWith($FiringUnit,$FiringWeapon,$TargetUnit);
	    $this->getShotResult(1)->shouldReturn('extra_shot');
	    $this->getShotResult(5)->shouldReturn('hit');
    }
    
    
    
    
    
  
}
