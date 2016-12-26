<?php

namespace spec;

use CombatHit;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CombatHitSpec extends ObjectBehavior
{
    
   function let(\ModelInfantry $FiringModel, \WeaponBolter $FiringWeapon, \ModelInfantry $TargetModel)
   {
   		$this->beConstructedWith($FiringModel,$FiringWeapon,$TargetModel);
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
    
    function it_resolves_a_wound_result(\ModelInfantry $FiringModel, \WeaponBolter $FiringWeapon, \ModelInfantry $TargetModel)
    {
	    $FiringWeapon->getStrength()->willReturn(5);
	    $TargetModel->getToughness()->willReturn(4);
	    $this->getResult(4)->shouldReturn('wound');
    }
}
