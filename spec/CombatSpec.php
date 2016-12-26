<?php

namespace spec;

use Combat;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CombatSpec extends ObjectBehavior
{
    
   function let(\ModelInfantry $FiringModel, \WeaponBolter $FiringWeapon, \ModelInfantry $TargetModel)
   {
   		$this->beConstructedWith($FiringModel,$FiringWeapon,$TargetModel);
   }
   
    
    
    
     function it_calculates_a_hit_correctly()
    {
	    $this->shotHits(3,4)->shouldReturn(true);
	    
	    $this->shotHits(3,3)->shouldReturn(false);
	    $this->shotHits(4,3)->shouldReturn(true);
    }
    
    function it_resolves_hits(\ModelInfantry $FiringModel, \WeaponBolter $FiringWeapon, \ModelInfantry $TargetModel)
    {
	    $FiringModel->getBallisticSkill()->willReturn(4);
	    
	    $this->beConstructedWith($FiringModel,$FiringWeapon,$TargetModel);
	    $this->getShotResult(3)->shouldReturn('hit');
	    $this->getShotResult(2)->shouldReturn('miss');
    }
    
    
    function it_resolves_high_bs_miss(\ModelInfantry $FiringModel, \WeaponBolter $FiringWeapon, \ModelInfantry $TargetModel)
    {
	    $FiringModel->getBallisticSkill()->willReturn(7);
	    $this->beConstructedWith($FiringModel,$FiringWeapon,$TargetModel);
	    $this->getShotResult(1)->shouldReturn('extra_shot');
	    $this->getShotResult(4)->shouldReturn('miss');
    }
    
    function it_resolves_high_bs_hit(\ModelInfantry $FiringModel, \WeaponBolter $FiringWeapon, \ModelInfantry $TargetModel)
    {
    	// Hits second chance
	    $FiringModel->getBallisticSkill()->willReturn(7);
	    $this->beConstructedWith($FiringModel,$FiringWeapon,$TargetModel);
	    $this->getShotResult(1)->shouldReturn('extra_shot');
	    $this->getShotResult(5)->shouldReturn('hit');
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
	    $this->getWoundResult(4)->shouldReturn('wound');
    }
}
